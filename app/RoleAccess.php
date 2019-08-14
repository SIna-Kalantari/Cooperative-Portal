<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleAccess extends Model
{
    protected $table = 'role_access';
    
    public $timestamps = false;

    protected $fillable = [
        'roleId', 'accessId'
    ];

    public function role(){
        return $this->belongsTo('App\Role', 'roleId');
    }

    public function access(){
        return $this->belongsTo('App\Accessibility', 'accessId');
    }
}
