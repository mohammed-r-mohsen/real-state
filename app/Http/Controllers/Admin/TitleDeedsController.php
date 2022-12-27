<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TitleDeed;

class TitleDeedsController extends Controller
{
  
    public function home()
    {
        return view('admin.title_deeds',['pageTitle'=>'Pages','pageSubTitle'=>trans('lang.title_deeds')]);
    }
    public function index()
    {
        $title_deeds=admin_title_deeds(40);

        return $title_deeds;
    }
    public function get_title_deeds()
    {
        return admin_title_deeds();
    }
    
  
    public function store(Request $request)
    {
        $data=$this->validate($request,[
            'name' => ['required', 'max:1000'],            
        ]);
        
        
       
        $item=TitleDeed::create($data);
        return $item;
    }

   
    public function update(Request $request, $id)
    {
        $item=TitleDeed::find($id);
        $data=$this->validate($request,[
            'name' => ['required', 'max:1000'],            
        ]);
        
    

        $item->update($data);
        return 'success';
    }

  
    public function destroy($id)
    {
        $item=TitleDeed::find($id);

        $item->delete();
        return 'success';
    }

    public function search($query){
         return TitleDeed::where('name_en','like','%'.$query.'%')
            ->latest()->paginate(40);
    }

    
}
