<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationRequest extends Model 
{

    protected $table = 'donation_requests';
    public $timestamps = true;
    protected $fillable = array('patient_name', 'age', 'blood_type_id', 'bags_num', 'hospital_name', 'phone', 'city_id', 'latitude', 'longitude', 'notes', 'hospital_address', 'client_id');

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification');
    }

    public function blood_type()
    {
        return $this->belongsTo('App\Models\BloodType');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

}