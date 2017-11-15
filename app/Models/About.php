<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class About extends Model
{
    protected $table = 'abouts';

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['url'] = Str::slug($value, '_');
    }

}
