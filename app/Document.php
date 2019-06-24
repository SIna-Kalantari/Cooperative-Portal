<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'documents';
    
    public $timestamps = false;

    protected $fillable = [
        'title' ,'type', 'destination', 'projectId', 'created_at'
    ];

    public function project(){
        return $this->belongsTo('App\Project', 'projectId');
    }
}
