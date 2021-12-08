<?php
namespace App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;

  class LocalValue
  {
 static function getValue($value_tj,$value_ru,$value_en){
    return App::getLocale()=="tj" ? $value_tj : (App::getLocale()=="ru" ? $value_ru : $value_en);
  }
}
?>
