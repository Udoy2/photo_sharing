<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];
    public function folders()
    {
        return $this->hasMany('App\Folder');
    }
}
