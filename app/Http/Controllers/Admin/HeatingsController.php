<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Heating;

class HeatingsController extends Controller
{
  
    public function home()
    {
        return view('admin.heatings',['pageTitle'=>'Pages','pageSubTitle'=>trans('lang.heatings')]);
    }
    public function index()
    {
        $heatings=admin_heatings(40);

        return $heatings;
    }
    public function get_heatings()
    {
        return admin_heatings();
    }
    
  
    public function store(Request $request)
    {
        $data=$this->validate($request,[
            'name' => ['required', 'max:1000'],            
        ]);
        
       
        $heating=Heating::create($data);
        return $heating;
    }

   
    public function update(Request $request, $id)
    {
        $heating=Heating::find($id);
         $data=$this->validate($request,[
            'name' => ['required', 'max:1000'],            
        ]);
        
    
        $heating->update($data);
        return 'success';
    }

  
    public function destroy($id)
    {
        $heating=Heating::find($id);

        $heating->delete();
        return 'success';
    }

    public function search($query){
         return Heating::where('name_en','like','%'.$query.'%')
            ->latest()->paginate(40);
    }

    
}
