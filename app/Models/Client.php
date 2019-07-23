<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable 
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'birth_of_date', 'blood_type_id', 'phone', 'password', 'city_id', 'last_donation_date', 'pin_code');

    public function notifications()
    {
        return $this->belongsToMany('App\Models\Notification');
    }

    public function bloodTypes()
    {
        return $this->belongsToMany('App\Models\BloodType');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function bloodType()
    {
        return $this->belongsTo('App\Models\BloodType');
    }

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function governorates()
    {
        return $this->belongsToMany('App\Models\Governorate');
    }
    public function tokens()
    {
        return $this->hasMany('App\Models\Token');
    }
    protected $hidden = [
        'password', 'api_token',
    ];
}