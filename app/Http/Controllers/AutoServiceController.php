<?php

namespace App\Http\Controllers;

use App\Http\Requests\AutoServicePostRequest;
use App\Models\AutoServicesReview;
use Illuminate\Http\Request;
use App\Models\AutoService;
use App\Models\AutoServicesCategory;
use App\Models\AutoServicesModeOperation;
use App\Models\AutoServicesWashingType;
use App\Models\City;
use App\Models\VehicleBrand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Input;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class AutoServiceController extends Controller
{
    public function allOffers()
    {
        $offers = AutoService::query();
        $appends = [];
        $id = Cookie::get('region-selected');
        if(isset($id)){
            $offers->where('city_id', $id);
        }else{
            $offers->where('city_id', 1);
        }
        $offers->orderBy('created_at', 'desc')->where('active', 1);

        $maps = $offers->get();

        $result = $offers->paginate(8)->appends($appends);
        return view('auto_service.all', compact('result', 'maps'));
    }

    public function index($category_name, $category_id)
    {
        $offers = AutoService::query();
        $appends = [];

        if (isset($category_id))
        {
            $offers->where('auto_services_category_id', $category_id);
            $appends['auto_services_category_id'] = $category_id;
        }

        $id = Cookie::get('region-selected');
        if(isset($id)){
            $offers->where('city_id', $id);
        }

        $offers->orderBy('created_at', 'desc')->where('active', 1);
        $maps = $offers->get();

        $result = $offers->paginate(10)->appends($appends);


        if (isset($category_id))
        {
            $category = AutoServicesCategory::where('id', $category_id)->first();
            $titleSeo = isset($category) ? $category->name : 'Все';
        }

        return view('auto_service.index', compact('cat_parent', 'cat_id', 'category_name', 'category_id',
            'categories', 'result', 'appends', 'category', 'catGroup', 'currentRegion', 'titleSeo', 'maps'));
    }

    public function show($category_name, $category_id, $offer_name, $offer_id)
    {
        $user = \Auth::user();
        $offer = AutoService::where('id', $offer_id)->first();
        $category = AutoServicesCategory::where('id', $offer->auto_services_category_id)->first();
        $titleSeo = $offer->title;
        $map = json_decode($offer->map);
        return view('auto_service.show', compact('user', 'cat_parent', 'cat_id', 'offer', 'category', 'catGroup', 'titleSeo', 'map'));
    }

    public function addAutoService()
    {
        $categories = AutoServicesCategory::get();
        $vehicleBrand = VehicleBrand::get();
        $cities = City::get();
        $modeOperation = AutoServicesModeOperation::get();
        $washingType = AutoServicesWashingType::get();
        $center = '[43.239039, 76.930350]';
        $zoom = 12;
        $target = 'store';

        return view('auto_service.add', compact('categories', 'vehicleBrand', 'cities',
            'modeOperation', 'washingType', 'center', 'zoom', 'target'));
    }

    public function addAutoServicePost(AutoServicePostRequest $request)
    {
        $input = $request->all();
        $phones = (object)Input::all();
        $phones = json_encode($phones->phone);
        $user = Auth::user();

        $auto_service = AutoService::create(
            [
                'active' => 1,
                'auto_services_category_id' => $input['category'],
                'title' => $input['title'],
                'slug' => Str::slug($input['title']),
                'description' => $input['description'],
                'web_site' => $input['web_site'],
                'phone' => $phones,
                'address' => $input['address'],
                'city_id' => $input['city'],
                'user_id' => $user->id,
                'map' => json_encode($input['map']),
                'created_at' => date('Y-m-d H:i:s')
            ]
        );

        $images = $request->file('images');
        $images = array_filter($images);

        if(count($images)){
            foreach($images as $image){
                $filename = date('Y-m-d-H-i').'-' . Str::slug($image->getClientOriginalName(), "_"). ".".$image->getClientOriginalExtension();
                $path = public_path('uploads/offers/'.$filename);
                $pathSmall = public_path('uploads/offers/small/'.$filename);
                $pathOriginal = public_path('uploads/offers/original/'.$filename);

                Image::make($image->getRealPath())->
                resize(null, 416, function ($constraint) {
                    $constraint->aspectRatio();
                })->resizeCanvas(550, 416, 'center')->save($path);
                Image::make($image->getRealPath())->
                resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->resizeCanvas(300, 300, 'center')->save($pathSmall);
                Image::make($image->getRealPath())->save($pathOriginal);

                \App\Models\Image::create([
                    'name' => $filename,
                    'auto_service_id' => $auto_service->id
                ]);
            }
        }

        $request->session()->flash('message', "Объявление $auto_service->title опубликовано");
        return redirect('profile/view_auto_service');
    }

    public function viewAutoService()
    {
        $user = Auth::user();
        $offers = AutoService::orderBy('updated_at', 'desc')->where('user_id', $user->id)->paginate(10);


        return view('auto_service.view', compact('user', 'offers'));
    }

    public function editOffer($id)
    {
        $categories = AutoServicesCategory::get();
        $vehicleBrand = VehicleBrand::get();
        $cities = City::get();
        $modeOperation = AutoServicesModeOperation::get();
        $washingType = AutoServicesWashingType::get();
        $target = 'store';
        $offer = AutoService::where('id', $id)->first();
        $map = json_decode($offer->map);


        return view('auto_service.edit', compact('categories', 'vehicleBrand', 'modeOperation',
            'washingType', 'center', 'zoom', 'target',
            'offer', 'cities', 'map'
        ));
    }

    public function updateOfferPost(AutoServicePostRequest $request, $id)
    {
        $phones = (object)Input::all();
        $phones = json_encode($phones->phone);
        $offer = AutoService::find($id);
        $input = $request->all();
        $user = Auth::user();
        $input['images'] = array_filter($input['images']);

        AutoService::where('id', $id)->update(
            [
                'auto_services_category_id' => $input['category'],
                'title' => $input['title'],
                'description' => $input['description'],
                'web_site' => $input['web_site'],
                'phone' => $phones,
                'address' => $input['address'],
                'city_id' => $input['city'],
                'user_id' => $user->id,
                'map' => json_encode($input['map']),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );

        $offerImages = $request->input('offer_images');
        if($offerImages)
            foreach($offer->images as $item){
                if(in_array($item->id, $offerImages))
                    continue;
                $item->delete();
                $path = public_path('uploads/offers/'.$item->name);
                $pathSmall = public_path('uploads/offers/small/'.$item->name);
                $pathOriginal = public_path('uploads/offers/original/'.$item->name);
                unlink($path);
                unlink($pathSmall);
                unlink($pathOriginal);
            }
        else
            foreach($offer->images as $item){
                $item->delete();
                $path = public_path('uploads/offers/'.$item->name);
                $pathSmall = public_path('uploads/offers/small/'.$item->name);
                $pathOriginal = public_path('uploads/offers/original/'.$item->name);
                unlink($path);
                unlink($pathSmall);
                unlink($pathOriginal);
            }
        $images = array_filter($request->file('images', []));

        if(count($images)){
            foreach($images as $image){
                $filename = date('Y-m-d-H-i').'-' . Str::slug($image->getClientOriginalName(), "_"). ".".$image->getClientOriginalExtension();
                $path = public_path('uploads/offers/'.$filename);
                $pathSmall = public_path('uploads/offers/small/'.$filename);
                $pathOriginal = public_path('uploads/offers/original/'.$filename);
                Image::make($image->getRealPath())->
                resize(null, 416, function ($constraint) {
                    $constraint->aspectRatio();
                })->resizeCanvas(550, 416, 'center')->save($path);
                Image::make($image->getRealPath())->
                resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->resizeCanvas(300, 300, 'center')->save($pathSmall);
                Image::make($image->getRealPath())->save($pathOriginal);

                \App\Models\Image::create([
                    'name' => $filename,
                    'auto_service_id' => $offer->id
                ]);
            }
        }

        $request->session()->flash('message', "Объявление $offer->title отредактирован");
        return redirect('profile/view_auto_service');
    }

    public function deleteOffer($id, Request $request, Mailer $mailer)
    {
        $offer = AutoService::find($id);

//        if(isset($offer->offerViews)){
//            $offer->offerViews->delete();
//        }
//        OfferComment::where('offer_id', $id)->delete();

        if($offer->images){
            foreach($offer->images as $image){
                $filename = $image->name;
                $path = public_path('uploads/offers/'.$filename);
                $pathSmall = public_path('uploads/offers/small/'.$filename);
                $pathOriginal = public_path('uploads/offers/original/'.$filename);
                unlink($path);
                unlink($pathSmall);
                unlink($pathOriginal);
                $image->delete();
            }
        }

//        if($offer->user->social_type == null)
//        {
//            $mailer->send('emails.delete_offer', [
//                'offer' => $offer
//            ],function (Message $message) use ($offer){
//                $message->from('info@cars2.kz');
//                $message->to($offer->user->email);
//                $message->subject("Объявление $offer->title Удаленно");
//            });
//
//            $mailer->send('emails.admin.delete_offer', [
//                'offer' => $offer
//            ],function (Message $message) use ($offer){
//                $message->from('info@cars2.kz');
//                $message->to('aidosgd@gmail.com');
//                $message->subject("Объявление $offer->title Удаленно");
//            });
//        }else{
//            $mailer->send('emails.admin.delete_offer', [
//                'offer' => $offer
//            ],function (Message $message) use ($offer){
//                $message->from('info@cars2.kz');
//                $message->to('aidosgd@gmail.com');
//                $message->subject("Объявление $offer->title Удаленно");
//            });
//        }

        $offer->delete();
        $request->session()->flash('message', "Объявление $offer->title удалено");
        return redirect('profile/view_auto_service');
    }

    public function onOffer($id, Request $request, Mailer $mailer)
    {
        $offer = AutoService::where('id', $id)->first();
        $offer->update(['active' => 1]);
        $request->session()->flash('message', "Объявление $offer->title включено");

        return redirect('profile/view_auto_service');
    }

    public function offOffer($id, Request $request)
    {
        $offer = AutoService::where('id', $id)->first();
        $offer->update(['active' => 0]);
        $request->session()->flash('message', "Объявление $offer->title выключено");
        return redirect('profile/view_auto_service');
    }

    public function addReview($id, Request $request)
    {
        $input = $request->all();
        $user = \Auth::user();
        $offer = AutoService::where('id', $id)->first();

        if ($user){
            $review = AutoServicesReview::create([
                'name' => $user->name,
                'email' => $user->email,
                'text' => $input['text'],
                'points' => $input['points'],
                'auto_service_id' => $offer->id
            ]);
        }else{
            $review = AutoServicesReview::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'text' => $input['text'],
                'points' => $input['points'],
                'auto_service_id' => $offer->id
            ]);
        }

        return $review;
    }
}
