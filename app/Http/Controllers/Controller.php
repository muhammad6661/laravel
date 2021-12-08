<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function uploadFile ($path,$file,$name=null,$old_file=null){
        if($name==""){
            $name=time().''.Str::random(64);
        }
       $name=$name.'.'.$file->getClientOriginalExtension();
       $name=str_replace('/','',$name);
       $file->move('public/'.$path,$name);
       if($old_file!=""){
           if(file_exists('public/'.$path.'/'.$old_file))
           unlink('public/'.$path.'/'.$old_file);
       }
   return $name;
    }

      public function unlinkFile($path){
          if(file_exists($path)){
              unlink($path);
          }
      }


}
