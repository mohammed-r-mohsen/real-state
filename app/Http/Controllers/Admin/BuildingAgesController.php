<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BuildingAge;

class BuildingAgesController extends Controller
{
  
    public function home()
    {
        return view('admin.building_ages',['pageTitle'=>'Pages','pageSubTitle'=>trans('lang.building_ages')]);
    }
    public function index()
    {
        $items=BuildingAge::latest()->paginate(40);

        return $items;
    }
    public function get_building_ages()
    {
        $items=BuildingAge::get();

        return $items;
    }

    
  
    public function store(Request $request)
    {
        $data=$this->validate($request,[
            'name' => ['required', 'string','max:191'],

            
        ]);
        
       
        $item=BuildingAge::create($data);
        return $item;
    }

   
    public function update(Request $request, $id)
    {
        $item=BuildingAge::find($id);
        $data=$this->validate($request,[
             'name' => ['required', 'string','max:191'],
 
            
        ]);
    
        
        $item->update($data);
        return 'success';
    }

  
    public function destroy($id)
    {
        $item=BuildingAge::find($id);

        $item->delete();
        return 'success';
    }

    public function search($query){
         return BuildingAge::where('name','like','%'.$query.'%')
            ->latest()->paginate(40);
    }


}
