<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Log;
use App\Models\UsefullLink;
use App\Http\Controllers\Controller;
use App\Models\User;

class Usefull_linkController extends Controller
{
    //
    public function index(){

        return view('admin.usefull_links.index',[
            'usefull_link'=>UsefullLink::orderby('created_at','desc')->paginate(15),]);
    }



    public function create_link(){
        return view('admin.usefull_links.usefull_create');
    }

    public function store_link(Request $request){
        $this->validate($request,[
            'title_ru'=>'required',
            'logo'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=40,min_height=40',
        ],[
            'title_ru.required'=>'Введите заголовок RU!',
            'logo.required'=>'Загрузить картинку на логотип!',
            'logo.dimensions' => 'Картина доллжна быть 40x40 px',
            'logo.mimes' => 'Формат картины должен быть (jpeg,png,jpg,gif,svg)',
            'logo.max' => 'Размер картины должна быть менее 2 МБ',
            'logo.image' => 'Эй, вы че? Загрузите картину!',
        ]);
        $input=$request->all();
        $input['logo']=$this->uploadFile('uploads/links',$request->file('logo'));
        $link=UsefullLink::create($input);

        Log::create(["user_id"=>Auth::user()->id,"text"=>"Строка номера ".$link->id." добавлен в таблице Useful_Link"]);
       return redirect('/admin/usefull_links')->with(['success_message'=>'Успешно добавлено!']);
    }
    public function edit($id){
        $link=UsefullLink::findorfail($id);
        return view('admin.usefull_links.edit',compact('link'));
    }
    public function update_link(Request $request,$id){
        $link=UsefullLink::findOrFail($id);
        $input=$request->all();
        $this->validate($request,[
            'title_ru'=>'required',
          ],[
            'title_ru.required'=>'Введите заголовок RU!',
        ]);
        if($link->logo==""|| $request->file('logo')!=""){
        $this->validate($request,[
            'logo'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=40,min_height=40',
        ],[
            'logo.required'=>'Загрузить картинку на логотип!',
            'logo.dimensions' => 'Картина доллжна быть 40x40 px',
            'logo.mimes' => 'Формат картины должен быть (jpeg,png,jpg,gif,svg)',
            'logo.max' => 'Размер картины должна быть менее 2 МБ',
            'logo.image' => 'Эй, вы че? Загрузите картину!',
        ]);
        $input['logo']=$this->uploadFile('uploads/links',$request->file('logo'),null,$link->logo!="" ? $link->logo : null);
    }
        $link->update($input);
        Log::create(["user_id"=>Auth::user()->id,"text"=>"Строка номера ".$link->id." редактирован в таблице Useful_Link"]);
        return redirect('/admin/usefull_links/')->with(['success_message'=>'Успешно сохранено!']);
    }


    public function delete_link($id){
        $link=UsefullLink::findOrFail($id);
         if($link->logo!=""){
            unlink('public/uploads/links/'.$link->logo);
         }
        $link->delete();
        Log::create(["user_id"=>Auth::user()->id,"text"=>"Строка номера ".$id." удален из таблици Useful_Link"]);
        return redirect()->back()->with(['success_message'=>'Успешно удалено!']);
    }

    public function active($id){
        $link=UsefullLink::findorFail($id);
        $is_active=$link->is_active?' деактивирована': ' активирована';
        $link->is_active=!$link->is_active;
        $link->save();
        Log::create(["user_id"=>Auth::user()->id,"text"=>"Ссылка номера ".$link->id. $is_active]);
        return response()->json($link->is_active, 200);

    }
}
