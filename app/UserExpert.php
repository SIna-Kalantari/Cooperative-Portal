<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserExpert extends Model
{
    protected $table = 'user_experts';
    
    public $timestamps = false;

    protected $fillabe = [
        'userId', 'expertId'
    ];


    public function user(){
        return $this->belongsTo('App\User');
    }

    public function expert(){
        return $this->belongsTo('App\Expert');
    }
}
