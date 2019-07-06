<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserProject extends Model
{
    use SoftDeletes;
    protected $table = 'user_projects';
    
    public $timestamps = false;

    protected $fillable = [
        'projectId', 'userId', 'workCost', 'created_at'
    ];


    public function project(){
        return $this->belongsTo('App\Project', 'projectId');
    }

    public function user(){
        return $this->belongsTo('App\User', 'userId');
    }
}
