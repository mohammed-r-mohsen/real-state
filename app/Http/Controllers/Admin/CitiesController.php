<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\City;
use App\Region;

class CitiesController extends Controller
{
  
    public function home()
    {
        return view('admin.cities',['pageTitle'=>'Pages','pageSubTitle'=>'states']);
    }
    public function index()
    {
        $cities=admin_cities(240);
        return $cities;
    }
     public function get_cities($id=null)
    {
        $cities=admin_cities(null,$id);

        return $cities;
    }
    public function get_city($id){
        $region=Region::find($id);
        $city=City::find($region->city_id);
        $city['lang_name']=json_decode($city->name)->{session('lang')};
        return $city;
    }
  
    public function store(Request $request)
    {
        $data=$this->validate($request,[
            'name' => ['required','max:1000'],
            'state_id' => ['required', 'numeric', ],
            
        ]);
        
        $city=City::create($data);
        return $city;
    }

   
    public function update(Request $request, $id)
    {
        $city=City::find($id);
        $data=$this->validate($request,[
             'name' => ['required','max:1000'],
             'state_id' => ['required', 'numeric', ],
            
        ]);
        
        $city->update($data);
        return 'success';
    }

  
    public function destroy($id)
    {
        $city=City::find($id);

        $city->delete();
        return 'success';
    }

    public function filter(Request $request){
         $cities=City::with('state');
         
         if($request->state_id){
            $cities->where('state_id',$request->state_id);
         }
          $cities=$cities->latest()->paginate(240);
         foreach ($cities as $key => $value) {
                
                $value['lang_name']=$value->item;
                $state=$value->state;
                $state['lang_name']=$state->item;
                $value['state']=$state;
                $value['custom_name']=$value['lang_name'].'('.$state['lang_name'].')';
        }
          return $cities;
    }

    public function add_city(Request $request){
        // return $request;
        $name=[
            'en'=>$request['name_en'],
            'tr'=>$request['name_tr'],
            'ar'=>$request['name_ar'],
        ];
        City::create([
            'id'=>$request['id'],
            'name'=>json_encode($name),
            'state_id'=>$request['state_id'],
        ]);

        return 'ok';
    }
}
