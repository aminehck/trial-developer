<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    //
    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }
}
