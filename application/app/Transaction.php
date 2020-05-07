<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $fillable = [
        'client_id', 'deal_id', 'accepted', 'refused', 'created_at'
    ];
    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function deal()
    {
        return $this->belongsTo('App\Deal');
    }
}
