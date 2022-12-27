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
use Auth;
class ApiController extends Controller
{
    public function get_categories(Request $request){
      $cats=get_cats();
      $lang=$request->header('language');
      if($lang==''){$lang='en';}
        foreach($cats as $cat){
       	if($lang=='en'){
          $cat['name']=$cat->name_en;
          $cat['image']=url('/').$cat->image;
        }
      }
      
      
        return response()->json([
          'msg'=>'success',
            'status'=>true,
            'data'=>$cats,
            
        ],200); 
        
    }



    public function get_states(Request $request){
      $states=get_states(); /// cities
      $lang=$request->header('language');
      if($lang==''){$lang='en';}
        foreach($states as $state){
       	if($lang=='en'){
          $state['name']=$state->name_en;
        }
      }
        return response()->json([
          'msg'=>'success',
            'status'=>true,
            'data'=>$states,
            
        ],200); 
    }





    public function get_cities($id=null){
        if($id==''){
            $cities= City::latest()->get();
        }else{
            $cities= City::where('state_id',$id)->latest()->get();
        }
      return response()->json([
            'data'=>$cities,
            'msg'=>'success',
            'status'=>true
        ],200); 
    }
    public function get_regions($id){
        return Region::where('city_id',$id)->latest()->get();
    }
    public function get_neighbors($id){
        return Neighbor::where('region_id',$id)->latest()->get();
    }
    public function get_currencies(){
        return get_currencies();
    }
    public function get_appart_models(){
        return AppartModel::latest()->get();
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
        $ad=Advertisement::with('files')->where('slug',$slug)->latest()->first();
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
        return $provider;
    }
    public function get_provider_rating($id){
        return provider_reviews($id);
    }

    public function get_categories_with_ads(){
        $cats=Category::latest()->get();
        foreach ($cats as $key => $cat) {
            $cat['ads']=get_cat_ads($cat->id,3);
        }
        return $cats;
    }
    public function get_reviews($provider_id){
        // return $provider_id;
       return get_reviews($provider_id);
    }
    public function get_faqs(){
        // return $provider_id;
       return get_faqs();
    }
    public function get_pages_content(){
       return page();
    }
    
}
