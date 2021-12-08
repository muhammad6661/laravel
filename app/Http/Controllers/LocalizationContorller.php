<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
class LocalizationContorller extends Controller
{

   public function index($lang){
       session(['locale'=>$lang]);
       App::setLocale(session('locale'));
       return redirect()->back();
   }
}
