<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AutoService extends Model
{
    protected $table = 'auto_services';

    protected $fillable = [
        'title', 'slug', 'active', 'auto_services_status_id',
        'auto_services_category_id', 'address', 'phone',
        'web_site', 'description', 'map', 'auto_services_mode_operation_id',
        'city_id', 'user_id'
    ];

    public function autoServicesCategory()
    {
        return $this->belongsTo(AutoServicesCategory::class, 'auto_services_category_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'auto_service_id');
    }

    public function getImage($id)
    {
        $image = Image::where('auto_service_id', $id)->first();
        if($image == null){
            return 'logo2.svg';
        }else{
            return $image->name;
        }
    }

    public function reviews()
    {
        return $this->hasMany(AutoServicesReview::class, 'auto_service_id');
    }

    public function reviewCount($id)
    {
        $offer = AutoService::where('id', $id)->first();
        $count = $offer->reviews->count();

        if($count === 0){
            return 0;
        }else{
            $i = 0;
            foreach ($offer->reviews as $review){
                $i = $review->points + $i;
            }
            return $i / $count;
        }
    }
}
