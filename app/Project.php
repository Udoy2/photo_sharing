<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function folders()
    {
        return $this->hasMany('App\Folder');
    }
}
