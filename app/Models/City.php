<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table= 'city';

    protected $fillable = [
        'id',
        'state_id',
        'city_name'
    ];
    
    public function State_data() {
        return $this->belongsTo(State::class,'state_id','id');
    }
}
