<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('blood_type_id', 'client_id', 'age', 'bags_number', 'hospital_name', 'hospital_address', 'longitude', 'latitude', 'phone', 'city_id', 'notice');

    public function BloodType()
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

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification');
    }
    public function notification()
    {
        return $this->hasOne('App\Models\Notification');
    }

}