<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
    public function client()
    {
        return $this->hasOne('App\User', 'id', 'client_id');
    }

    public function project()
    {
        return $this->hasOne('App\Project', 'id', 'project_id');
    }
}
