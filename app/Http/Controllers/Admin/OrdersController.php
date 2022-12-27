<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\User;
use App\Package;
use Carbon\Carbon;

class OrdersController extends Controller
{
  
    public function home()
    {
        return view('admin.orders',['pageTitle'=>'Pages','pageSubTitle'=>'Orders']);
    }
    public function index()
    {
        if(admin()->type=='admin'){
            $orders=Order::with('package')->with('user')->latest()->paginate(40);
        } else{
            $orders=Order::with('package')->with('user')->where('admin_id',admin()->id)->latest()->paginate(40);
        }
        foreach ($orders as $key => $value) {
                $package=$value->package;
                $package['lang_name']=$package->item;
                $package['lang_features']=$package->item_features;
        }
        return $orders;
    }
    public function get_order($user_id)
    {
        if($user_id!=null){
            $order=Order::with('package')->where('user_id',$user_id)->where('status','active')->first();
            if($order){
                $package=$order->package;
                $package['lang_name']=$package->item;
                $package['lang_features']=$package->item_features;
                return $order;
            }else{
                return '';
            }
        }

    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'package_id'=>'required|numeric',
            'user_id'=>'required|numeric',
        ]);
        $user=User::find($request->user_id);
        $package=Package::find($request->package_id);
        $order=Order::create([
            'package_id'=>$request->package_id,
            'user_id'=>$request->user_id,
            'start_at'=>Carbon::today(),
            'end_at'=>Carbon::today()->addMonths($package->period),
            'price'=>$package->price,
            'admin_id'=>admin()->id,
            'package_ads_number'=>$package->ads_number
        ]);
        $user->update([
            'is_provider'=>1
        ]);
        return 'success';
    }

   
    public function update(Request $request, $id)
    {
        $order=Order::find($id);
        $data=$this->validate($request,[
            'package_id'=>'required|numeric',
            'user_id'=>'required|numeric',
            'status'=>'required|string|max:191',
        ]);
        $package=Package::find($request->package_id);
        $data['price']=$package->price;
        $order->update($data);
        return 'success';
    }

  
    public function destroy($id)
    {
        $ad=Order::find($id);

        $ad->delete();
        return 'success';
    }

    public function filter_orders(Request $request){
        if(admin()->type=='admin'){
            $orders= Order::with('package')->with('user');
        } else{
            $orders= Order::with('package')->with('user')->where('admin_id',admin()->id);

        }

         if($request->user_id){
            $orders->where('user_id',$request->user_id);
        }
        if($request->package_id){
             $orders->where('package_id',$request->package_id);
            }
            if($request->status){
             $orders->where('status',$request->status);

         }

            $orders= $orders->latest()->paginate(40);
            foreach ($orders as $key => $value) {
                $package=$value->package;
                $package['lang_name']=$package->item;
                $package['lang_features']=$package->item_features;
            }
            return $orders;
    }


}
