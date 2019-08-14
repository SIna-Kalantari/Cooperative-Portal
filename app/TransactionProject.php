<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionProject extends Model
{
    use SoftDeletes;
    protected $table = 'transaction_projects';
    
    public $timestamps = false;

    protected $fillable = [
        'transactionId', 'projectId', 'updated_at', 'created_at'
    ];

    public function transaction(){
        return $this->belongsTo('App\Transaction', 'transactionId');
    }

    public function project(){
        return $this->belongsTo('App\Project', 'projectId');
    }
}
