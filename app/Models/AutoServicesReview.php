<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AutoServicesReview extends Model
{
    protected $table = 'auto_service_reviews';

    protected $fillable = [
        'name', 'email', 'text', 'points', 'auto_service_id'
    ];
}
