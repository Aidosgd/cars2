<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferViews extends Model
{
    protected $fillable = [
        'views_count', 'offer_id'
    ];
}
