<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;

class AdminsController extends Controller
{
  
    public function home()
    {
        return view('admin.editors',['pageTitle'=>'Pages','pageSubTitle'=>'Editors']);
    }

    public function index()
    {
        $editors=Admin::latest()->where('type','editor')->paginate(40);
        return $editors;
    }
    
  
    public function store(Request $request)
    {
        $data=$this->validate($request,[
            'name' => ['required', 'string', 'max:191'],
            'type' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:admins'],
            'avatar' => ['nullable', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if($request->avatar){
            $relativePath=uploadImage($request->avatar);
            $data['avatar']=$relativePath;
        }
        if($request->password){
            $data['password']=bcrypt($request->password);
        }
        $admin=Admin::create($data);
        return $admin;
    }


    public function update(Request $request, $id)
    {
        $admin=Admin::find($id);
        $this->validate($request,[
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:admins,email,'.$id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);
        $data=([
            'name'=>$request->name,
            'email'=>$request->email,
        ]);
        if($request->password){
            $data['password']=bcrypt($request->password);
        }
        if($request->avatar){
            $relativePath=uploadImage($request->avatar);
            $data['avatar']=$relativePath;
        }

        $admin->update($data);
        return 'success';
    }

  
    public function destroy($id)
    {
        $admin=Admin::find($id);

        $admin->delete();
        return 'success';
    }

    public function search($query){

            return Admin::where(function($q)use ($query){
                $q->where('type','editor')->where('name','like','%'.$query.'%');
            })
            ->orWhere(function($q)use ($query){
                $q->where('type','editor')->where("email",'like','%'.$query.'%');
            })
            ->paginate(40);
    }
}
