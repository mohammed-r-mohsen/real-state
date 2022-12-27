<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Order;

class UsersController extends Controller
{
  
    public function home()
    {
        return view('admin.users',['pageTitle'=>'Pages','pageSubTitle'=>'Ordinary Users']);
    }
    

    public function index()
    {
        $users=User::latest()->where('is_provider','!=',1)->paginate(40);

        return $users;
    }
    public function get_users(){
        if(admin()->type=='admin'){
            return User::latest()->get();
        } else{
            return User::where('admin_id',admin()->id)->latest()->get();
        }
    }
    public function get_users_no_packages(){
        
            $users_has_package=Order::where('status','active')->pluck('user_id');
        if(admin()->type=='admin'){
        $users= User::whereNotIn('id',$users_has_package)->latest()->get();
        }else{
            $users= User::where('admin_id',admin()->id)->whereNotIn('id',$users_has_package)->latest()->get();

        }

        return $users;
    }
    public function get_users_has_packages(){
        $users_has_package=Order::where('status','active')->pluck('user_id');
        if(admin()->type=='admin'){
        $users= User::whereIn('id',$users_has_package)->latest()->get();
        }else{
            $users= User::where('admin_id',admin()->id)->whereIn('id',$users_has_package)->latest()->get();

        }
        return $users;
    }
    
  
    public function store(Request $request)
    {
        $data=$this->validate($request,[
            'name' => ['required', 'string', 'max:191'],
            'phone' => ['required', 'string', 'max:191'],
            'state_id' => ['required', 'numeric',],
            'country_id' => ['required', 'numeric',],
            'is_provider' => ['nullable', 'boolean', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'avatar' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if($request->avatar){
            $relativePath=uploadImage($request->avatar);
            $data['avatar']=$relativePath;
        }
        if($request->password){
            $data['password']=bcrypt($request->password);
        }
        $data['admin_id']=admin()->id;
        $user=User::create($data);
        return $user;
    }

    public function update(Request $request, $id)
    {
        $user=User::find($id);
        $this->validate($request,[
            'name' => ['required', 'string', 'max:191'],
            'phone' => ['required', 'string', 'max:191'],
            'state_id' => ['required', 'numeric',],
            'country_id' => ['required', 'numeric',],
            'is_provider' => ['nullable', 'boolean', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users,email,'.$id],
            'address' => ['nullable', 'string'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);
        $data=([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'is_provider'=>$request->is_provider,
            'email'=>$request->email,
            'address'=>$request->address,
        ]);
        if($request->password){
            $data['password']=bcrypt($request->password);
        }
        if($request->avatar){
            $relativePath=uploadImage($request->avatar);
            $data['avatar']=$relativePath;
        }
        $user->update($data);
        return 'success';
    }

  
    public function destroy($id)
    {
        $user=User::find($id);

        $user->delete();
        return 'success';
    }

    public function search($query){
        //  return User::where('is_provider','0')->where('name','like','%'.$query.'%')
        //     ->orwhere("email",'like','%'.$query.'%')
        //     ->orwhere("phone",'like','%'.$query.'%')
        //     ->latest()->paginate(40);

            return User::where(function($q)use ($query){
                $q->where('is_provider','!=',1)->where('name','like','%'.$query.'%');
            })
            ->orWhere(function($q)use ($query){
                $q->where('is_provider','!=',1)->where("email",'like','%'.$query.'%');
            })
            ->orWhere(function($q)use ($query){
                $q->where('is_provider','!=',1)->where("phone",'like','%'.$query.'%');
            })->paginate(40);
    }
}
