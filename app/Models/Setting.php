<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model 
{

    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('phone', 'email', 'about_msg', 'facebook_link', 'twitter_link', 'youtube_link', 'whatsapp_link', 'instagram_link');

}