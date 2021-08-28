<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;

    protected $table= 'user';

    protected $fillable = [
        'id',
        'fname',
        'lname',
        'gender',
        'dob',
        'email',
        'mobile',
        'password',
        'hobbies',
        'image',
        'country',
        'state',
        'city',
        'status'
    ];
    protected $hidden =[
        'create_at',
        'update_at'
    ];

    public function getImageAttribute($value)
    {
        return $value ? asset('storage/image'.'/'.$value) : NULL;
    }

    public function Country_data() {
        return $this->belongsTo(Country::class,'country','id')->select('id','country_name');
    }
    
    public function State_data() {
        return $this->belongsTo(State::class,'state','id')->select('id','state_name');
    }

    public function City_data() {
        return $this->belongsTo(City::class,'city','id')->select('id','city_name');
    }
}
