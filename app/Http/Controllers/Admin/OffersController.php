<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\CategoryGroup;
use App\Models\City;
use App\Models\Offer;
use App\Models\OfferComment;
use App\Models\OfferViews;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Cookie;

class OffersController extends Controller
{
    public function index()
    {
        $breadcrumbs = [
            'Главная' => '/cp',
            'Все объявления' => '',
        ];

        $pageTitle = 'Все объявления';

        $offers = Offer::get();

        return view('admin.offers.index', compact('offers', 'breadcrumbs', 'pageTitle'));
    }
}
