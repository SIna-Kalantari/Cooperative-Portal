<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes;
    protected $table = 'documents';
    
    public $timestamps = false;

    protected $fillable = [
        'title' ,'type', 'size', 'destination', 'projectId', 'created_at'
    ];

    public function project(){
        return $this->belongsTo('App\Project', 'projectId');
    }
}
