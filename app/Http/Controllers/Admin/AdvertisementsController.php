<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Advertisement;
use App\User;
use Illuminate\Support\Facades\Validator;
use Str;
use App\Notifications\UpdateOrder;
use Illuminate\Support\Facades\Notification;
use App\Events\NotEvent;
class AdvertisementsController extends Controller
{
  
    public function home()
    {
        return view('admin.ads',['pageTitle'=>'Pages','pageSubTitle'=>'Advertisements']);
    }
    public function index()
    {
        if(admin()->type=='admin'){
            $ads=Advertisement::with(['user','category'])->latest()->paginate(40);
        }else if(admin()->type=='editor'){
            $ads=Advertisement::with(['user','category'])->where('admin_id',admin()->id)->latest()->paginate(40);

        }

        return $ads;
    }

    public function upload_ad_image(Request $request){
       
        $validator = Validator::make($request->all(), [
            'image'=>'required|file|image:jpg,png,jpeg|max:1042'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors'=>$validator->errors()
            ],200);
        }
        $file = $request->file('image');
      //Move Uploaded File
       $path=laravel_img_upload($file);

       return $path;
      
    }
    public function upload_ad_video(Request $request){
       
        $validator = Validator::make($request->all(), [
            'video'=>'required|mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi|max:102400'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors'=>$validator->errors()
            ],200);
        }
        $file = $request->file('video');
      //Move Uploaded File
       $path=laravel_video_upload($file);

       return $path;
      
    }
  
    public function store(Request $request)
    {
        $data=$this->validate($request,[
            'project_title'=>'nullable|string|max:191',
            'title_original'=>'required|string|max:191',
            'desc_original'=>'required|string|max:2000',
            'image'=>'required|string',
            'video'=>'nullable|string',
            'category_id'=>'required|numeric',
            'user_id'=>'required|numeric',
            'order_id'=>'required|numeric',
            'state_id'=>'required|numeric',
            'city_id'=>'required|numeric',
            'region_id'=>'required|numeric',
            'neighbor_id'=>'required|numeric',
            'address'=>'required|string|max:191',
            'currency'=>'required|string|max:191',
            'price'=>'required|regex:/^\d*(\.\d{2})?$/',
            'whatsapp'=>'required|string|max:191',
            'area'=>'required|regex:/^\d*(\.\d{2})?$/',
            'appart_model'=>'required|string|max:191',
            'floor_number'=>'nullable|numeric',
            'status'=>'required|string|max:191',
            'shown'=>'required|string|max:191',
            'type'=>'required|string|max:191',
        ]);
        $data['admin_id']=admin()->id;
        $data['title']=get_translate($request->title_original);
        $data['desc']=get_translate($request->desc_original);
        $data['slug']=Str::slug($request->title_original);
        if($request->video){
            $data['thumbnail']=$request->image;
        }
        $ad=Advertisement::create($data);
        return $ad;
    }

   
    public function update(Request $request, $id)
    {
        $ad=Advertisement::find($id);
        $data=$this->validate($request,[
            'project_title'=>'nullable|string|max:191',
            'title_original'=>'required|string|max:191',
            'desc_original'=>'required|string|max:2000',
            'image'=>'required|string',
            'video'=>'nullable|string',
            'category_id'=>'required|numeric',
            'user_id'=>'required|numeric',
            'order_id'=>'required|numeric',
            'state_id'=>'required|numeric',
            'city_id'=>'required|numeric',
            'region_id'=>'required|numeric',
            'neighbor_id'=>'required|numeric',
            'address'=>'required|string|max:191',
            'currency'=>'required|string|max:191',
            'price'=>'required|regex:/^\d*(\.\d{2})?$/',
            'whatsapp'=>'required|string|max:191',
            'area'=>'required|regex:/^\d*(\.\d{2})?$/',
            'appart_model'=>'required|string|max:191',
            'floor_number'=>'nullable|numeric',
            'status'=>'required|string|max:191',
            'shown'=>'required|string|max:191',
            'type'=>'required|string|max:191',
        ]);
        $data['slug']=Str::slug($request->title_original);
        $data['title']=get_translate($request->title_original);
        $data['desc']=get_translate($request->desc_original);
        if($request->video){
            $data['thumbnail']=$request->image;
        }
        $ad->update($data);
        return 'success';
    }

  
    public function destroy($id)
    {
        $ad=Advertisement::find($id);

        $ad->delete();
        return 'success';
    }

    public function filter_ads(Request $request){
        $with=['user','category'];
         $ads =admin_filter_ads($request,$with);
         return $ads;
    }

    public function view($slug){
        $ad=Advertisement::with(['user','category','state','city','region','neighbor'])->where('slug',$slug)->firstOrFail();
        return view('admin.view-ad',['ad'=>$ad,'page','pageTitle'=>'Advertisements','pageSubTitle'=>$ad->title]);
    }
    public function update_status(Request $request){
        $user=User::select(['id','email','name'])->where('id',$request->user_id)->first();
        // return $user;
        if($user){
            $ad=Advertisement::find($request->id);
            $ad->update([
                'status'=>$request->status
            ]);
            if($request->status=='active'){
                $text='Congiratulation! Your advertisement has been activated ';
            }else{
                $text=$request->message;
            }
            $title='Advertisement Status Email';
            $link='/view_advertisement/'.$ad->slug;
            Notification::send($user,new UpdateOrder($ad,$user,$text,$title,$link)); 
            $notification=$user->notifications->first();
           
            $id=$notification->id;
            $ago=now()->diffForHumans();
            event(new NotEvent($user));
            return 'success';
        }
    }   

}
