<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionType extends Model
{
    use SoftDeletes;
    protected $table = 'transaction_types';
    
    public $timestamps = false;

    protected $fillable = [
        'title'
    ];

    public function typeRelations(){
        return $this->hasMany('App\Transaction', 'typeId');
    }
}
