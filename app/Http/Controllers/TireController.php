<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use App\Models\Brand;
use App\Models\City;
use App\Models\Diameter;
use App\Models\Height;
use App\Models\Season;
use App\Models\Tire;
use App\Models\Width;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class TireController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth::user();
        $seasons = Season::orderBy('name', 'asc')->get();
        $width = Width::orderBy('name', 'asc')->get();
        $height = Height::orderBy('name', 'asc')->get();
        $diameter = Diameter::orderBy('name', 'asc')->get();
        $brands = Brand::orderBy('name', 'asc')->get();
        $city = City::orderBy('name', 'asc')->get();
        $availability = Availability::orderBy('name', 'asc')->get();

        $season = $request->input('season_id');
        $brand = $request->input('brand_id');
        $width_id = $request->input('width_id');
        $height_id = $request->input('height_id');
        $diameter_id = $request->input('diameter_id');
        $city_id = $request->input('city_id');
        $availability_id = $request->input('availability_id');

        $appends = [];

        $tires = Tire::query();

        if ($season)
        {
            $tires->where('season_id', $season);
            $appends['season_id'] = $season;
        }

        if ($brand){
            $tires->where('brand_id', $brand);
            $appends['brand_id'] = $brand;
        }

        if ($width_id){
            $tires->where('width_id', $width_id);
            $appends['width_id'] = $width_id;
        }

        if ($height_id){
            $tires->where('height_id', $height_id);
            $appends['height_id'] = $height_id;
        }

        if ($diameter_id){
            $tires->where('diameter_id', $diameter_id);
            $appends['diameter_id'] = $diameter_id;
        }

        if ($city_id){
            $tires->where('city_id', $city_id);
            $appends['city_id'] = $city_id;
        }

        if ($availability_id){
            $tires->where('availability_id', $availability_id);
            $appends['availability_id'] = $availability_id;
        }

        $tires->where('active', 1);

        $result = $tires->paginate(1)->appends($appends);

        return view('tire.index', compact('appends', 'tires', 'seasons',
            'width', 'height', 'diameter', 'city', 'availability', 'brands', 'result', 'user'));
    }

    public function create()
    {
        $brands = Brand::get();
        $widths = Width::get();
        $heights = Height::get();
        $diameters = Diameter::get();
        $seasons = Season::get();
        $cities = City::get();
        $availabilities = Availability::get();

        return view('tire.create', compact('brands', 'widths', 'heights', 'diameters', 'seasons', 'cities', 'availabilities'));
    }

    public function store(Request $request)
    {
        $name = $request->input('name');

        $image = $request->file('image');
        $filename  = time() . '-' . $image->getClientOriginalName();

        $path = public_path('uploads/tire/originals/' . $filename);
        $path_full = public_path('uploads/tire/thumbs/full/' . $filename);
        $path_medium = public_path('uploads/tire/thumbs/medium/' . $filename);
        $path_small = public_path('uploads/tire/thumbs/small/' . $filename);
        Image::make($image->getRealPath())->save($path);
        Image::make($image->getRealPath())->resize(383, 276)->save($path_full);
        Image::make($image->getRealPath())->resize(220, 138)->save($path_medium);
        Image::make($image->getRealPath())->resize(65, 57)->save($path_small);

        return view('tire.create', compact('brand', 'name', 'brands', 'filename'))->withSuccess('Everything went great');;
    }

}
