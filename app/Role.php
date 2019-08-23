<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    
    public $timestamps = false;

    protected $fillable = [
        'title'
    ];

    public function accessibilities(){
        return $this->hasManyThrough('App\Accessibility', 'App\RoleAccess', 'roleId', 'id', 'id', 'accessId');
    }

    public function roleAccess(){
        return $this->hasMany('App\RoleAccess', 'roleId');
    }
}
