<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function deal()
    {
        return $this->belongsTo('App\Deal');
    }
}
