<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Offer;
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
        return view('home');
    }

    public function search(Request $request)
    {
        // Gets the query string from our form submission
        $query = $request->input('search');
        // Returns an array of articles that have the query string located somewhere within
        // our articles titles. Paginates them so we can break up lots of search results.
        $articles = Offer::where('title', 'LIKE', '%' . $query . '%')->paginate(10);


        // returns a view and passes the view the list of articles and the original query.
        return view('offer.search', compact('articles', 'query'));
    }
}
