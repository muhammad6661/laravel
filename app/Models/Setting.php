<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable=[
        'home_description_tj',
        'home_description_ru',
        'home_description_en',
        'title_tj',
        'title_ru',
        'title_en',
        'logo_tj',
        'logo_ru',
        'logo_en',
        'phone',
        'email',
        'appeal_email',
        'address_tj',
        'address_ru',
        'address_en',
        'link_instagram',
        'link_facebook',
        'link_telegram',
        'link_youtube' ,
        'title_logo_tj',
        'title_logo_ru',
        'title_logo_en',
        'videoimage',
        'link_video_ru',
        'link_video_tj',
        'link_video_en',
    ];
}
