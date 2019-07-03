<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectTechnology extends Model
{
    protected $table = 'project_technologies';
    
    public $timestamps = false;

    protected $fillable = [
        'projectId', 'technologyId'
    ];


    public function project(){
        return $this->belongsTo('App\Project');
    }

    public function technology(){
        return $this->belongsTo('App\Technology');
    }
}
