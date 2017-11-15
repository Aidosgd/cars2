<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [
            'Главная' => '/cp',
        ];

        $pageTitle = 'Главная';

        $offers = Offer::paginate(15);

        $users = User::paginate(5);

        return view('admin.home', compact('breadcrumbs', 'pageTitle', 'offers', 'users'));
    }
}
