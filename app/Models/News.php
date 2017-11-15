<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    protected $table = 'news';

    public function setTitleAttribute($value)
    { 
    	$this->attributes['title'] = $value;
    	$this->attributes['url'] = Str::slug($value, '_');
    }
}
