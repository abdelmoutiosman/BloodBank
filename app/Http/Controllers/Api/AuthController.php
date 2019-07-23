<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPassword;
use App\Models\Token;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function register(Request $request){
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
        return responseJson(1, 'تم الاضافه بنجاح', [
            'api_token' => $client->api_token,
            'client'    => $client
        ]);
    }
    public function login(Request $request){
       $validator=  validator()->make($request->all(),[
            'phone'    => 'required',
            'password' => 'required'          
        ]);
        if($validator->fails()){
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        } 
        $clients= Client::where('phone',$request->phone)->first();
        if($clients){
            if(hash::check($request->password,$clients->password)){
               return responseJson(1, 'تم تسجيل الدخول', [
                   'api_token'=> $clients->api_token,
                   'client'   => $clients
               ]); 
            }
            else {
                return responseJson(0,'بيانات الدخول غير صحيحه');
            }
        }
        else {
            return responseJson(0,'بيانات الدخول غير صحيحه');
        }
    } 
    public function profile(Request $request){
        $user=$request->user();
        $validator=  validator()->make($request->all(),[
            'name'         => 'required',
            'email'        => 'required',Rule::unique('clients', 'email')->ignore($user->id),
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
        $user->update($request->all());
        $user->save();
        return responseJson(1, 'تم التعديل بنجاح', $user);  
    }  
    public function resetPassword(Request $request){
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
            return responseJson(1, 'برجاء فحص التلفون');   
        }else{
            return responseJson(0,'رقم التلفون غير موجود');
        }
    }
    /*
    public function resetpassword(Request $request ){
        $validator=  validator()->make($request->all(),[
            'email' => 'required'
        ]);
        if($validator->fails()){
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }
         $user = Client::where('email',$request->email)->first();
        if($user){
            $code = rand(1111,9999);
            $update = $user->update(['pin_code' => $code]);
            if($update)
            {            
               //send sms
                Mail::to($user->email)
                    ->bcc("Tests@test.com")
                    ->send(new ResetPassword($code));
            return responseJson(1,'برجاء فحص الايميل',['pin_code_for_test' => $code]);
            }else{
            return responseJson(0,'حدث خطا , حاول مره اخرى');
            }
        }else{
            return responseJson(0,'لا يوجد اى حساب مرتبط بهذا الايميل');
        }
    }          
    */
    public function newPassword(Request $request){
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
                return responseJson(1,'تم تغيير كلمة المرور بنجاح');
            }
            else{
                return responseJson(0,'هذا الكود غير صالح');
            }
    }
    public function registerToken(Request $request){
        $validator=  validator()->make($request->all(),[
            'token' => 'required',
            'type'    => 'required|in:android,ios'          
        ]);
        if($validator->fails()){
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }
        Token::where('token',$request->token)->delete();
        $request->user()->tokens()->create($request->all());
        return responseJson(1,'تم التسجيل بنجاح');         
    }
    public function removeToken(Request $request){
        $validator=  validator()->make($request->all(),[
            'token' => 'required',                 
        ]);
        if($validator->fails()){
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }
        Token::where('token',$request->token)->delete();
        return responseJson(1,'تم الحذف بنجاح');  
    }
}
