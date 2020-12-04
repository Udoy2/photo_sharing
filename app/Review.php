<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function client()
    {
        return $this->hasOne('App\User', 'id', 'client_id');
    }
}
