<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Offer extends Model
{
    protected $fillable = [
        'active', 'category_id', 'manufacturer', 'partnumber',
        'title', 'description', 'price', 'phone', 'address',
        'condition_id', 'city_id', 'delivery_id', 'vehicle_brand_id', 'user_id',
        'availability_id', 'tire_width_id', 'tire_height_id', 'diameter_id', 'tire_season_id',
        'tire_brand_id', 'rim_type_id', 'rim_width_id', 'rim_pcd_id', 'rim_et_id', 'rim_dia_id', 'condition_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function tireBrands()
    {
        return $this->belongsTo(TireBrand::class);
    }

    public function category()
    {
      return $this->belongsTo(Category::class);
    }

    public function vehicleBrand()
    {
        return $this->belongsTo(VehicleBrand::class);
    }

    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }

    public function availability()
    {
        return $this->belongsTo(Availability::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    public function tireWidth()
    {
        return $this->belongsTo(TireWidth::class);
    }

    public function tireHeight()
    {
        return $this->belongsTo(TireHeight::class);
    }

    public function diameter()
    {
        return $this->belongsTo(Diameter::class);
    }

    public function tireSeason()
    {
        return $this->belongsTo(TireSeason::class);
    }

    public function tireBrand()
    {
        return $this->belongsTo(TireBrand::class);
    }

    public function rimType()
    {
        return $this->belongsTo(RimType::class);
    }

    public function rimWidth()
    {
        return $this->belongsTo(RimWidth::class);
    }

    public function rimPcd()
    {
        return $this->belongsTo(RimPcd::class);
    }

    public function rimEt()
    {
        return $this->belongsTo(RimEt::class);
    }

    public function rimDia()
    {
        return $this->belongsTo(RimDia::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'offer_id');
    }

    public function offerViews()
    {
        return $this->hasOne(OfferViews::class);
    }

    public function getImage($id)
    {
        $image = Image::where('offer_id', $id)->first();
        if($image == null){
            return 'logo2.svg';
        }else{
            return $image->name;
        }
    }

    public function comments()
    {
        return $this->hasMany(OfferComment::class)->whereNull('parent_id')->with('children');
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = str_replace(' ','',$value);
    }

    public function formattedPrice()
    {
        return number_format($this->price, 0, '', ' ');
    }

    public function getSlug()
    {
        return Str::slug($this->title);
    }
}
