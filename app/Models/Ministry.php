<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\MOdels\User;
class Ministry extends Model
{
    use HasFactory;
  protected $fillable=['title_ru','title_tj','title_en','is_active','user_id'];

 public function user(){
      return $this->belongsTo(User::class,'id','ministry_id');
 }
}
