<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    protected $table = 'technologies';
    
    public $timestamps = false;

    protected $fillable = [
        'title'
    ];

    public function technologyRelations(){
        return $this->hasMany('App\ProjectTechnology', 'technologyId');
    }
}
