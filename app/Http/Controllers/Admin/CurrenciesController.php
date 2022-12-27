<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Currency;

class CurrenciesController extends Controller
{
  
    public function home()
    {
        return view('admin.currencies',['pageTitle'=>'Pages','pageSubTitle'=>'Currencies']);
    }
    public function index()
    {
        $items=admin_currencies(40);

        return $items;
    }
    public function get_currencies()
    {
        $items=admin_currencies();

        return $items;
    }

    
  
    public function store(Request $request)
    {
        $data=$this->validate($request,[
            'name' => ['required','max:1000'],
            'sympol' => ['required', 'string', 'max:191'],
            
        ]);
        
       
        $item=Currency::create($data);
        return $item;
    }

   
    public function update(Request $request, $id)
    {
        $item=Currency::find($id);
        $data=$this->validate($request,[
             'name' => ['required','max:1000'],
             'sympol' => ['required', 'string', 'max:191'],
            
        ]);
         
        $item->update($data);
        return 'success';
    }

  
    public function destroy($id)
    {
        $item=Currency::find($id);

        $item->delete();
        return 'success';
    }

    public function search($query){
         return Currency::where('name_en','like','%'.$query.'%')
            ->orWhere('sympol','like','%'.$query.'%')
            ->latest()->paginate(40);
    }


}
