<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryGroup;
use App\Models\City;
use App\Models\Condition;
use App\Models\Delivery;
use App\Models\Diameter;
use App\Models\Offer;
use App\Models\OfferComment;
use App\Models\OfferViews;
use App\Models\RimDia;
use App\Models\RimEt;
use App\Models\RimPcd;
use App\Models\RimType;
use App\Models\RimWidth;
use App\Models\TireBrand;
use App\Models\TireHeight;
use App\Models\TireSeason;
use App\Models\TireWidth;
use App\Models\VehicleBrand;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.main', compact('user'));
    }

    public function post(Request $request)
    {
        $user = Auth::user();
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$request->user()->id,
        ];
        $data = $request->all();

        if ($data['password']) {
            $rules['old_password'] = 'required';
            $rules['password'] = 'required|confirmed|different:old_password|min:6';
            $rules['password_confirmation'] = 'required';
            $this->validate($request, $rules);

            if (!Hash::check($request->input('old_password'), $request->user()->password)) {
                return view('profile.main', compact('user'))->with("message", "не правельный пароль!");
            }
        } else {
            unset($data['password']);
            $this->validate($request, $rules);
        }

        $image = $request->file('default_avatar');

        if($image){
            if($user->default_avatar){
                $pathOld = public_path('/uploads/img/'.$user->default_avatar);
                unlink($pathOld);
            }
            $filename = date('Y-m-d-H-i').'-' . Str::slug($image->getClientOriginalName(), "_"). ".".$image->getClientOriginalExtension();
            $path = public_path('uploads/img/'.$filename);
            $user->update([
                'default_avatar' => $filename
            ]);

            Image::make($image->getRealPath())->
            resize(null, 416, function ($constraint) {
                $constraint->aspectRatio();
            })->resizeCanvas(550, 550, 'center')->save($path);

            return view('profile.main', compact('user'))->with("message", "Данные сохранены!");
        }

        $request->user()->fill($data);
        if (isset($data['password'])) {
            $request->user()->password = bcrypt($data['password']);
        }
        $request->user()->save();

        return view('profile.main', compact('user'))->with("message", "Данные сохранены!");

    }

    public function addOffer()
    {
        $categoriesGroup = CategoryGroup::get();
        $categories = Category::get();
        $vehicleBrand = VehicleBrand::get();
        $condition = Condition::get();
        $delivery = Delivery::get();

        $tireWidths = TireWidth::get();
        $tireHeights = TireHeight::get();
        $diameters = Diameter::get();
        $tireSeasons = TireSeason::get();
        $tireBrands = TireBrand::get();
        $cities = City::get();
//        $availabilities = Availability::get();

        $rimTypes = RimType::get();
        $rimWidths = RimWidth::get();
        $rimPcds = RimPcd::get();
        $rimEts = RimEt::get();
        $rimDias = RimDia::get();


        return view('profile.add', compact(
            'categoriesGroup', 'categories', 'vehicleBrand',
            'condition', 'delivery', 'tireBrands', 'tireWidths',
            'tireHeights', 'diameters', 'tireSeasons', 'cities', 'availabilities',
            'rimTypes', 'rimWidths', 'rimPcds', 'rimEts', 'rimDias'));
    }

    public function addOfferPost(Requests\OfferPostRequest $request, Mailer $mailer)
    {
        $input = $request->all();
        $phones = (object)Input::all();
        $phones = json_encode($phones->phone);
        $user = Auth::user();
        $input['images'] = array_filter($input['images']);

        if(!isset($input['manufacturer'])){
            $input['manufacturer'] = '';
        }
        if(!isset($input['partnumber'])){
            $input['partnumber'] = '';
        }
        if(!isset($input['tireWidth'])){
            $input['tireWidth'] = '1';
        }
        if(!isset($input['tireHeight'])){
            $input['tireHeight'] = '1';
        }
        if(!isset($input['tireSeason'])){
            $input['tireSeason'] = '1';
        }
        if(!isset($input['tireBrand'])){
            $input['tireBrand'] = '1';
        }
        if(!isset($input['diameter'])){
            $input['diameter'] = '1';
        }
        if(!isset($input['rimType'])){
            $input['rimType'] = '1';
        }
        if(!isset($input['rimWidth'])){
            $input['rimWidth'] = '1';
        }
        if(!isset($input['rimPcd'])){
            $input['rimPcd'] = '1';
        }
        if(!isset($input['rimEt'])){
            $input['rimEt'] = '1';
        }
        if(!isset($input['rimDia'])){
            $input['rimDia'] = '1';
        }

        $offer = Offer::create(
            [
                'active' => 1,
                'category_id' => $input['category'],
                'manufacturer' => $input['manufacturer'],
                'partnumber' => $input['partnumber'],
                'title' => $input['title'],
                'description' => $input['description'],
                'price' => $input['price'],
                'phone' => $phones,
                'address' => $input['address'],
                'vehicle_brand_id' => $input['vehicleBrand'],
                'condition_id' => $input['condition'],
                'city_id' => $input['city'],
                'delivery_id' => $input['delivery'],
                'user_id' => $user->id,
                'tire_width_id' => $input['tireWidth'],
                'tire_height_id' => $input['tireHeight'],
                'diameter_id' => $input['diameter'],
                'tire_season_id' => $input['tireSeason'],
                'tire_brand_id' => $input['tireBrand'],
                'rim_type_id' => $input['rimType'],
                'rim_width_id' => $input['rimWidth'],
                'rim_pcd_id' => $input['rimPcd'],
                'rim_et_id' => $input['rimEt'],
                'rim_dia_id' => $input['rimDia'],
                'created_at' => date('Y-m-d H:i:s')
            ]
        );
        OfferViews::create([
            'offer_id' => $offer->id
        ]);

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
                    'offer_id' => $offer->id
                ]);
            }
        }

        if($offer->user->social_type == null)
        {
            $mailer->send('emails.add_offer', [
                'offer' => $offer
            ],function (Message $message) use ($offer){
                $message->from('info@cars2.kz');
                $message->to($offer->user->email);
                $message->subject("Объявление $offer->title опубликовано");
            });

            $mailer->send('emails.admin.add_offer', [
                'offer' => $offer
            ],function (Message $message) use ($offer){
                $message->from('info@cars2.kz');
                $message->to('aidosgd@gmail.com');
                $message->subject("Объявление $offer->title опубликовано");
            });
        }else{
            $mailer->send('emails.admin.add_offer', [
                'offer' => $offer
            ],function (Message $message) use ($offer){
                $message->from('info@cars2.kz');
                $message->to('aidosgd@gmail.com');
                $message->subject("Объявление $offer->title опубликовано");
            });
        }

        $request->session()->flash('message', "Объявление $offer->title опубликовано");
        return redirect('profile/viewoffer');
    }

    public function viewOffer()
    {
        $user = Auth::user();
        $offers = Offer::orderBy('updated_at', 'desc')->where('user_id', $user->id)->paginate(10);


        return view('profile.view', compact('user', 'offers'));
    }

    public function editOffer($id)
    {

        $categoriesGroup = CategoryGroup::get();
        $categories = Category::get();
        $vehicleBrand = VehicleBrand::get();
        $condition = Condition::get();
        $delivery = Delivery::get();

        $tireWidths = TireWidth::get();
        $tireHeights = TireHeight::get();
        $diameters = Diameter::get();
        $tireSeasons = TireSeason::get();
        $tireBrands = TireBrand::get();
        $cities = City::get();
        //$availability = Availability::get();

        $rimTypes = RimType::get();
        $rimWidths = RimWidth::get();
        $rimPcds = RimPcd::get();
        $rimEts = RimEt::get();
        $rimDias = RimDia::get();

        $offer = Offer::where('id', $id)->first();


        return view('profile.edit', compact(
            'categoriesGroup', 'categories', 'vehicleBrand', 'condition',
            'delivery', 'tireWidths', 'tireHeights', 'diameters', 'tireSeasons',
            'tireBrands', 'rimTypes', 'rimWidths', 'rimPcds', 'rimEts', 'rimDias',
            'offer', 'diameters', 'cities', 'availability'
        ));
    }

    public function updateOfferPost(Requests\OfferPostRequest $request, $id)
    {
        $phones = (object)Input::all();
        $phones = json_encode($phones->phone);
        $offer = Offer::find($id);
        $input = $request->all();
        $user = Auth::user();
        $input['images'] = array_filter($input['images']);
        if(!isset($input['manufacturer'])){
            $input['manufacturer'] = '';
        }
        if(!isset($input['partnumber'])){
            $input['partnumber'] = '';
        }
        if(!isset($input['tireWidth'])){
            $input['tireWidth'] = '1';
        }
        if(!isset($input['tireHeight'])){
            $input['tireHeight'] = '1';
        }
        if(!isset($input['tireSeason'])){
            $input['tireSeason'] = '1';
        }
        if(!isset($input['tireBrand'])){
            $input['tireBrand'] = '1';
        }
        if(!isset($input['diameter'])){
            $input['diameter'] = '1';
        }
        if(!isset($input['rimType'])){
            $input['rimType'] = '1';
        }
        if(!isset($input['rimWidth'])){
            $input['rimWidth'] = '1';
        }
        if(!isset($input['rimPcd'])){
            $input['rimPcd'] = '1';
        }
        if(!isset($input['rimEt'])){
            $input['rimEt'] = '1';
        }
        if(!isset($input['rimDia'])){
            $input['rimDia'] = '1';
        }

        Offer::where('id', $id)->update(
            [
                'category_id' => $input['category'],
                'manufacturer' => $input['manufacturer'],
                'partnumber' => $input['partnumber'],
                'title' => $input['title'],
                'description' => $input['description'],
                'price' => $input['price'],
                'phone' => $phones,
                'address' => $input['address'],
                'vehicle_brand_id' => $input['vehicleBrand'],
                'condition_id' => $input['condition'],
                'city_id' => $input['city'],
                'delivery_id' => $input['delivery'],
                'tire_width_id' => $input['tireWidth'],
                'tire_height_id' => $input['tireHeight'],
                'diameter_id' => $input['diameter'],
                'tire_season_id' => $input['tireSeason'],
                'tire_brand_id' => $input['tireBrand'],
                'rim_type_id' => $input['rimType'],
                'rim_width_id' => $input['rimWidth'],
                'rim_pcd_id' => $input['rimPcd'],
                'rim_et_id' => $input['rimEt'],
                'rim_dia_id' => $input['rimDia'],
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
                    'offer_id' => $offer->id
                ]);
            }
        }

        $request->session()->flash('message', "Объявление $offer->title отредактирован");
        return redirect('profile/viewoffer');
    }

    public function deleteOffer($id, Request $request, Mailer $mailer)
    {
        $offer = Offer::find($id);

        if(isset($offer->offerViews)){
            $offer->offerViews->delete();
        }
        OfferComment::where('offer_id', $id)->delete();
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

        if($offer->user->social_type == null)
        {
            $mailer->send('emails.delete_offer', [
                'offer' => $offer
            ],function (Message $message) use ($offer){
                $message->from('info@cars2.kz');
                $message->to($offer->user->email);
                $message->subject("Объявление $offer->title Удаленно");
            });

            $mailer->send('emails.admin.delete_offer', [
                'offer' => $offer
            ],function (Message $message) use ($offer){
                $message->from('info@cars2.kz');
                $message->to('aidosgd@gmail.com');
                $message->subject("Объявление $offer->title Удаленно");
            });
        }else{
            $mailer->send('emails.admin.delete_offer', [
                'offer' => $offer
            ],function (Message $message) use ($offer){
                $message->from('info@cars2.kz');
                $message->to('aidosgd@gmail.com');
                $message->subject("Объявление $offer->title Удаленно");
            });
        }

        $offer->delete();
        $request->session()->flash('message', "Объявление $offer->title удалено");
        return redirect('profile/viewoffer');
    }

    public function onOffer($id, Request $request, Mailer $mailer)
    {
        $offer = Offer::where('id', $id)->first();
        $offer->update(['active' => 1]);
        $request->session()->flash('message', "Объявление $offer->title включено");

        return redirect('profile/viewoffer');
    }

    public function offOffer($id, Request $request)
    {
        $offer = Offer::where('id', $id)->first();
        $offer->update(['active' => 0]);
        $request->session()->flash('message', "Объявление $offer->title выключено");
        return redirect('profile/viewoffer');
    }
}
