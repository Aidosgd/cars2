<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tire extends Model
{
    protected $fillable = [
      'user_id', 'brand_id', 'model_title', 'width_id',
        'height_id', 'diameter_id', 'season_id', 'city_id',
        'availability_id', 'image', 'content', 'price', 'active'
    ];
    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function width(){
        return $this->belongsTo(Width::class);
    }

    public function height(){
        return $this->belongsTo(Height::class);
    }

    public function diameter(){
        return $this->belongsTo(Diameter::class);
    }

    public function availability(){
        return $this->belongsTo(Availability::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function season(){
        return $this->belongsTo(Season::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'tire_id');
    }
}
