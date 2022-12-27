<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Region;

class RegionsController extends Controller
{
  
    public function home()
    {
        return view('admin.regions',['pageTitle'=>'Pages','pageSubTitle'=>'regions']);
    }
    public function index()
    {
        $regions=admin_regions(200);

        return $regions;
    }
    public function get_regions($id=null)
    {
        $regions=admin_regions();

        return $regions;
    }
    
  
    public function store(Request $request)
    {
        $data=$this->validate($request,[
            'name' => ['required', 'max:1000',],
            'city_id' => ['required', 'numeric', ],
            
        ]);
        // $names=explode('-',$request->name['tr']);
        
        Region::create($data);
        return 'ok';
    }

   
    public function update(Request $request, $id)
    {
        $region=Region::find($id);
        $data=$this->validate($request,[
             'name' => ['required', 'max:1000',],
             'city_id' => ['required', 'numeric', ],
            
        ]);
        
        $region->update($data);
        return 'success';
    }

  
    public function destroy($id)
    {
        $region=Region::find($id);

        $region->delete();
        return 'success';
    }

    public function filter(Request $request){
         $regions=Region::with('city');
         
         if($request->city_id){
            $regions->where('city_id',$request->city_id);
         }
         $regions= $regions->latest()->paginate(200);
         foreach ($regions as $key => $value) {
                
                $value['lang_name']=$value->item;
                $city=$value->city;
                $city['lang_name']=$city->item;
                $value['city']=$city;
                $value['custom_name']=$value['lang_name'].'('.$city['lang_name'].')';
        }

         return $regions;
    }

    public function add_region(Request $request){
        $name=[
            'en'=>$request['name_tr'],
            'tr'=>$request['name_tr'],
            'ar'=>$request['name_tr'],
        ];
        Region::create([
            'id'=>$request->id,
            'name'=>json_encode($name),
            'city_id'=>$request['city_id'],
        ]);

        return 'ok';
    }
}
