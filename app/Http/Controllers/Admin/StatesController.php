<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\State;

class StatesController extends Controller
{
  
    public function home()
    {
        return view('admin.states',['pageTitle'=>'Pages','pageSubTitle'=>'cities']);
    }
    public function index()
    {
        $states=admin_states(40);

        return $states;
    }
    public function get_states()
    {
        $states=admin_states();

        return $states;
    }
    
  
    public function store(Request $request)
    {
        $data=$this->validate($request,[
            'name' => ['required', 'max:1000'],
            'country_id' => ['required', 'numeric', ], 
        ]);
        
        $state=State::create($data);
        return $state;
    }

   
    public function update(Request $request, $id)
    {
        $state=State::find($id);
        $data=$this->validate($request,[
             'name' => ['required', 'max:1000'], 
             'country_id' => ['required', 'numeric', ], 
        ]);
         

        $state->update($data);
        return 'success';
    }

  
    public function destroy($id)
    {
        $state=State::find($id);

        $state->delete();
        return 'success';
    }

   public function filter(Request $request){
         $states=State::with('country');
         
         if($request->country_id){
            $states->where('country_id',$request->country_id);
         }
          $states=$states->latest()->paginate(40);
         foreach ($states as $key => $value) {
                
                $value['lang_name']=$value->item;
                $country=$value->country;
                $country['lang_name']=$country->item;
                $value['country']=$country;
        }
          return $states;
    }




    public function add_state(Request $request){
        // return $request;
        $name=[
            'en'=>$request['name_en'],
            'tr'=>$request['name_tr'],
            'ar'=>$request['name_ar'],
        ];
        State::create([
            'id'=>$request->id,
            'name'=>json_encode($name),
            'country_id'=>2,
        ]);

        return 'ok';
    }
}
