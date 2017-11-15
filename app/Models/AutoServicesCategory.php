<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AutoServicesCategory extends Model
{
    protected $table = 'auto_services_categories';

    protected $fillable = [
        'title', 'slug'
    ];
}
