<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\FloorNumber;

class FloorNumbersController extends Controller
{
  
    public function home()
    {
        return view('admin.floor_numbers',['pageTitle'=>'Pages','pageSubTitle'=>trans('lang.floor_numbers')]);
    }
    public function index()
    {
        $items=admin_floor_numbers(40);

        return $items;
    }
    public function get_floor_numbers()
    {
        $items=admin_floor_numbers();

        return $items;
    }

    
  
    public function store(Request $request)
    {
        $data=$this->validate($request,[
            'name' => ['required', 'max:1000'],            
        ]);
        
        
       
        $item=FloorNumber::create($data);
        return $item;
    }

   
    public function update(Request $request, $id)
    {
        $item=FloorNumber::find($id);
        $data=$this->validate($request,[
            'name' => ['required', 'max:1000'],            
        ]);
        
    
        
        $item->update($data);
        return 'success';
    }

  
    public function destroy($id)
    {
        $item=FloorNumber::find($id);

        $item->delete();
        return 'success';
    }

    public function search($query){
         return FloorNumber::where('name_en','like','%'.$query.'%')
            ->latest()->paginate(40);
    }


}
