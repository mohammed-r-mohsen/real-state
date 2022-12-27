<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Slider;

class SlidersController extends Controller
{
  
    public function home()
    {
        return view('admin.sliders',['pageTitle'=>'Pages','pageSubTitle'=>'sliders']);
    }
    public function index()
    {
        $sliders=Slider::latest()->paginate(40);

        return $sliders;
    }
    public function get_sliders()
    {
        $sliders=Slider::latest()->get();

        return $sliders;
    }

    
  
    public function store(Request $request)
    {
        $data=$this->validate($request,[
            'slider' => ['required', 'string', ],
            
        ]);
        
       if($request->slider){
            $relativePath=uploadImage($request->slider);
            $data['slider']=$relativePath;
        }
        $slider=Slider::create($data);
        return $slider;
    }

   
    public function update(Request $request, $id)
    {
        $slider=Slider::find($id);
        $data=[];
    
        if($request->slider){
            $relativePath=uploadImage($request->slider);
            $data['slider']=$relativePath;
        }
        $slider->update($data);
        return 'success';
    }

  
    public function destroy($id)
    {
        $slider=Slider::find($id);

        $slider->delete();
        return 'success';
    }

    public function search($query){
         return Slider::where('name_en','like','%'.$query.'%')
            ->latest()->paginate(40);
    }


}
