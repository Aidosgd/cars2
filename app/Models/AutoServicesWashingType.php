<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AutoServicesWashingType extends Model
{
    protected $table = 'auto_services_washing_types';

    protected $fillable = [
        'title', 'slug'
    ];
}
