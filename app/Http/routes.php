<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    //Profile
    Route::get('/profile', 'ProfileController@index');
    Route::post('/profile', 'ProfileController@post');

    Route::group(['middleware' => 'App\Http\Middleware\Authenticate'], function(){
        Route::get('/profile/addoffer', 'ProfileController@addOffer');
        Route::post('/profile/addoffer', 'ProfileController@addOfferPost');
        Route::get('/profile/viewoffer', 'ProfileController@viewOffer');

        Route::get('/profile/add_auto_service', 'AutoServiceController@addAutoService');
        Route::post('/profile/add_auto_service', 'AutoServiceController@addAutoServicePost');
        Route::get('/profile/view_auto_service', 'AutoServiceController@viewAutoService');
    });

    Route::group(['middleware' => 'App\Http\Middleware\UserMiddleware'], function(){
        Route::get('/profile/editoffer/{id}', 'ProfileController@editOffer');
        Route::post('/profile/editoffer/{id}', 'ProfileController@updateOfferPost');
        Route::get('/profile/deleteoffer/{id}', 'ProfileController@deleteOffer');
        Route::get('/profile/onoffer/{id}', 'ProfileController@onOffer');
        Route::get('/profile/offoffer/{id}', 'ProfileController@offOffer');
    });

    Route::group(['middleware' => 'App\Http\Middleware\UserAutoServiceMiddleware'], function(){
        Route::get('/profile/edit_auto_service/{id}', 'AutoServiceController@editOffer');
        Route::post('/profile/edit_auto_service/{id}', 'AutoServiceController@updateOfferPost');
        Route::get('/profile/delete_auto_service/{id}', 'AutoServiceController@deleteOffer');
        Route::get('/profile/on_auto_service/{id}', 'AutoServiceController@onOffer');
        Route::get('/profile/off_auto_service/{id}', 'AutoServiceController@offOffer');
    });


    Route::group(['middleware' => 'App\Http\Middleware\CityMiddleware'], function() {
        //all offers
        Route::get('all_offers', 'OfferController@allOffers');
        Route::get('offers/category/{category_name}/{category_id}', 'OfferController@index');
        Route::get('offers/category/{category_name}/{category_id}/offer/{offer_name}/{offer_id}', 'OfferController@show');
        // all auto services
        Route::get('all_auto_service', 'AutoServiceController@allOffers');
        Route::get('auto_services/{category_name}/{category_id}', 'AutoServiceController@index');
        Route::get('auto_services/{category_name}/{category_id}/{offer_name}/{offer_id}', 'AutoServiceController@show');

        Route::get('search', 'OfferController@search');
    });

    Route::get('region/{id}', 'OfferController@cityCheck');
    Route::get('feedback', 'FeedbackController@index');
    Route::post('feedback', 'FeedbackController@post');

    Route::post('offers/addcomment/{id}', 'OfferController@addComment');
    Route::post('auto_services/addreview/{id}', 'AutoServiceController@addReview');

    Route::get('auto_service/allreview/{id}', function($id){
       return  \App\Models\AutoServicesReview::where('auto_service_id', $id)->get();
    });

    Route::get('/', function () {
        $currentRegion = $this->app['request']->cookie('region-selected');
        if($currentRegion == null){
            return redirect('/all_auto_service')->withCookie(cookie()->forever('region-selected', 1));
        }
        return view('welcome');
    });

    View::composer('parts.sidebar', function($view){
        $catGSidebar = \App\Models\CategoryGroup::get();
        $catSidebar = \App\Models\Category::with('offers')->get();
        $offersS = \App\Models\Offer::query();
        $id = Cookie::get('region-selected');
        if(isset($id)){
            $offersS->where('city_id', $id);
        }
        $offersS->where('active', 1)->orderBy('created_at', 'desc');
        $offersSidebar= $offersS->take(3)->get();
        $view->with(compact('offersSidebar','catGSidebar', 'catSidebar'));
    });

    View::composer('parts.header', function($view){
        $regions = \App\Models\City::get();
        $id = Cookie::get('region-selected');
        $allOfferCount = \App\Models\Offer::where('active', 1)->where('city_id', $id)->get()->count();
        $allAutoServiceCount = \App\Models\AutoService::where('active', 1)->where('city_id', $id)->get()->count();
        $view->with(compact('regions', 'allOfferCount', 'allAutoServiceCount'));
    });

    View::composer('parts.header', function($view){
        $user = Auth::user();

        if(isset($user)){
            $offerCount = \App\Models\Offer::where('user_id', $user->id)->count();
            $autoServiceCount = \App\Models\AutoService::where('user_id', $user->id)->count();
            $view->with(compact('offerCount', 'autoServiceCount'));
        }
    });

    View::composer('welcome', function($view){
        $offersW = \App\Models\Offer::query();
        $id = Cookie::get('region-selected');
        if(isset($id)){
            $offersW->where('city_id', $id);
        }
        $offersW->where('active', 1)->orderBy('created_at', 'desc');
        $offersWelcome = $offersW->take(8)->get();
        $view->with(compact('offersWelcome'));
    });

    Route::group(['prefix' => 'socialite'], function($router){

        $router->get('facebook', ['uses' => 'Auth\SocialiteController@facebook']);
        $router->get('twitter', ['uses' => 'Auth\SocialiteController@twitter']);
        $router->get('vkontakte', ['uses' => 'Auth\SocialiteController@vkontakte']);
        $router->get('success_facebook_auth', ['uses' => 'Auth\SocialiteController@success_facebook_auth']);
        $router->get('success_twitter_auth', ['uses' => 'Auth\SocialiteController@success_twitter_auth']);
        $router->get('success_vkontakte_auth', ['uses' => 'Auth\SocialiteController@success_vkontakte_auth']);

    });
    //Admin
    Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function(){
        require_once "routes._admin.php";
    });
});
