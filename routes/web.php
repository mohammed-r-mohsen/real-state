<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('send','StartController@send');

// Route::get('add/cities','StartController@add_cities');
Route::get('/test',function(){
  return get_translate('hello');
});
 Route::get('/lang/{lang}',function($lang){ 
            // return session('lang'); 
            $lang=$lang==null?'en':$lang;
            session()->put('lang',$lang);
            return back();
        });
Route::get('web/get_lang','StartController@get_lang');

Route::get('/{any?}', function () {
    return view('welcome');
});
Route::get('/add_advertisement/{step?}', function () {return view('welcome');});
Route::get('/view_advertisement/{slug?}', function () {return view('welcome');});
Route::get('/edit_advertisement/{slug?}', function () {return view('welcome');});
Route::get('/provider/{name}/{id}', function () {return view('welcome');});
Route::get('/verify_email/{user_id}/{code}','AuthController@verify_email');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



//admin routes
Config::set('auth.defines','admin');

Route::namespace('Admin')->group(function(){
Route::get('admin/login','AdminController@login')->name('admin.login');
Route::post('admin/login','AdminController@dologin')->name('admin.dologin');
Route::group(['middleware'=>['admin:admin','super']],function(){
    Route::prefix('admin')->group(function(){    
        Route::get('/edit-profile','AdminController@edit_profile')->name('admin.edit_profile');
        Route::any('/logout','AdminController@logout')->name('admin.logout');
        Route::get('/dashboard','AdminController@dashboard')->name('admin.dashboard');
        Route::get('/brands','BrandsController@home')->name('admin.brands');
        Route::get('/editors','AdminsController@home')->name('admin.editors');
        Route::get('/users','UsersController@home')->name('admin.users');
        Route::get('/all-users','AllUsersController@home')->name('admin.all_users');
        Route::get('/title_deeds','TitleDeedsController@home')->name('admin.title_deeds');

        Route::get('/packages','PackagesController@home')->name('admin.packages');
        Route::get('/ads_numbers','AdsNumbersController@home')->name('admin.ads_numbers');
        Route::get('/countries','CountriesController@home')->name('admin.countries');
        Route::get('/states','StatesController@home')->name('admin.states');
        Route::get('/cities','CitiesController@home')->name('admin.cities');
        Route::get('/regions','RegionsController@home')->name('admin.regions');
        Route::get('/categories','CategoriesController@home')->name('admin.categories');
        Route::get('/currencies','CurrenciesController@home')->name('admin.currencies');
        Route::get('/neighbors','NeighborsController@home')->name('admin.neighbors');
        Route::get('/appart_models','AppartModelsController@home')->name('admin.appart_models');
        Route::get('/building_ages','BuildingAgesController@home')->name('admin.building_ages');
        Route::get('/floor_numbers','FloorNumbersController@home')->name('admin.floor_numbers');
        Route::get('/heatings','HeatingsController@home')->name('admin.heatings');
        Route::get('/orders','OrdersController@home')->name('admin.orders');
        Route::get('/notifications','AdminController@notifications');
        Route::get('/notification/{id}','AdminController@notification');
        Route::get('/faqs','FaqsController@home')->name('admin.faqs');
        Route::get('/pages','SettingsController@pages_home')->name('admin.pages');
        Route::get('/users_chat','UsersController@users_chat')->name('admin.users_chat');
        Route::get('/settings','SettingsController@settings')->name('admin.settings');
        Route::get('/settings/sliders','SlidersController@home')->name('admin.sliders');
        


        //resources routes
         Route::resources([
            'admin_api/users'=>'UsersController',
            'admin_api/all_users'=>'AllUsersController',
            'admin_api/editors'=>'AdminsController',
            'admin_api/packages'=>'PackagesController',
            'admin_api/countries'=>'CountriesController',
            'admin_api/states'=>'StatesController',
            'admin_api/cities'=>'CitiesController',
            'admin_api/regions'=>'RegionsController',
            'admin_api/categories'=>'CategoriesController',
            'admin_api/currencies'=>'CurrenciesController',
            'admin_api/neighbors'=>'NeighborsController',
            'admin_api/appart_models'=>'AppartModelsController',
            'admin_api/building_ages'=>'BuildingAgesController',
            'admin_api/floor_numbers'=>'FloorNumbersController',
            'admin_api/heatings'=>'HeatingsController',
            'admin_api/title_deeds'=>'TitleDeedsController',
            'admin_api/orders'=>'OrdersController',
            'admin_api/ads'=>'AdvertisementsController',
            'admin_api/faqs'=>'FaqsController',
            'admin_api/sliders'=>'SlidersController',
            'admin_api/ads_numbers'=>'AdsNumbersController',
        ]);

        //admin_api routes
        Route::post('admin_api/add_state','StatesController@add_state');
        Route::post('admin_api/add_city','CitiesController@add_city');
        Route::post('admin_api/add_region','RegionsController@add_region');
        Route::post('admin_api/add_neighbor','NeighborsController@add_neighbor');
        

        Route::get('admin_api/get_appart_models','AppartModelsController@get_appart_models');
        Route::post('admin_api/upload_ad_image','AdvertisementsController@upload_ad_image');
        Route::post('admin_api/upload_ad_video','AdvertisementsController@upload_ad_video');
        
        Route::post('admin_api/update_status','AdvertisementsController@update_status');

        //search admin_api
        Route::get('admin_api/users/search/{query?}','UsersController@search');
        Route::get('admin_api/packages/search/{query?}','PackagesController@search');
        Route::get('admin_api/countries/search/{query?}','CountriesController@search');
        Route::get('admin_api/categories/search/{query?}','CategoriesController@search');
        Route::get('admin_api/currencies/search/{query?}','CurrenciesController@search');
        Route::get('admin_api/appart_models/search/{query?}','AppartModelsController@search');
        Route::get('admin_api/building_ages/search/{query?}','BuildingAgesController@search');
        Route::get('admin_api/floor_numbers/search/{query?}','FloorNumbersController@search');
        Route::get('admin_api/heatings/search/{query?}','HeatingsController@search');
        Route::get('admin_api/title_deeds/search/{query?}','TitleDeedsController@search');
        Route::get('admin_api/editors/search/{query?}','AdminsController@search');
        Route::get('admin_api/faqs/search/{query?}','FaqsController@search');
        Route::post('admin_api/update_pages','SettingsController@update_pages');
        Route::post('admin_api/settings','SettingsController@update_settings');
        Route::get('admin_api/get_city/{id}','CitiesController@get_city');
        

        //filter
        Route::post('admin_api/filter_states','StatesController@filter');
        Route::post('admin_api/filter_cities','CitiesController@filter');
        Route::post('admin_api/filter_regions','RegionsController@filter');
        Route::post('admin_api/filter_neighbors','NeighborsController@filter');
        
    });
    });


    /////////////////// End Super Admin ///////////////////////
    /////////////////// End Super Admin ///////////////////////


    Route::group(['middleware'=>['admin:admin','editor']],function(){
        Route::prefix('admin')->group(function(){  
        Route::get('/edit-profile','AdminController@edit_profile')->name('admin.edit_profile');
        Route::any('/logout','AdminController@logout')->name('admin.logout');
        
        });
    });

        /////////////////// End Editor///////////////////////
    /////////////////// End Editor///////////////////////

    Route::group(['middleware'=>'admin:admin'],function(){
        Route::prefix('admin')->group(function(){  
        Route::get('/dashboard','AdminController@dashboard')->name('admin.dashboard');
        Route::get('/edit-profile','AdminController@edit_profile')->name('admin.edit_profile');
        Route::any('/logout','AdminController@logout')->name('admin.logout');
        Route::get('/providers','ProvidersController@home')->name('admin.providers');
        Route::get('/orders','OrdersController@home')->name('admin.orders');
        Route::get('/advertisements','AdvertisementsController@home')->name('admin.advertisements');

        Route::get('/view_advertisement/{slug}','AdvertisementsController@view');
        Route::resources([
            'admin_api/editors'=>'AdminsController',
            'admin_api/providers'=>'ProvidersController',
            'admin_api/orders'=>'OrdersController',
            'admin_api/ads'=>'AdvertisementsController',
        ]);

        //change language 
        

        //admin_api routes
        Route::get('admin_api/get_countries','CountriesController@get_countries');
        Route::get('admin_api/get_states','StatesController@get_states');
        Route::get('admin_api/get_cities/{id?}','CitiesController@get_cities');
        Route::get('admin_api/get_regions/{id?}','RegionsController@get_regions');
        Route::get('admin_api/get_neighbors/{id?}','NeighborsController@get_neighbors');
        Route::get('admin_api/get_users','UsersController@get_users');
        Route::get('admin_api/get_order/{user_id}','OrdersController@get_order');
        Route::get('admin_api/get_categories','CategoriesController@get_categories');
        Route::get('admin_api/get_currencies','CurrenciesController@get_currencies');
        Route::get('admin_api/get_appart_models','AppartModelsController@get_appart_models');
        Route::post('admin_api/upload_ad_image','AdvertisementsController@upload_ad_image');
        Route::post('admin_api/upload_ad_video','AdvertisementsController@upload_ad_video');
        Route::get('admin_api/get_recent_nots','AdminController@get_recent_nots');
        Route::get('admin_api/get_ads_numbers','AdsNumbersController@get_ads_numbers');
        
        Route::get('admin_api/get_users_no_packages','UsersController@get_users_no_packages');
        Route::get('admin_api/get_users_has_packages','UsersController@get_users_has_packages');
        Route::get('admin_api/get_packages/{user_id?}','PackagesController@get_packages');
        Route::get('admin_api/get_order/{user_id}','OrdersController@get_order');

        //search 
        Route::get('admin_api/providers/search/{query?}','ProvidersController@search');

        // filter 
        Route::post('admin_api/filter_orders','OrdersController@filter_orders');
        Route::post('admin_api/filter_ads','AdvertisementsController@filter_ads');


        });
    });

});