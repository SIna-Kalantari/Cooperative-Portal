<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Technology extends Model
{
    use SoftDeletes;
    protected $table = 'technologies';
    
    public $timestamps = false;

    protected $fillable = [
        'title'
    ];

    public function technologyRelations(){
        return $this->hasMany('App\ProjectTechnology', 'technologyId');
    }
}
