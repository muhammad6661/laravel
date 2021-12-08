<?php

namespace App\Http\Controllers;

use App\Models\Ministry;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class AuthController extends Controller
{


    public function index(){
        if(Auth::check()&&(Auth::user()->role_id==1||Auth::user()->role_id==2)){
            $ministry="Добро пожаловать";
            if(Auth::user()->role_id==2){
                $ministry=Ministry::where('id',Auth::user()->ministry_id)->first()->title_ru;
            }
            return view('admin.index',compact('ministry'));
        }
         return view('auth.login');
    }
    public function  login_check(Request $requset){
         $input=$requset->all();
         $validator=Validator::make($requset->all(),[
             'email'=>'required',
             'password'=>'required',
         ],[
             'email.required'
         ]);
     $user=User::where(['email'=>$input['email'],'password'=>$input['password']])->get()->first();
       if($user==""){
           $validator->errors()->add('Error','Неверный email или пароль.Попробуйте еще раз!');
       }

    if(count($validator->errors())>0){
        return redirect('/admin')->withErrors($validator);
    }
     $remember=(isset($input['remember'])&&$input['remember']=="on") ? 1 : 0;
         if($remember==1){
            Auth::loginUsingId($user->id,true);
         } else{
             Auth::loginUsingId($user->id,false);
         }
        return  redirect('/admin');
    }

     public function logout(){
         Auth::logout();
         return redirect('/');
     }


}
