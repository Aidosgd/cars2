<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryGroup;
use App\Models\City;
use App\Models\Offer;
use App\Models\OfferComment;
use App\Models\OfferViews;
use Illuminate\Http\Request;

use App\Http\Requests\CommentPostRequest;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class OfferController extends Controller
{
    public function allOffers()
    {
        $offers = Offer::query();
        $appends = [];
        $id = Cookie::get('region-selected');
        if(isset($id)){
            $offers->where('city_id', $id);
        }
        $offers->orderBy('created_at', 'desc')->where('active', 1);

        $result = $offers->paginate(10)->appends($appends);
        return view('offer.all', compact('result'));
    }

    public function index(Request $request, $category_name, $category_id)
    {
        $get = $request->all();
        $offers = Offer::query();

        $appends = [];

        if (isset($category_id))
        {
            $offers->where('category_id', $category_id);
            $appends['category_id'] = $category_id;
        }

        $id = Cookie::get('region-selected');
        if(isset($id)){
            $offers->where('city_id', $id);
        }

        $offers->orderBy('created_at', 'desc')->where('active', 1);

        $result = $offers->paginate(10)->appends($appends);

        if (isset($category_id))
        {
            $category = Category::where('id', $category_id)->first();
            $cat_parent = $category->category_group_id;
            $cat_id = $category->id;
            $catGroup = CategoryGroup::where('id', $category->category_group_id)->first();
            $titleSeo = isset($category) ? $category->name : 'Все';
        }
        
        return view('offer.index', compact('cat_parent', 'cat_id', 'category_name', 'category_id',
            'categories', 'result', 'appends', 'category', 'catGroup', 'currentRegion', 'titleSeo'));
    }

    public function search(Request $request)
    {
        $query = $request->input('search');
        $articles = Offer::where('title', 'LIKE', '%' . $query . '%')
            ->orWhere('description', 'like', '%'.$query.'%')
            ->orWhere('manufacturer', 'like', '%'.$query.'%')
            ->orWhere('partnumber', 'like', '%'.$query.'%')
            ->paginate(10);
        return view('offer.search', compact('articles', 'query'));
    }

    public function show($category_name, $category_id, $offer_name, $offer_id)
    {
        $user = \Auth::user();
        $count = OfferViews::where('offer_id', $offer_id)->first();
        $count->update(['views_count'=> $count->views_count + 1]);
        $offer = Offer::where('id', $offer_id)->first();
        $category = Category::where('id', $offer->category_id)->first();
        $cat_parent = $category->category_group_id;
        $cat_id = $category->id;
        $catGroup = CategoryGroup::where('id', $category->category_group_id)->first();
        $titleSeo = $offer->title;
        return view('offer.show', compact('user', 'cat_parent', 'cat_id', 'offer', 'category', 'catGroup', 'titleSeo'));
    }

    public function addComment($id, CommentPostRequest $request)
    {
        $input = $request->all(); 
        $user = \Auth::user();
        $offer = Offer::where('id', $id)->first(); 

        if ($user){
            $comment = OfferComment::create([
                'name' => $user->name,
                'email' => $user->email,
                'text' => $input['text'],
                'parent_id' => $input['parent_id'] ? : null,
                'offer_id' => $offer->id
            ]);
        }else{
            $comment = OfferComment::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'text' => $input['text'],
                'parent_id' => $input['parent_id'] ? : null,
                'offer_id' => $offer->id
            ]);
        }

        return $comment;
    }

    public function cityCheck($id)
    {
        $result = $id;
        return redirect('/', $result);
    }
}
