<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    public function categoryGroup()
    {
        return $this->belongsTo(CategoryGroup::class);
    }

    public function getSlug()
    {
        return Str::slug($this->name);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
}
