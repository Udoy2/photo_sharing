<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function photos()
    {
        return $this->hasMany('App\Photo');
    }

}
