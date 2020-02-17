<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    public function templates()
    {
        return $this->belongsToMany('App\Template')->using('App\PersonTemplate');
    }
}
