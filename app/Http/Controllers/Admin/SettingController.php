<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;
use App\Models\Setting;
use App\Http\Controllers\Controller;


class SettingController extends Controller
{
    //
    public function setting(){
        $setting=Setting::first();

        return view('admin.settings.index', compact('setting'));
    }

    public function update(Request $request){
        $this->validate($request,
            [
                'email'=>'email',
                'link_video_ru'=>'required',
            ],[
                'email.email'=>'Неправылный формат Email!',
                'link_video_ru.required'=>'Введите ссылка видео на Youtube (Ru)',
            ]

        );
        $input=$request->all();
        $setting=Setting::first();

        if($setting->logo_tj==""||$request->file('logo_tj')!=""){
            $this->validate($request,[
                'logo_tj'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=40,min_height=40',
            ],[
                'logo_tj.required'=>'Загрузить картинку',
                'logo_tj.dimensions' => 'Картина доллжна быть 40x40 px',
                'logo_tj.mimes' => 'Формат картины должен быть (jpeg,png,jpg,gif,svg)',
                'logo_tj.max' => 'Размер картины должна быть менее 2 МБ',
                'logo_tj.image' => 'Эй, вы че? Загрузите картину!',
            ]);
            $input['logo_tj']=$this->uploadFile('uploads/settings',$request->file('logo_tj'),null,$setting->logo_tj);
        }

    //  dd($setting->logo_ru==""||$request->file('logo_ru')!="");
        if($setting->logo_ru==""||$request->file('logo_ru')!=""){

            $this->validate($request,[
                'logo_ru'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:width=180,height=60',
            ],[
                'logo_ru.required'=>'Загрузить картинку',
                'logo_ru.dimensions' => 'Картина доллжна быть 180x60 px',
                'logo_ru.mimes' => 'Формат картины должен быть (jpeg,png,jpg,gif,svg)',
                'logo_ru.max' => 'Размер картины должна быть менее 2 МБ',
                'logo_ru.image' => 'Эй, вы че? Загрузите картину!',
            ]);
            $input['logo_ru']=$this->uploadFile('uploads/settings',$request->file('logo_ru'),null,$setting->logo_ru);
        }


        if($setting->logo_en==""||$request->file('logo_en')!=""){
            $this->validate($request,[
                'logo_en'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=40,min_height=40',
            ],[
                'logo_en.required'=>'Загрузить картинку',
                'logo_en.dimensions' => 'Картина доллжна быть 40x40 px',
                'logo_en.mimes' => 'Формат картины должен быть (jpeg,png,jpg,gif,svg)',
                'logo_en.max' => 'Размер картины должна быть менее 2 МБ',
                'logo_en.image' => 'Эй, вы че? Загрузите картину!',
            ]);
            $input['logo_en']=$this->uploadFile('uploads/settings',$request->file('logo_en'),null,$setting->logo_en);
        }



        if($setting->videoimage==""||$request->file('videoimage')!=""){
            $this->validate($request,[
                'videoimage'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=534,min_height=300',
            ],[
                'videoimage.required'=>'Загрузить картинку',
                'videoimage.dimensions' => 'Картина доллжна быть 535x300 px',
                'videoimage.mimes' => 'Формат картины должен быть (jpeg,png,jpg,gif,svg)',
                'videoimage.max' => 'Размер картины должна быть менее 2 МБ',
                'videoimage.image' => 'Эй, вы че? Загрузите картину!',
            ]);
            $input['videoimage']=$this->uploadFile('uploads/settings',$request->file('videoimage'),null,$setting->videoimage);
        }

        $setting->update($input);
        Log::create(["user_id"=>Auth::user()->id,"text"=>"Конфигурации сайта редактирован"]);

        return redirect('admin/setting')->with(['success_message'=>'Успешно сохранено']);
    }
}
