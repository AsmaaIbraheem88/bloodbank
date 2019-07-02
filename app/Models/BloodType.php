<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloodType extends Model 
{

    protected $table = 'blood_types';
    public $timestamps = true;
    protected $fillable = array('name');

    public function blood_type_clients()
    {
        return $this->hasMany('App\Models\Client');
    }

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client');
    }

    public function donation_requests()
    {
        return $this->hasMany('App\Models\DonationRequest');
    }

}