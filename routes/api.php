<?php

use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['middleware' => 'localization'], function () {
Route::middleware('auth:sanctum')->group(function(){
Route::get('/user', function (Request $request) {
    return $request->user();
});
Route::post('logout','AuthController@logout');
Route::post('update_profile','AuthController@update');
Route::post('buy_package','ProfileController@buy_package');
Route::get('get_orders','ProfileController@get_orders');
Route::get('check_user_package','ProfileController@check_user_package');
Route::post('update_my_password','AuthController@update_my_password');
Route::post('create_advertisement','ProfileController@create_advertisement');
Route::post('update_advertisement','ProfileController@update_advertisement');
Route::get('get_advertisemnts','ProfileController@get_ads');
Route::post('filter_my_ads','ProfileController@filter_my_ads');
Route::post('upload_ad_image','ProfileController@upload_ad_image');
Route::post('upload_ad_video','ProfileController@upload_ad_video');
Route::post('remove_ad_image','ProfileController@remove_ad_image');
Route::post('remove_ad_video','ProfileController@remove_ad_video');
Route::post('ad_toggle_view','ProfileController@ad_toggle_view');
Route::post('delete_ad','ProfileController@delete_ad');
Route::get('get_user_nots','ProfileController@get_user_nots');
Route::get('check_favorite/{id}','ProfileController@check_favorite');
Route::post('add_favorite/{id}','ProfileController@add_favorite');
Route::post('remove_favorite/{id}','ProfileController@remove_favorite');
Route::get('get_favorites','ProfileController@get_favorites');
Route::post('add_review','ProfileController@add_review');
Route::get('check_user_review/{provider_id}','ProfileController@check_user_review');
Route::post('create_communication','ProfileController@create_communication');
Route::get('get_notifications','ProfileController@get_notifications');
Route::get('notification/{id}','ProfileController@notification');
Route::post('renew_order/{id}','ProfileController@renew_order');


});


//geust routes
Route::post('/send_verification_link','AuthController@send_verification_link');
Route::post('/check_email_verification_code','AuthController@check_email_verification_code');

Route::post('/register','AuthController@register');
Route::post('/login','AuthController@login');
Route::post('/forget_password','AuthController@forget_password');
Route::post('/verify_code','AuthController@verify_code');
Route::post('/change_password','AuthController@change_password');
Route::get('/get_ads_numbers','StartController@get_ads_numbers');
Route::get('/filter_packages/{ads_number}','StartController@filter_packages');
Route::get('/paginate_packages','StartController@paginate_packages');
Route::get('get_categories','StartController@get_categories');
Route::get('get_states','StartController@get_states');
Route::get('get_countries','StartController@get_countries');
Route::get('get_cities/{id?}','StartController@get_cities');
Route::get('get_regions/{id}','StartController@get_regions');
Route::get('get_reports/{id}','StartController@get_reports');
Route::get('get_neighbors/{id}','StartController@get_neighbors');
Route::get('get_currencies','StartController@get_currencies');
Route::get('get_ad/{slug}','StartController@get_advertisement');
Route::get('get_appart_models','StartController@get_appart_models');
Route::get('get_building_ages','StartController@get_building_ages');
Route::get('get_floor_numbers','StartController@get_floor_numbers');
Route::get('get_heatings','StartController@get_heatings');
Route::get('get_title_deeds','StartController@get_title_deeds');

Route::get('similar_ads/{id}','StartController@similar_ads');
Route::get('get_recent_feartured','StartController@get_recent_feartured');
Route::post('ads_filteration','StartController@filter_ads');
Route::get('get_providers/{paginate?}','StartController@get_providers');
Route::get('get_provider/{id}','StartController@get_provider');
Route::get('get_categories_with_ads','StartController@get_categories_with_ads');
Route::get('get_reviews/{provider_id}','StartController@get_reviews');
Route::get('get_faqs','StartController@get_faqs');
Route::get('get_pages_content','StartController@get_pages_content');
Route::get('get_provider_rating/{id}','StartController@get_provider_rating');
Route::get('get_sliders','StartController@get_sliders');
Route::get('get_settings','StartController@get_settings');

//socialite
Route::get('login/google', 'SocialiteController@redirectToProvider');
Route::get('google/callback', 'SocialiteController@handleProviderCallback');
Route::get('login/facebook', 'SocialiteController@redirectToFacebookProvider');
Route::get('facebook/callback', 'SocialiteController@handleFacebookProviderCallback');

});

////////////////////////////////////
// API Application
////////////////////////////////////

Route::group(['middleware' => 'localization'], function () {

    Route::post('login-user', [UserController::class, 'login']);
    Route::post('register-user', [UserController::class, 'register']);
    Route::post('register-social', [UserController::class, 'register_social']);
    Route::post('verification', [UserController::class, 'verification']);
    Route::post('forget-pass-user', [UserController::class, 'reset_pass']);
    Route::post('new-password-user', [UserController::class,'new_password']);
    Route::get('get-country', [PublicController::class,'countries']);
    Route::get('get-city/country_id/{id}', [PublicController::class,'cities']);
    Route::get('get-police', [PublicController::class,'polices']);
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('change-password-user', [UserController::class,'change_password']);
        Route::post('update-profile', [UserController::class,'update']);
        Route::get('profile-user', [UserController::class,'show']);
        Route::get('home', [HomeController::class,'home']);
        Route::get('get-setting', [PublicController::class,'setting']);


    });
});


Route::get('test',function(){
    return \Artisan::call('passport:install');
});