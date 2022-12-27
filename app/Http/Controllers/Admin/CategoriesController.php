<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoriesController extends Controller
{
  
    public function home()
    {
        return view('admin.categories',['pageTitle'=>'Pages','pageSubTitle'=>'Categories']);
    }
    public function index()
    {
        $categories=admin_categories(40);

        return $categories;
    }
    public function get_categories()
    {
        $categories=Category::latest()->get();

        return $categories;
    }

    
  
    public function store(Request $request)
    {
        $data=$this->validate($request,[
            'name' => ['required', 'max:1000'],
            'image' => ['required', 'string' ],
        ]);
        // 
       if($request->image){
            $relativePath=uploadImage($request->image);
            $data['image']=$relativePath;
        }
        $cat=Category::create($data);
        return $cat;
    }

   
    public function update(Request $request, $id)
    {
        $cat=Category::find($id);
        $data=$this->validate($request,[
            'name' => ['required', 'max:1000'],
        ]);
        // 
    
        if($request->image){
            $relativePath=uploadImage($request->image);
            $data['image']=$relativePath;
        }
        $cat->update($data);
        return 'success';
    }

  
    public function destroy($id)
    {
        $cat=Category::find($id);

        $cat->delete();
        return 'success';
    }

    public function search($query){
         $categories= Category::where('name','like','%'.serialize($query).'%')
            ->latest()->paginate(40);
    }


}
