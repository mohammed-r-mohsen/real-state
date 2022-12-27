<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Package;
use App\Order;
use App\User;
use App\AdFile;
use App\Admin;
use App\Advertisement;
use App\Favorite;
use App\Review;
use App\Communication;
use Carbon\Carbon;
use Thumbnail;
use Auth;
use Illuminate\Support\Facades\Validator;
use File;
use Str;
use App\Notifications\UpdateOrder;
use Illuminate\Support\Facades\Notification;
use Image;

class ProfileController extends Controller
{

    public function createThumbnail($path, $width, $height)
    {
        $img = Image::make($path)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($path);
    }

    protected function rules(){
        return [
            'project_title'=>'nullable|string|max:191',
            'desc_original'=>'required|string|max:2000',
            'image'=>'required|string',
            'title_original'=>'required|string|max:191',
            'video'=>'nullable|string',
            'category_id'=>'required|numeric',
            'user_id'=>'required|numeric',
            'state_id'=>'required|numeric',
            'lat'=>'required',
            'lng'=>'required',
            'city_id'=>'required|numeric',
            'region_id'=>'required|numeric',
            'neighbor_id'=>'required|numeric',
            'address'=>'required|string|max:191',
            'currency'=>'required|string|max:191',
            'price'=>'required',
            'whatsapp'=>'required|string|max:191',
            'area'=>'required',
            'appart_model'=>'required|string|max:191',
            'floor_number_id'=>'nullable|numeric',
            'type'=>'required|string|max:191',
            'floor_count'=>'required|numeric|max:9999999999',
            'building_age'=>'required',
            'heating_id'=>'required|numeric',
            'title_deed_id'=>'required|numeric',
            'bathroom'=>'required|numeric|max:9999999999',
            'balacony'=>'required|boolean',
            'furnished'=>'required|boolean',
            'available_for_loan'=>'required|boolean',
            
        ];
    }

    public function test(){
        $admin=Admin::first();
        $ad=Advertisement::first();
        $user=User::first();
            Notification::send($admin,new UpdateOrder($ad,$user));
            return 'done';
    }
    public function buy_package(Request $request){
        $user=$request->user();
        $old_package=unactivate_user_orders($user->id);
        if($old_package){
            $old_ads=$old_package->package_ads_number - $old_package->ads_number;
        }else{
            $old_ads=0;
        }
        $package=Package::find($request->id);
        $order=Order::create([
            'package_id'=>$request->id,
            'user_id'=>$user->id,
            'start_at'=>Carbon::today(),
            'end_at'=>Carbon::today()->addMonths($package->period),
            'price'=>$package->price,
            'package_ads_number'=>$package->ads_number,
            'old_ads'=>$old_ads
        ]);
        $user->update([
            'is_provider'=>1
        ]);
        return 'success';
    }

    public function get_orders(Request $request){
        $user=$request->user();
        $orders=Order::with('package')->where('user_id',$user->id)->latest()->get();
        foreach ($orders as $key => $order) {
            ////converting package name
            $end_at=Carbon::createFromFormat('Y-m-d',$order->end_at);
            $now=Carbon::createFromFormat('Y-m-d',Carbon::today()->format('Y-m-d'));
            if($now->gt($end_at)){
                $order->update([
                    'status'=>'unavailable'
                ]);
            }
        }
        return $orders;
    }
   public function check_user_package(Request $request){
        $user=$request->user();
        $order=Order::where('user_id',$user->id)->where('status','active')->first();
        return $order;
    }

    public function upload_ad_image(Request $request){
       
        $validator = Validator::make($request->all(), [
            'image'=>'required|file|image:jpg,png,jpeg|max:500'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors'=>$validator->errors()
            ],200);
        }
        $file = $request->file('image');
        



       $path=laravel_img_upload($file);

       return $path;
      
    }
    public function upload_ad_video(Request $request){
       
        $validator = Validator::make($request->all(), [
            'video'=>'required|max:1200|mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors'=>$validator->errors()
            ],200);
        }
        $file = $request->file('video');
      //Move Uploaded File
       $path=laravel_video_upload($file);
    //    if($path){
        
    //     $timestamp= str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
    //     $thumbnail_image=$timestamp.".jpg";
    //     $thumbnail_status = Thumbnail::getThumbnail($path,'/uploads',$thumbnail_image);
    //    }

       return $path;
      
    }
    public function remove_ad_image(Request $request){
        $path=substr($request->path, 1);
            if(file_exists($path)) {
                unlink($path);
                return 'ok';
            }else{
                return 'not found';
            }
    }
    public function remove_ad_video(Request $request){
        $path=substr($request->path, 1);
            if(file_exists($path)) {
                unlink($path);
                return 'ok';
            }else{
                return 'not found';
            }
    }

   public function create_advertisement(Request $request){
        $data=$this->validate($request,$this->rules());
        if($request->video){
            $data['thumbnail']=$request->image;
        }
        $data['title']=get_translate($request->title_original);
        $data['desc']=get_translate($request->desc_original);
        $data['slug']=Str::slug($request->title_original);
        $user=$request->user();
        $order=Order::with('package')->where('user_id',$user->id)->where('status','active')->first();
        
        if($order){
             $data['order_id']=$order->id;
        if($user->id==$request->user_id){
            $ad=Advertisement::create($data);
            $order->update([
                'ads_number'=>$order->ads_number+1
            ]);
            if($order->ads_number>= $order->package->ads_number){
                $order->update([
                    'status'=>'unavailable'
                ]);
            }
            if($request->sliders){
                foreach ($request->sliders as $key => $slider) {
                    if($slider['image']){
                        AdFile::create([
                            'file'=>$slider['image'],
                            'advertisement_id'=>$ad->id
                        ]);
                    }
                }
            }
            // notificate Admin
            $admin=Admin::first();
            $text='New Advertisement Create Request From '.$user->name;
            $title='Advertisement Create Requeest';
            $link='/admin/view_advertisement/'.$ad->slug;
            Notification::send($admin,new UpdateOrder($ad,$user,$text,$title,$link));
            return $ad;
        }
        }
       
        
        
    }
   public function update_advertisement(Request $request){
        $data=$this->validate($request,$this->rules());
        if($request->video){
            $data['thumbnail']=$request->image;
        }
        $data['title']=get_translate($request->title_original);
        $data['desc']=get_translate($request->desc_original);
        $data['slug']=Str::slug($request->title_original);
        $user=$request->user();
        if($user->id==$request->user_id){
            $ad=Advertisement::find($request->id);
            
            $ad->update($data);
            // notificate Admin
            $admin=Admin::first();
            $text='New Advertisement Update Request From '.$user->name;
            $title='Advertisement Update Requeest';
            $link='/admin/view_advertisement/'.$ad->slug;
            Notification::send($admin,new UpdateOrder($ad,$user,$text,$title,$link));
        }
        return $ad;
        
    }

    public function get_ads(Request $request){
        $user=$request->user();
        $ads=Advertisement::with('category')->with('order')->where('user_id',$user->id)->latest()->get();
        return $ads;
    }
    public function filter_my_ads(Request $request){
        $user=$request->user();
        $ads=Advertisement::with('category')->with('order')->where('user_id',$user->id);
        if($request->title){
            $ads->where('title','like','%'.$request->title.'%');
        }
        if($request->category_id){
            $ads->where('category_id',$request->category_id);
        }
        if($request->status){
            $ads->where('status',$request->status);
        }
        return $ads->latest()->get();
    }

    public function ad_toggle_view(Request $request){
        $user=$request->user();
        // return $request->id;
        $ad=Advertisement::find($request->id);
        if($ad->user_id==$user->id){
            if($ad->shown=='shown'){
                $status='hiden';
            }else{
                $status='shown';
            }
            $ad->update([
                'shown'=>$status
            ]);

            return 'success';
        }
    }

    public function delete_ad(Request $request){
        $user=$request->user();
        $ad=Advertisement::find($request->id);
        if($ad->user_id == $user->id){
            $ad->delete();
            return 'deleted';
        }
    }
    public function get_ad(Request $request,$slug){
        $user=$request->user();
        $ad=Advertisement::with('user')->where('slug',$slug)->first();
        if(!$user){
            if($ad->status=='active'){
                // return $ad;
            }
        }elseif($user){
            if($ad->status!='active' && $user->id==$ad->user_id){
                // return $ad;
            }
        }
    }

    public function get_user_nots(Request $request){
        $user=$request->user();
        $nots= $user->unreadNotifications;
        foreach ($nots as $key => $value) {
            $value['ago']=$value->created_at->diffForHumans();
        }
        return $nots;
    }

    public function check_favorite(Request $request,$id){
        $user=$request->user();
          $fav= Favorite::where('user_id',$user->id)->where('advertisement_id',$id)->first();
         
          return $fav;
    }
    public function add_favorite(Request $request,$id){
        $user=$request->user();
          $fav= Favorite::where('user_id',$user->id)->where('advertisement_id',$id)->first();
          if(!$fav){
            Favorite::create([
                'advertisement_id'=>$id,
                'user_id'=>$user->id
            ]);
          }
         
          return 'true';
    }
    public function remove_favorite(Request $request,$id){
        $user=$request->user();
          $fav= Favorite::where('user_id',$user->id)->where('advertisement_id',$id)->first();
          if($fav){
            $fav->delete();
          }
         
          return 'true';
    }
    public function get_favorites(Request $request){
        $user=$request->user();
          $favs= Favorite::where('user_id',$user->id)->latest()->paginate(20);
          foreach ($favs as $key => $value) {
            $value['advertisement']=Advertisement::with(['user','category','city','region','neighbor'])->where('id',$value->advertisement_id)->first();
          }
          return $favs;
    }

    public function add_review(Request $request){
        $user=$request->user();
        if($user){
            $data=$this->validate($request,[
                'review'=>'required|string|max:400|min:20',
                'rating'=>'required|numeric|min:1',
                'provider_id'=>'required|numeric',
            ]);
            $data['user_id']=$user->id;
            Review::create($data);
            return 'ok';
        }
        
    }
    public function check_user_review(Request $request,$provider_id){
        $review=Review::where('user_id',$request->user()->id)->where('provider_id',$provider_id)->first();
        if($review){
            return 'true';
        }else{
            return 'false';
        }
    }
    public function create_communication(Request $request){
        $user=$request->user();
        $communication=Communication::where('user_id',$user->id)->where('tool',$request->tool)->first();
        if(!$communication){
            Communication::create([
                'tool'=>$request->tool,
                'provider_id'=>$request->provider_id,
                'user_id'=>$user->id,
            ]);
        }
        return 'ok';
    }
    public function get_notifications(Request $request){
        $user=$request->user();
        $nots=$user->notifications;
        foreach ($nots as $key => $not) {
            $not['ago']=$not->created_at->diffForHumans();
        }
        return $nots;
    }
    public function notification(Request $request,$id){
        $user=$request->user();
        $userUnreadNotification = $user
                            ->notifications
                            ->where('id', $id)
                            ->first();
        if($userUnreadNotification){
            $userUnreadNotification->markAsRead();
            return 'ok';
        }else{
            return 'not-found';
        }
    }

    public function renew_order($id){
        $order=Order::with('package')->find($id);
        $package=$order->package;
        // unactivate_user_orders($user->id);
        Order::create([
            'package_id'=>$package->id,
            'user_id'=>$order->user_id,
            'start_at'=>Carbon::today(),
            'end_at'=>Carbon::today()->addMonths($package->period),
            'price'=>$package->price,
            'package_ads_number'=>$package->ads_number
        ]);
        $order->delete();
        return 'success';
    }

}
