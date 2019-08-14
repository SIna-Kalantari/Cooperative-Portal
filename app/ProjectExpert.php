<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectExpert extends Model
{
    protected $table = 'project_experts';
    
    public $timestamps = false;

    protected $fillable = [
        'projectId', 'expertId'
    ];


    public function project(){
        return $this->belongsTo('App\Project');
    }

    public function expert(){
        return $this->belongsTo('App\Expert');
    }
}
