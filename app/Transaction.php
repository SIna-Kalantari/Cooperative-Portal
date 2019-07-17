<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;
    protected $table = 'transactions';
    
    public $timestamps = false;

    protected $fillable = [
        'title', 'typeId', 'amount', 'created_at'
    ];

    public function project(){
        return $this->hasOneThrough('App\Project', 'App\TransactionProject', 'transactionId', 'id', 'id', 'projectId');
    }

    public function transactionProject(){
        return $this->hasOne('App\TransactionProject', 'transactionId');
    }

    public function transactionType()
    {
        return $this->belongsTo('App\TransactionType', 'typeId')->where('deleted_at', null);
    }
}
