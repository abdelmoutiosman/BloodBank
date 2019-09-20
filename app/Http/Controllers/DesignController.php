<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassword;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Order;
use App\Models\Token;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class DesignController extends Controller
{
    public function home(Request $request){
        $settings=Setting::first();
        $records=Order::where(function ($query) use ($request) {
            if ($request->has('blood_type_id', 'city_id')) {
                $query->where(['blood_type_id' => $request->blood_type_id, 'city_id' => $request->city_id]);
            }
        })->take(1)->get();
        $posts=Post::all();
        return view('design.home',compact('settings','records','posts'));
    }
    public function order($id){
        $settings=Setting::first();
        $record=Order::find($id);
        return view('design.order-details',compact('settings','record'));
    }
    public function orders(Request $request){
        $settings=Setting::first();
        $records=Order::where(function ($query) use ($request) {
            if ($request->has('blood_type_id', 'city_id')) {
                $query->where(['blood_type_id' => $request->blood_type_id, 'city_id' => $request->city_id]);
            }
        })->paginate(2);
        return view('design.order',compact('settings','records'));
    }
    public function post($id){
        $settings=Setting::first();
        $post=Post::find($id);
        $posts=Post::all();
        return view('design.article',compact('settings','post','posts'));
    }
    public function about(){
        $settings=Setting::first();
        return view('design.how-we-are',compact('settings'));
    }
    public function contact(){
        $settings=Setting::first();
        return view('design.contact-us',compact('settings'));
    }
    public function createContact(Request $request){
        $validator=  validator()->make($request->all(),[
            'phone' => 'required|unique:contacts',
            'title' => 'required',
            'body'  => 'required',
        ]);
        $contacts= Contact::create($request->all());
        return redirect()->back();
    }
    public function register(){
        $settings=Setting::first();
        return view('design.signup',compact('settings'));
    }
    public function createClient(Request $request){
        $validator=  validator()->make($request->all(),[
            'name'         => 'required',
            'email'        => 'required|unique:clients',
            'blood_type_id'=> 'required|exists:blood_types,id',
            'phone'        => 'required',
            'password'     => 'required',
            'city_id'      => 'required|exists:cities,id',
            'last_donation_date'=>'required',
        ]);
        if($validator->fails()){
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }
        $request->merge(['password' => bcrypt($request->password)]);
        $client= Client::create($request->all());
        $client->api_token=  str_random(60);
        $client->save();
        return redirect(route('order.create'));
    }
    public function signIn(){
        $settings=Setting::first();
        return view('design.signin',compact('settings'));
    }
    public function checked(Request $request){
        if (auth('client_web')->attempt(['phone' => $request->input('phone'),'password' => $request->input('password')])){
            return redirect(route('order.create'));
        }
        else {
            return redirect(route('signin'));
        }
    }
    public function orderCreate(){
        $settings=Setting::first();
        return view('design.order-create',compact('settings'));
    }
    public function orderStore(Request $request){
        $validator=  validator()->make($request->all(),[
            'blood_type_id' => 'required',
//            'client_id'     => 'required',
            'age'           => 'required',
            'bags_number'   => 'required',
            'hospital_name' => 'required',
            'hospital_address'=> 'required',
            'phone'         => 'required',
            'city_id'       =>'required',
            'notice'        =>'required'
        ]);
        if($validator->fails()){
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }
        $order= auth('client_web')->user()->orders()->create($request->all());
        $clientIds=$order->city->governorate
            ->clients()->whereHas('bloodTypes',function($q) use($request,$order){
                $q->where('blood_types.id',$request->blood_type_id);
            })->pluck('clients.id')->toArray();
        //dd($clientIds);
        if(count($clientIds)>0){
            $notification=$order->notifications()->create([
                'title'=>'يوجد حاله تبرع قريبه منك',
                'body' =>$order->bloodType->name . 'محتاج متبرع لفصيله',
                'order_id' =>$order->id,
            ]);
            //attach clients to notifications
            $notification->clients()->attach($clientIds);
            $tokens = Token::where('token', '!=', null)->whereIn('client_id', $clientIds)->pluck('token')->toArray();
            //return $tokens;
            if (count($tokens) > 0) {
                $title= $notification->title;
                $body = $notification->body;
                $data = [
                    'order_id' => $order->id
                ];
                $send = notifyByFirebase($title, $body, $tokens, $data);
                info("firebase result: " . $send);
                //  info("data: " . json_encode($data));
            }
        }
        return redirect()->back();
    }
    public function resetPassword(){
        $settings=Setting::first();
        return view('design.reset-password',compact('settings'));
    }
    public function ressetpassword(Request $request){
        $validator=  validator()->make($request->all(),[
            'phone'  => 'required'
        ]);
        if($validator->fails()){
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }
        $user = Client::where('phone',$request->phone)->first();
        if($user){
            $code = rand(1111,9999);
            $user->update(['pin_code' => $code]);
            Mail::to($user->email)
                ->send(new ResetPassword($user));
            return redirect(route('newpassword'));
        }else{
            return redirect(route('resetpassword'));
        }
    }
    public function newPassword(){
        $settings=Setting::first();
        return view('design.new-password',compact('settings'));
    }
    public function neewpassword(Request $request){
        $validator=  validator()->make($request->all(),[
            'pin_code' => 'required|min:4',
            //'phone'    => 'required',
            'password' => 'required|confirmed',
        ]);
        if($validator->fails()){
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }
        $client = Client::where('pin_code',$request->pin_code)->first();//where('phone',$request->phone)->
        if($client)
        {
            $client->update(['pin_code' => null, 'password' => bcrypt($request->password)]);
            return redirect(route('signin'));
        }
        else{
            return redirect(route('newpassword'));
        }
    }




}
