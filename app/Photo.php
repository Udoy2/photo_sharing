<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $guarded = [];
    public function folder()
    {
        return $this->hasOne('App\Folder', 'id', 'folder_id');
    }
}
