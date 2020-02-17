<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplatePart extends Model
{
    public function template()
    {
        return $this->belongsToMany('App\Template');
    }
}
