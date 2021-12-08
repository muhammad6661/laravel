<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsefullLink extends Model
{
    use HasFactory;
    protected $fillable=['title_tj','link_tj','title_ru','link_ru','title_en','link_en','logo'];
}
