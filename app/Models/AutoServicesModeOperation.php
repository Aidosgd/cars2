<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AutoServicesModeOperation extends Model
{
    protected $table = 'auto_services_mode_operations';

    protected $fillable = [
        'title', 'slug'
    ];
}
