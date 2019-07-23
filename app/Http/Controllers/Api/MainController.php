<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Governorate;
use App\Models\City;
use App\Models\Category;
use App\Models\Post;
use App\Models\Contact;
use App\Models\BloodType;
use App\Models\Setting;
use App\Models\Token;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Client;

class MainController extends Controller
{   
    public function governorates(){       
        $governorates= Governorate::all();
        return responseJson(1, 'success', $governorates);
    }
    public function cities(Request $request){  
        $cities= City::with('governorate')->where(function ($query) use($request){
            if($request->has('governorate_id')){
                $query->where('governorate_id',$request->governorate_id);
            }
        })->paginate(10);
        if($cities->count() < 1){
            return responseJson(0,'no results found');
        }
        return responseJson(1, 'success', $cities);
    }
    public function bloodTypes(){
        $blood_types= BloodType::all();
        return responseJson(1, 'success', $blood_types);
    }
    public function contacts(Request $request){
        $validator=  validator()->make($request->all(),[
            'phone' => 'required|unique:contacts',
            'title' => 'required',
            'body'  => 'required',                   
        ]);
        if($validator->fails()){
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }
        $contacts= Contact::create($request->all());
        return responseJson(1,'تم الاضافه بنجاح', $contacts);
    }
    public function settings(){
        $settings= Setting::all();
        return responseJson(1, 'success', $settings);
    } 
    public function categories(){
        $categories= Category::all();
        return responseJson(1, 'success', $categories);
    }
    public function posts(Request $request){
        $posts=  Post::with('category')->where(function ($query) use($request){
            if($request->has('title')){
                $query->where('title',$request->title);
            }
        })->paginate(10); /* the name of relation from the model*/
        if($posts->count() < 1){
            return responseJson(0,'no results found');
        }
        return responseJson(1, 'success', $posts);
    }  
    public function favourites(Request $request){
        $validator=  validator()->make($request->all(),[
            //'client_id'=> 'required|exists:clients,id',
            'post_id'  => 'required|exists:posts,id',                  
        ]);
        if($validator->fails()){
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }
        $id=auth('api')->user()->id;
        $postId=$request->post_id;
        $user= Client::find($id);
        $post=$user->posts()->toggle($postId);
        if($post['attached']){
            return responseJson(1, 'مفضل');
        }
        elseif($post['detached']){
            return responseJson(0, 'غير مفضل');
        }
//        $post = $request->user()->posts()->toggle($request->post_id);
//        if($post['attached']){
//            return responseJson(1, 'مفضل');
//        }
//        elseif($post['detached']){
//            return responseJson(0, 'غير مفضل');
//        }
    }
    public function notifications(){
        $notifications= Notification::all();
        return responseJson(1, 'success', $notifications);
    }
    public function notificationCount(Request $request){
        $count=$request->user()->notifications()->where(function ($query) use ($request){
            $query->where('is_read',0);
        })->count();
        return responseJson(1, 'success', ['notification_count'=>$count]);
    }
    public function notificationRead(Request $request)
    {
        $order = Order::with('client', 'city', 'BloodType')->find($request->order_id);
        if($order->count() < 1){
            return responseJson(0,'no results found');
        }
        $request->user()->notifications()->updateExistingPivot($order->notification->id,['is_read'=>1]);
        return responseJson(1, 'success', $order);
    }
    public function notificationSettings(Request $request){
        $validator=  validator()->make($request->all(),[
            'governorate_id'=> ['array', 'required'],
            'blood_type_id' => ['array', 'required'],                  
        ]);
        if($validator->fails()){
            return responseJson(0, 'validation error', $validator->masseges());
        } 
        $client = auth()->user();
        $client->bloodTypes()->sync($request->blood_type_id);
        $client->governorates()->sync($request->governorate_id);
        return responseJson(1, 'تم ضبط الإشعارات بنجاح', [$client->bloodTypes()->get(), $client->governorates()->get()]);
    } 
    public function getNotificationSettings(){
        $client = auth()->user();
        $bloodtype=$client->bloodTypes()->get();
        $government=$client->governorates()->get();
        return responseJson(1, 'اعدادات الاشعارات', [$bloodtype, $government]);
    } 
    public function orders(Request $request){
        $validator=  validator()->make($request->all(),[
            'blood_type_id' => 'required',
            'client_id'     => 'required',
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
        $order= Order::create($request->all());
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
        return responseJson(1,'تم الاضافه بنجاح',$order);  
    }
    public function allOrders(Request $request)
    {
        $orders = Order::with('client', 'city', 'BloodType')->where(function ($query) use ($request) {
            if ($request->has('blood_type_id', 'city_id')) {
                $query->where(['blood_type_id' => $request->blood_type_id, 'city_id' => $request->city_id]);
            }
        })->paginate(10);
        if($orders->count() < 1){
            return responseJson(0,'no results found');
        }
        return responseJson(1, 'success', $orders);
    }
}
