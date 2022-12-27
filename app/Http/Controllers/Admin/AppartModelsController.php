<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AppartModel;

class AppartModelsController extends Controller
{
    public function home()
    {
        return view('admin.appart_models',['pageTitle'=>'Pages','pageSubTitle'=>'Appartments models']);
    }
    public function index()
    {
        $items=AppartModel::latest()->paginate(40);

        return $items;
    }
    public function get_appart_models()
    {
        $items=AppartModel::latest()->get();

        return $items;
    }

    
  
    public function store(Request $request)
    {
        $data=$this->validate($request,[
            'name' => ['required', 'string', 'max:191'],
            
        ]);
        
       
        $item=AppartModel::create($data);
        return $item;
    }

   
    public function update(Request $request, $id)
    {
        $item=AppartModel::find($id);
        $data=$this->validate($request,[
             'name' => ['required', 'string', 'max:191'],
            
        ]);
    
        
        $item->update($data);
        return 'success';
    }

  
    public function destroy($id)
    {
        $item=AppartModel::find($id);

        $item->delete();
        return 'success';
    }

    public function search($query){
         return AppartModel::where('name','like','%'.$query.'%')
            ->latest()->paginate(40);
    }


}
