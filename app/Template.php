<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    public function people()
    {
        return $this->belongsToMany('App\Person')->using('App\PersonTemplate');
    }

    public function template_parts()
    {
        return $this->belongsToMany('App\TemplatePart');
    }
}
