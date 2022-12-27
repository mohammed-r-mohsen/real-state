<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Neighbor;

class NeighborsController extends Controller
{
  
    public function home()
    {
        return view('admin.neighbors',['pageTitle'=>'Pages','pageSubTitle'=>'neighbors']);
    }
    public function index()
    {
        $items=admin_neighbors(140);

        return $items;
    }
    
    public function get_neighbors($id=null)
    {
        $neighbors=admin_neighbors(null,$id);

        return $neighbors;
    }
  
    public function store(Request $request)
    {
        $data=$this->validate($request,[
            'name' => ['required', 'max:1000',],
            'region_id' => ['required', 'numeric', ],
            
        ]);
        
        Neighbor::create($data);
        return 'ok';
    }

   
    public function update(Request $request, $id)
    {
        $item=Neighbor::find($id);
        $data=$this->validate($request,[
             'name' => ['required', 'max:1000'],
             'region_id' => ['required', 'numeric', ],
            
        ]);
    
        
        $item->update($data);
        return 'success';
    }

  
    public function destroy($id)
    {
        $item=Neighbor::find($id);

        $item->delete();
        return 'success';
    }

    public function filter(Request $request){
         $neighbors=Neighbor::with('region');
         
         if($request->region_id){
            $neighbors->where('region_id',$request->region_id);
         }
         $neighbors= $neighbors->latest()->paginate(140);
        foreach ($neighbors as $key => $value) {
                
                $value['lang_name']=$value->item;
                $region=$value->region;
                $region['lang_name']=$region->item;
                $value['region']=$region;
                $value['custom_name']=$value['lang_name'].'('.$region['lang_name'].')';
        }

         return $neighbors;
    }
    public function add_neighbor(Request $request){
        $name=[
            'en'=>$request['name_tr'],
            'tr'=>$request['name_tr'],
            'ar'=>$request['name_tr'],
        ];
        Neighbor::create([
            'id'=>$request['id'],
            'name'=>json_encode($name),
            'region_id'=>$request['region_id'],
        ]);

        return 'ok';
    }
}
