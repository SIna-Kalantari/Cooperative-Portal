<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accessibility extends Model
{
    protected $table = 'accessibilities';
    
    public $timestamps = false;

    protected $fillable = [
        'title'
    ];

    public function roles(){
        return $this->hasManyThrough('App\Role', 'App\RoleAccess');
    }
}
