<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expert extends Model
{
    use SoftDeletes;
    protected $table = 'experts';
    
    public $timestamps = false;

    protected $fillable = [
        'title'
    ];

    public function projectExpert(){
        return $this->hasMany('App\Expert', 'projectId', 'expertId');
    }
}
