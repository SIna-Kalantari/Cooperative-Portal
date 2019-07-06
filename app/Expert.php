<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expert extends Model
{
    protected $table = 'experts';
    
    public $timestamps = false;

    protected $fillable = [
        'title'
    ];

    public function projectExpert(){
        return $this->hasMany('App\Expert', 'projectId', 'expertId');
    }
}
