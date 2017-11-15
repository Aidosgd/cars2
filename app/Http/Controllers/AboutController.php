<?php

namespace App\Http\Controllers;

use App\Models\About;
use DB;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;


class AboutController extends Controller
{
    public function index()
    {
        $pages = About::get();
        return view('about.page', ['pages' => $pages]);
    }

    public function show($slug)
    {                
        $page = About::where('url', $slug)->first();
        return view('about.show', ['page'=>$page]);
    }
 
}