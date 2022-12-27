<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\AdsNumber;

class AdsNumbersController extends Controller
{
  
    public function home()
    {
        return view('admin.ads_numbers',['pageTitle'=>'Pages','pageSubTitle'=>'ads_numbers']);
    }
    public function index()
    {
        $items=AdsNumber::latest()->paginate(40);

        return $items;
    }
    public function get_ads_numbers()
    {
        $items=AdsNumber::get();

        return $items;
    }

    
  
    public function store(Request $request)
    {
        $data=$this->validate($request,[
            'ads_number' => ['required', 'numeric'],

            
        ]);
        
       
        $item=AdsNumber::create($data);
        return $item;
    }

   
    public function update(Request $request, $id)
    {
        $item=AdsNumber::find($id);
        $data=$this->validate($request,[
             'ads_number' => ['required', 'numeric'],
 
            
        ]);
    
        
        $item->update($data);
        return 'success';
    }

  
    public function destroy($id)
    {
        $item=AdsNumber::find($id);

        $item->delete();
        return 'success';
    }

    public function search($query){
         return AdsNumber::where('ads_number','like','%'.$query.'%')
            ->latest()->paginate(40);
    }


}
