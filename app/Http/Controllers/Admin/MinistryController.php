<?php

namespace App\Http\Controllers\Admin;
use App\Models\Ministry;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\CssSelector\Node\FunctionNode;

class MinistryController extends Controller
{

    public function index(){
        $ministries=Ministry::orderBy('created_at','desc')->paginate(15);
        return view('admin.ministry.index',compact('ministries'));
    }

    public function store(Request $request){
        $input=$request->all();
        $input['user_id']=Auth::user()->id;
        Ministry::create($request->all());
        // Session::flush(['success_message'=>'Успешно добавлено!']);
         return response()->json(200);
    }

    public Function edit($id){
       $ministry=Ministry::findOrFail($id);
       $html=View::make('admin.ministry._edit',compact('ministry'))->render();
       return response()->json(['html'=>$html],200);
    }

    public function update(Request $request,$id){
        $ministry=Ministry::findOrFail($id);
        $ministry->update($request->all());
        // Session::flush(['success_message'=>'Успешно сохранено!']);
        return response()->json(['err'=>0],200);
    }

    public function destroy($id){
        $ministry=Ministry::findOrFail($id)->delete();
        return redirect()->back()->with(['success_message'=>'Успешно удалено!']);
    }

    public function active($id){
        $ministry=Ministry::findORFail($id);
        $ministry->is_active=!$ministry->is_active;
        $ministry->save();
        return response()->json($ministry->is_active,200);
    }

}
