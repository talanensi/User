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
}
