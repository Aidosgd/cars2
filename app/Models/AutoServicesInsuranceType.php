<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AutoServicesInsuranceType extends Model
{
    protected $table = 'auto_services_insurance_types';

    protected $fillable = [
        'title', 'slug'
    ];
}
