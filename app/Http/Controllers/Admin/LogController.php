<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class LogController extends Controller
{
    //
    public function index(){
        $date_from="";
        $date_to="";
        if(isset($_COOKIE['date_from'])){
            $date_from=$_COOKIE['date_from'];
        }
        if(isset($_COOKIE['date_to'])){
            $date_to=$_COOKIE['date_to'];
        }
       if($date_from==""){
         if($date_to==""){
             $logs=Log::orderBy('created_at','desc')->get();
         }else{
             $logs=Log::where('created_at','<=',$date_to)->orderBy('created_at','desc')->get();
         }
       }else{
        if($date_to==""){
            $logs=Log::where('created_at','>=',$date_from)->orderBy('created_at','desc')->get();
        }else{
            $logs=Log::whereBetween('created_at',array($date_from,$date_to))->orderBy('created_at','desc')->get();
        }
       }
        return view('admin.log.index', compact('logs'));
    }

    public function logs_destroy(Request $request){
       $logs=explode(',',$request->get('logs'));

        if($request->get('logs')!=""){
            foreach($logs as $item){
                Log::where('id',$item)->delete();
            }
        }
       Session::flash('success_message','Успешно удалено!');
       return response()->json(200);
    }

   public function destroy($id){
       Log::findOrFail($id)->delete();
       return redirect()->back()->with(['success_message'=>'Успешно удалено!']);
   }
    public function filte_date_from($date){
        setcookie('date_from',$date,time()+3600,'/admin/log');
        return response()->json(200);
    }
    public function filte_date_to($date){
        setcookie('date_to',$date,time()+3600,'/admin/log');
        return response()->json(200);
    }
}
