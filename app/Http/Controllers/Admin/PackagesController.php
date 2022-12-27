<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Package;

class PackagesController extends Controller
{
  
    public function home()
    {
        return view('admin.packages',['pageTitle'=>'Pages','pageSubTitle'=>'Packages']);
    }
  
    public function index()
    {
        $packages=admin_packages(40);

        return $packages;
    }
    public function get_packages($user_id=null)
    {
        $packages=admin_packages(null,$user_id);

        return $packages;
    }
    
  
    public function store(Request $request)
    {
        $data=$this->validate($request,[
            'name' => ['required', 'max:1000'],
            'price' => ['required','max:1000000000'],
            'currency' => ['required','string','max:191'],
            'offer_price' => ['nullable','max:1000000000'],
            'period' => ['required', 'numeric', 'max:191'],
            'ads_number' => ['required', 'numeric', 'max:1000000000'],
            'features' => ['required','max:1000000'],
            'desc' => ['nullable', 'string', 'max:191',],
        ]);
        
        $package=Package::create($data);
        return $package;
    }

   
    public function update(Request $request, $id)
    {
        $package=Package::find($id);
        $data=$this->validate($request,[
            'name' => ['required', 'max:1000'],
            'price' => ['required','max:1000000000'],
            'currency' => ['required','string','max:191'],
            'offer_price' => ['nullable','max:1000000000'],
            'period' => ['required', 'numeric', 'max:1000000000'],
            'ads_number' => ['required', 'numeric', 'max:1000000000'],
            'features' => ['required', 'max:1000000',],
            'desc' => ['nullable', 'string', 'max:191',],
        ]);
    
        $package->update($data);
        return 'success';
    }

  
    public function destroy($id)
    {
        $package=Package::find($id);

        $package->delete();
        return 'success';
    }

    public function search($query){
         return Package::where('name_en','like','%'.$query.'%')
            ->orwhere("price",'like','%'.$query.'%')
            ->orwhere("period",'like','%'.$query.'%')
            ->orwhere("features_en",'like','%'.$query.'%')
            ->latest()->paginate(40);
    }
}
