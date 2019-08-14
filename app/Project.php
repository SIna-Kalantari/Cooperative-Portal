<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    
    public $timestamps = false;

    protected $fillable = [
        'title' ,'totalPrice', 'clientName', 'projectAdminId', 'marketerId', 'descriptions', 'starting_at', 'ending_at', 'ended_at', 'status'
    ];

    public function transactions(){
        return $this->hasManyThrough('App\Transaction', 'App\TransactionProject');
    }

    public function users(){
        return $this->belongsToMany('App\User', 'user_projects', 'projectId', 'userId');
    }

    public function usersRelation(){
        return $this->hasMany('App\UserProject', 'projectId');
    }

    public function experts(){
        return $this->belongsToMany('App\Expert', 'project_experts', 'projectId', 'expertId');
    }

    public function expertsRelation(){
        return $this->hasMany('App\ProjectExpert', 'projectId');
    }

    public function projectAdmin(){
        return $this->belongsTo('App\User', 'projectAdminId');
    }

    public function marketer(){
        return $this->belongsTo('App\User', 'marketerId');
    }

    public function document(){
        return $this->hasMany('App\Document', 'projectId');
    }

    public function technologies(){
        return $this->belongsToMany('App\Technology', 'project_technologies', 'projectId', 'technologyId');
    }

    public function technologiesRelation(){
        return $this->hasMany('App\ProjectTechnology', 'projectId');
    }
}
