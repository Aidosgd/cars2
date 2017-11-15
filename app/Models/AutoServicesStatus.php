<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AutoServicesStatus extends Model
{
    protected $table = 'auto_services_statuses';

    protected $fillable = [
        'title', 'slug'
    ];
}
