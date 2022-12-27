<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class ProvidersController extends Controller
{
  
    public function home()
    {
        return view('admin.providers',['pageTitle'=>'Pages','pageSubTitle'=>'services providers']);
    }

    public function index()
    {
        if(admin()->type=='admin'){
            $users=User::latest()->where('is_provider','1')->paginate(40);
        } else{
            $users=User::latest()->where('is_provider','1')->where('admin_id',admin()->id)->paginate(40);
        }

        return $users;
    }
    
  
    public function store(Request $request)
    {
        $data=$this->validate($request,[
            'name' => ['required', 'string', 'max:191'],
            'phone' => ['required', 'string', 'max:191'],
            'is_provider' => ['nullable', 'boolean', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'state_id' => ['required', 'numeric',],
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
        $data=$this->validate($request,[
            'name' => ['required', 'string', 'max:191'],
            'phone' => ['required', 'string', 'max:191'],
            'is_provider' => ['nullable', 'boolean', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users,email,'.$id],
            'address' => ['nullable', 'string'],
            'state_id' => ['required', 'numeric',],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'is_company' => ['nullable', 'boolean', 'max:191'],
            'c_name' => ['required_if:is_company,1','max:191'],
            'lisence_number' => ['required_if:is_company,1','max:191'],
        ]);

        if($request->password){
            $data['password']=bcrypt($request->password);
        }
        if($request->avatar){
            $relativePath=uploadImage($request->avatar);
            $data['avatar']=$relativePath;
        }
        if($request->lisence_document){
            $relativePath=uploadImage($request->lisence_document);
            $data['lisence_document']=$relativePath;
        }
        $data['admin_id']=admin()->id;
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
       
            if(admin()->type=='admin'){
            return User::where(function($q)use ($query){
                $q->where('is_provider','1')->where('name','like','%'.$query.'%');
            })
            ->orWhere(function($q)use ($query){
                $q->where('is_provider','1')->where("email",'like','%'.$query.'%');
            })
            ->orWhere(function($q)use ($query){
                $q->where('is_provider','1')->where("phone",'like','%'.$query.'%');
            })->paginate(40);
            
        }else{
            return User::where(function($q)use ($query){
                $q->where('admin_id',admin()->id)->where('is_provider','1')->where('name','like','%'.$query.'%');
            })
            ->orWhere(function($q)use ($query){
                $q->where('admin_id',admin()->id)->where('is_provider','1')->where("email",'like','%'.$query.'%');
            })
            ->orWhere(function($q)use ($query){
                $q->where('admin_id',admin()->id)->where('is_provider','1')->where("phone",'like','%'.$query.'%');
            })->paginate(40);
        }
    }
}
