<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferComment extends Model
{
    protected $fillable = [
        'name', 'email', 'text', 'offer_id', 'parent_id',
    ];

    public function parent()
    {
        return $this->belongsTo(OfferComment::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(OfferComment::class, 'parent_id', 'id');
    }
}
