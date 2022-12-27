<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\State;
use App\City;
use App\Region;
use App\Neighbor;
use App\AppartModel;
use App\Currency;
use App\Advertisement;
use App\User;
use App\AdsNumber;
use App\BuildingAge;
use App\FloorNumber;
use App\Heating;
use App\TitleDeed;
use Auth;
use App\Event\NotEvent;
class StartController extends Controller
{
    public function get_categories(){
        return admin_categories();
    }
    public function get_countries(){
        return get_countries();
    }
    public function get_states(){
        return admin_states();
    }
    public function get_cities($id=null){
        return admin_cities(null,$id);
    }
    public function get_regions($id){
        return admin_regions(null,$id);
    }
    public function get_neighbors($id){
        return admin_neighbors(null,$id);
    }
    public function get_currencies(){
        return admin_currencies();
    }
    public function get_appart_models(){
        return AppartModel::latest()->get();
    }
    public function get_building_ages(){
        return BuildingAge::latest()->get();
    }
    public function get_floor_numbers(){
        return admin_floor_numbers();
    }
    public function get_heatings(){
        return admin_heatings();
    }
    public function get_title_deeds(){
        return admin_title_deeds();
    }
    public function filter_packages($ads_number){
    
        return filter_packages($ads_number);
    }
    public function paginate_packages(){
        
        return get_packages(4);
    }
    public function get_recent_feartured(){
        
        return get_featured(3);
    }
    public function get_advertisement(Request $request,$slug){
        $user=$request->user();
        $ad=Advertisement::with(['files','category','city','region','neighbor'])->where('slug',$slug)->latest()->first();
        $ad['user']=User::with('state')->where('id',$ad->user_id)->first();
        if($ad){
            return $ad;
        }else{
            return '';
        }
    }

    public function similar_ads($id){
    $ads=Advertisement::with(['user','category','city','region','neighbor'])->where('status','active')->where('shown','shown')->latest()->paginate(3);
    return $ads;
    }
    public function filter_ads(Request $request){
      return  filter_ads($request,20);
        
    }
    public function get_providers($paginate=null){
        if($paginate==null){
            return get_providers(20);
        }else{
            return get_providers($paginate);
        }
    }
    public function get_provider($id){
        $provider=User::with('state')->find($id);
        $provider['rating']=provider_reviews($id);
        $provider['state']['lang_name']=json_decode($provider['state']['name'])->{session('lang')};
        return $provider;
    }
    public function get_provider_rating($id){
        return provider_reviews($id);
    }

    public function get_categories_with_ads(){
        $cats=admin_categories();
        foreach ($cats as $key => $cat) {
            $cat['ads']=get_cat_ads($cat->id,3);
        }
        return $cats;
    }
    public function get_reviews($provider_id){
        // return $provider_id;
       return get_reviews($provider_id);
    }
    public function get_reports($provider_id){
        // return $provider_id;
       return get_reports($provider_id);
    }
    public function get_faqs(){
        // return $provider_id;
       return get_faqs();
    }
    public function get_pages_content(){
       return page();
    }
    public function get_sliders(){
       return get_sliders();
    }
    public function get_ads_numbers(){
        return AdsNumber::get();
    }

    public function get_lang(){
        $lang= session('lang');
        return $lang;
    }
    public function get_settings(){
        return settings();
    }
    
    public function send(){
        return view('vendor.notifications.test_mail');
    }

}
