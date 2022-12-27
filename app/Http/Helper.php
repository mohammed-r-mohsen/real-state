<?php 
use App\Admin;
use App\Category;
use App\State;
use Illuminate\Support\Str;
use App\Advertisement;
use App\Currency;
use App\Country;
use App\City;
use App\Region;
use App\Neighbor;
use App\Heating;
use App\FloorNumber;
use App\TitleDeed;
use App\Package;
use App\Order;
use App\User;
use App\Faq;
use App\Page;
use App\Review;
use App\Communication;
use App\Settings;
use App\Slider;
use Mcamara\LaravelLocalization\LaravelLocalization;
use Stichoza\GoogleTranslate\GoogleTranslate;


function locale ()
{
    return Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale();
}

function locales ()
{
    $arr = [];
    foreach (Mcamara\LaravelLocalization\Facades\LaravelLocalization::getSupportedLocales() as $key => $value) {
        $arr[$key] = __('' . $value['name']);
    }
    return $arr;
}

if(!function_exists('user')){
    function user(){
        return User::first();
    }
}
if(!function_exists('admin')){
    function admin(){
        return Auth::guard('admin')->user();
    }
}
if(!function_exists('settings')){
    function settings(){
        return Settings::first();
    }
}


if(!function_exists('get_translate')){
    function get_translate($string){

        foreach (locales() as $key => $language) {
            $r = Stichoza\GoogleTranslate\GoogleTranslate::trans($string,$key);
            $data[$key] = $r;
            
        }

        return $data;
    }

}


function mainResponse ($status, $msg, $items,$code = 200)
{


    $newData = ['status' => $status, 'message' => $msg,'data' => $items,'code'=>$code];

    return response()->json($newData);
}


if(!function_exists('user')){
    function user(){
        return User::first();
    }
}
if(!function_exists('admin')){
    function admin(){
        return Auth::guard('admin')->user();
    }
}
if(!function_exists('settings')){
    function settings(){
        return Settings::first();
    }
}


if(!function_exists('uploadImage')){
    function uploadImage($image){
        if(preg_match('/^data:image\/(\w+);base64,/',$image,$type)){
            $image=substr($image,strpos($image,',')+1);
            $type=strtolower($type[1]);
            if(!in_array($type,['jpg','jpeg','png','gif'])){
                throw new \Exeption('invalid image type');
            }

            $image=str_replace(' ','+',$image);
            $image=base64_decode($image);

        }else{
            return response()->json([
                'message'=>'do not match an image data'
            ],500);
        }

        $dir='uploads/';
        $file=Str::random() . '.' .$type;
        $relativePath=$dir.$file;
        file_put_contents($relativePath,$image);
        return '/'.$relativePath;
    }
}
if(!function_exists('laravel_img_upload')){
    function laravel_img_upload($file){
        $destinationPath = 'uploads';
        $file_name=$file->getClientOriginalName();
        $temp= explode('.',$file_name);
        $extension = end($temp);
      $filename=Str::random().'.'.$extension;
      $file->move($destinationPath,$filename);
      return '/'.$destinationPath.'/'.$filename;
    }
       
}
if(!function_exists('laravel_video_upload')){
    function laravel_video_upload($file){
    $destinationPath = 'uploads/videos';
    $file_name=$file->getClientOriginalName();
        $temp= explode('.',$file_name);
        $extension = end($temp);
      $filename=Str::random().'.'.$extension;
      $file->move($destinationPath,$filename);
      return '/'.$destinationPath.'/'.$filename;
    }
       
}
if(!function_exists('admin_filter_ads')){
    function admin_filter_ads($request,$with){
        if(admin()->type=='admin'){
            $ads= Advertisement::with($with);
        }else if(admin()->type=='editor'){
            $ads= Advertisement::with($with)->where('admin_id',admin()->id);
        }
         if($request->state_id){
            $ads->where('state_id',$request->state_id);
        }
        if($request->city_id){
             $ads->where('city_id',$request->city_id);
            }
        if($request->region_id){
             $ads->where('region_id',$request->region_id);
         }
        if($request->neighbor_id){
             $ads->where('neighbor_id',$request->neighbor_id);
         }
        if($request->status){
             $ads->where('status',$request->status);
         }
        if($request->shown){
             $ads->where('shown',$request->shown);
         }
        if($request->search){
             $ads->where('title','like','%'.$request->search.'%');
         }

            return $ads->latest()->paginate(40);
    }

       
}

if(!function_exists('get_states')){
    function get_states($paginate=0){
        if($paginate==0){
            $states= State::latest()->get();
        }else{
            $states=State::latest()->paginate($paginate);
        }
        return $states;
    }      
}
if(!function_exists('get_countries')){
    function get_countries($paginate=0){
        if($paginate==0){
            $countries= Country::latest()->get();
            foreach ($countries as $key => $value) {
                $value['country_phone_code']=$value->country_code.'('.$value->phone_code.')';
            }
        }else{
            $countries=Country::latest()->paginate($paginate);
        }
        return $countries;
    }      
}
if(!function_exists('get_currencies')){
    function get_currencies($paginate=0){
        return Currency::latest()->get();    
}
}

// if(!function_exists('get_packages')){
//     function get_packages($user_id=null,$paginate=0){
//         $packages=Package::latest();
//         $user=User::find($user_id);
//         if($user){
//             $order=Order::where('user_id',$user->id)->where('status','active')->first();
//             if($order){
//                 $packages->where('price','>',$order->price);
//             }
//         }
//         if($paginate==0){
//              $packages->get();
//             }else{
//             $packages->paginate($paginate);
//         }

//         return $packages;
// }
// }
if(!function_exists('get_packages')){
    function get_packages($paginate=0){

        if($paginate==0){
            $packages= Package::latest()->get();
        }else{
            $packages=Package::latest()->paginate($paginate);
        }
        return $packages;
}
}
if(!function_exists('filter_packages')){
    function filter_packages($ads_number){
        if($ads_number){
            $packages= Package::where('ads_number',$ads_number)->latest()->get();
        }else{
            $packages= Package::latest()->get();
        }
        foreach ($packages as $key => $value) {
                
                $value['lang_name']=$value->item;
                $value['lang_features']=$value->item_features;
          
        }
        return $packages;
}
}
if(!function_exists('get_featured')){
    function get_featured($paginate=0){

        if($paginate==0){
            $ads= Advertisement::with(['user','category','city','region','neighbor'])->where('status','active')->where('shown','shown')->latest()->get();
        }else{
            $ads=Advertisement::with(['user','category','city','region','neighbor'])->where('status','active')->where('shown','shown')->latest()->paginate($paginate);
        }
        return $ads;
}
}

if(!function_exists('unactivate_user_orders')){
    function unactivate_user_orders($user_id){
        $user=User::find($user_id);
      if($user){
        $orders=Order::where('user_id',$user_id)->latest();
        foreach ($orders->get() as $key => $order) {
            $order->update([
                'status'=>'unavailable'
            ]);
        }

        return $orders->first();
      }
}
}

if(!function_exists('filter_ads')){
    function filter_ads($request,$paginate){
    $ads=Advertisement::with(['user','category','city','region','neighbor'])->where('status','active')->where('shown','shown');
    if($request->search){
        // $ads->where(['title'=>'like','%'.$request->search.'%','desc'=>'like','%'.$request->search.'%']);
        $ads->where('title','like','%'.$request->search.'%');
    }
    if($request->user_id){
        $ads->where('user_id',$request->user_id);
    }
    if($request->category_id){
        $ads->where('category_id',$request->category_id);
    }
    if($request->type){
        $ads->where('type',$request->type);
    }
    if($request->state_id){
        $ads->where('state_id',$request->state_id);
    }
    if($request->city_id){
        $ads->where('city_id',$request->city_id);
    }
    if($request->region_id){
        $ads->where('region_id',$request->region_id);
    }
    if($request->neighbor_id){
        $ads->where('neighbor_id',$request->neighbor_id);
    }
    if($request->currency){
        $ads->where('currency',$request->currency);
    }
    if($request->balacony){
        $ads->where('balacony',$request->balacony);
    }
    if($request->furnished){
        $ads->where('furnished',$request->furnished);
    }
    if($request->available_for_loan){
        $ads->where('available_for_loan',$request->available_for_loan);
    }
    if($request->floor_count){
        if($request->floor_count<=30){
            $ads->where('floor_count',$request->floor_count);
        }else{
            $ads->where('floor_count','>',30);
        }
    }
    if($request->bathroom){
        if($request->bathroom<=6){
            $ads->where('bathroom',$request->bathroom);
        }else{
            $ads->where('bathroom','>',6);
        }
    }
    if($request->price_from && $request->price_to ){
        $ads->whereBetween('price',[$request->price_from,$request->price_to]);
    }
    if($request->area_from && $request->area_to ){
        $ads->whereBetween('area',[$request->area_from,$request->area_to]);
    }
    if($request->heatings){
        $ads->whereIn('heating_id',$request->heatings);
    }
    
    
    return $ads->latest()->paginate($paginate);
}
}

if(!function_exists('get_cat_ads')){
    function get_cat_ads($category_id=null,$paginate){
      return  $ad=Advertisement::with(['user','category','city','region','neighbor'])->where('status','active')
            ->where('shown','shown')->where('category_id',$category_id)->paginate($paginate);
    }
}
if(!function_exists('get_providers')){
    function get_providers($paginate){
     $providers=User::with('state')->where('is_provider',1)->latest()->paginate($paginate);
        foreach ($providers as $key => $provider) {
                $provider['rating']=provider_reviews($provider->id);
            

        }
        return $providers;
    }
}
if(!function_exists('get_reviews')){
    function get_reviews($provider_id){
     $reviews=Review::with('user')->where('provider_id',$provider_id)->latest()->get();
    return $reviews;
    }
}
if(!function_exists('provider_reviews')){
    function provider_reviews($provider_id){
    $reviews=Review::where("provider_id",$provider_id);
            if($reviews->count() > 0){
                $total=$reviews->count() * 5;
                $my_review=$reviews->sum('rating');
                return ($my_review/$total)*5;
            }else{
                return 0;
            }
    }
}

if(!function_exists('get_faqs')){
    function get_faqs(){
     $faqs=Faq::latest()->get();
    return $faqs;
    }
}
if(!function_exists('page')){
    function page(){
     $page=Page::first();
    return $page;
    }
}
if(!function_exists('get_reports')){
    function get_reports($id){
        $data=[];
    $communication=Communication::where('provider_id',$id);
    $whatsapp=$communication->where('tool','whatsapp')->count();
    $phone=$communication->where('tool','phone')->count();
    $email=$communication->where('tool','email')->count();
    $ads=Advertisement::where('user_id',$id);
    $active_ads=$ads->where('status','active')->count();
    $pending_ads=$ads->where('status','pending')->count();
    $refused_ads=$ads->where('status','refused')->count();
    $data['whatsapp']=$whatsapp;
    $data['phone']=$phone;
    $data['email']=$email;
    $data['active_ads']=$active_ads;
    $data['pending_ads']=$pending_ads;
    $data['refused_ads']=$refused_ads;
        return $data;
    }
}

if(!function_exists('get_sliders')){
    function get_sliders(){
     $sliders=Slider::latest()->get();
    return $sliders;
    }
}



//////////////////////  

if(!function_exists('admin_categories')){
    function admin_categories($paginate=null){
        if($paginate!=null){
            $categories=Category::latest()->paginate(40);
        }else{
            $categories=Category::latest()->get();
        }
        foreach ($categories as $key => $category) {
                $category['lang_name']=$category->item;
        }

        return $categories;
    }
}
if(!function_exists('admin_countries')){
    function admin_countries($paginate=null){
        if($paginate!=null){
            $countries=Country::latest()->paginate(40);
        }else{
            $countries=Country::latest()->get();
        }
        foreach ($countries as $key => $value) {
                
                $value['lang_name']=$value->item;
        }

        return $countries;
    }
}
if(!function_exists('admin_currencies')){
    function admin_currencies($paginate=null){
        if($paginate!=null){
            $currencies=Currency::latest()->paginate(40);
        }else{
            $currencies=Currency::latest()->get();
        }
        foreach ($currencies as $key => $value) {
                $value['lang_name']=$value->item;
        }

        return $currencies;
    }
}
if(!function_exists('admin_heatings')){
    function admin_heatings($paginate=null){
        if($paginate!=null){
            $heatings=Heating::latest()->paginate(40);
        }else{
            $heatings=Heating::latest()->get();
        }
        foreach ($heatings as $key => $value) {
                
                $value['lang_name']=$value->item;
        }

        return $heatings;
    }
}
if(!function_exists('admin_floor_numbers')){
    function admin_floor_numbers($paginate=null){
        if($paginate!=null){
            $floor_numbers=FloorNumber::latest()->paginate(40);
        }else{
            $floor_numbers=FloorNumber::latest()->get();
        }
        foreach ($floor_numbers as $key => $value) {
                
                $value['lang_name']=$value->item;
        }

        return $floor_numbers;
    }
}
if(!function_exists('admin_title_deeds')){
    function admin_title_deeds($paginate=null){
        if($paginate!=null){
            $title_deeds=TitleDeed::latest()->paginate(40);
        }else{
            $title_deeds=TitleDeed::latest()->get();
        }
        foreach ($title_deeds as $key => $value) {
                
                $value['lang_name']=$value->item;
        }

        return $title_deeds;
    }
}
if(!function_exists('admin_states')){
    function admin_states($paginate=null){
        if($paginate!=null){
            $states=State::with('country')->latest()->paginate(40);
        }else{
            $states=State::with('country')->latest()->get();
        }
        foreach ($states as $key => $value) {
                
                $value['lang_name']=$value->item;
                $country=$value->country;
                $country['lang_name']=$country->item;
                $value['country']=$country;
        }

        return $states;
    }
}
if(!function_exists('admin_cities')){
    function admin_cities($paginate=null,$state_id=null){
        if($paginate!=null){
            if($state_id==null){
                $cities=City::with('state')->latest()->paginate(40);
            }else{
                $cities=City::with('state')->where('state_id',$state_id)->latest()->paginate(40);
            }
        }else{
            if($state_id==null){
                $cities=City::with('state')->latest()->get();
            }else{
                $cities=City::with('state')->where('state_id',$state_id)->latest()->get();
            }
            
        }
        foreach ($cities as $key => $value) {
                
                $value['lang_name']=$value->item;
                $state=$value->state;
                $state['lang_name']=$state->item;
                $value['state']=$state;
                $value['custom_name']=$value['lang_name'].'('.$state['lang_name'].')';
        }

        return $cities;
    }
}
if(!function_exists('admin_regions')){
    function admin_regions($paginate=null,$city_id=null){
        if($paginate!=null){
            if($city_id==null){
                $regions=Region::with('city')->latest()->paginate($paginate);
            }else{
                $regions=Region::with('city')->where('city_id',$city_id)->latest()->paginate($paginate);
            }
        }else{
            if($city_id==null){
                $regions=Region::with('city')->latest()->get();
            }else{
                $regions=Region::with('city')->where('city_id',$city_id)->latest()->get();
            }
            
        }
        foreach ($regions as $key => $value) {
                
                $value['lang_name']=$value->item;
                $city=$value->city;
                $city['lang_name']=$city->item;
                $value['city']=$city;
                $value['custom_name']=$value['lang_name'].'('.$city['lang_name'].')';
        }

        return $regions;
    }
}
if(!function_exists('admin_neighbors')){
    function admin_neighbors($paginate=null,$region_id=null){
        if($paginate!=null){
            if($region_id==null){
                $neighbors=Neighbor::with('region')->latest()->paginate($paginate);
            }else{
                $neighbors=Neighbor::with('region')->where('region_id',$region_id)->latest()->paginate($paginate);
            }
        }else{
            if($region_id==null){
                $neighbors=Neighbor::with('region')->latest()->get();
            }else{
                $neighbors=Neighbor::with('region')->where('region_id',$region_id)->latest()->get();
            }
            
        }
        foreach ($neighbors as $key => $value) {
                
                $value['lang_name']=$value->item;
                $region=$value->region;
                $region['lang_name']=$region->item;
                $value['region']=$region;
                $value['custom_name']=$value['lang_name'].'('.$region['lang_name'].')';
        }

        return $neighbors;
    }
}
if(!function_exists('admin_packages')){
    function admin_packages($paginate=null,$user_id=null){
        if($paginate!=null){
            if($user_id==null){
                $packages=Package::latest()->paginate(40);
            }else{
                $packages=Package::where('user_id',$user_id)->latest()->paginate(40);
            }
        }else{
            if($user_id==null){
                $packages=Package::latest()->get();
            }else{
                $packages=Package::where('user_id',$user_id)->latest()->get();
            }
            
        }
        foreach ($packages as $key => $value) {
                
                $value['lang_name']=$value->item;
                $value['lang_features']=$value->item_features;
          
        }

        return $packages;
    }
}
if(!function_exists('admin_faqs')){
    function admin_faqs($paginate=null){
        if($paginate!=null){
            $faqs=Faq::latest()->paginate(40);
        }else{
            $faqs=Faq::latest()->get();
        }
        foreach ($faqs as $key => $value) {
                $value['lang_question']=$value->question;
                $value['lang_answer']=$value->answer;;
        }

        return $faqs;
    }
}