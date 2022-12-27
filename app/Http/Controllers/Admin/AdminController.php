<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Advertisement;
use App\Order;
use App\Package;
use App\User;

class AdminController extends Controller
{
    public function login(){

        if(auth()->guard('admin')->check()){
            return redirect ('/admin/dashboard');
        }else{
            return view('admin.login',['nonav'=>'','nosidebar'=>'','nofoot']);
        }
    }
   
   public function dologin(){
       $this->validate(request(),[
            'email'=>'email|exists:admins,email',
            'password'=>'string'
       ]);
    	$remember=request('remember')==1?true:false;
    	if(auth()->guard('admin')->attempt(['email'=>request('email'),'password'=>request('password')],$remember)){

    		return redirect('admin/dashboard');
    	}else{
    		session()->flash('error','These credentials do not match our records.');
    		return redirect('admin/login');
    	}
    }

    public function logout(){
    	auth()->guard('admin')->logout();
    	return redirect('admin/login');
    }
    public function dashboard(){
        $data=[];
        $data['ads']=Advertisement::count();
        $data['packages']=Package::count();
        $data['orders']=Order::count();
        $data['all_users']=User::count();
        $data['ordinary_users']=User::where('is_provider','!=',1)->count();
        $data['provider_users']=User::where('is_provider',1)->count();
        return view('admin.dashboard',['data'=>$data]);
    }
    public function get_recent_nots(){
        $nots= admin()->unreadNotifications;
        foreach ($nots as $key => $not) {
            $not['ago']=$not->created_at->diffForHumans();
        }
        return $nots;

    }

    public function edit_profile(){
        return view('admin.profile',['pageTitle'=>'Pages','pageSubTitle'=>'Profile']);
    }

    public function notifications(){
        $nots=admin()->notifications;
        foreach ($nots as $key => $not) {
            $not['ago']=$not->created_at->diffForHumans();
            // return $not['data']['user'];
        }
        // return $nots;
        return view('admin.nots',['nots'=>$nots,'pageTitle'=>'Pages','pageSubTitle'=>'Notifications']);
    }
    
    public function notification($id){
        $userUnreadNotification = admin()
                            ->notifications
                            ->where('id', $id)
                            ->first();
        if($userUnreadNotification){
            $userUnreadNotification->markAsRead();
            return redirect($userUnreadNotification['data']['link']);
        }else{
            return back();
        }
    }

    
}
