<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Country;

class CountriesController extends Controller
{
  
    public function home()
    {
        return view('admin.countries',['pageTitle'=>'Pages','pageSubTitle'=>'countries']);
    }
    public function index()
    {
        $countries=admin_countries(40);

        return $countries;
    }
    public function get_countries()
    {
        return admin_countries();
    }
    
  
    public function store(Request $request)
    {
        $data=$this->validate($request,[
            'name' => ['required', 'max:1000'],
            'country_code'=>'required|string|max:191',
            'phone_code'=>'required|string|max:191',
        ]);
        

        $country=Country::create($data);
        return $country;
    }

   
    public function update(Request $request, $id)
    {
        $country=Country::find($id);
        $data=$this->validate($request,[
            'name' => ['required', 'max:1000'],
            'country_code'=>'required|string|max:191',
            'phone_code'=>'required|string|max:191',
        ]);
        
    

        $country->update($data);
        return 'success';
    }

  
    public function destroy($id)
    {
        $country=Country::find($id);

        $country->delete();
        return 'success';
    }

    public function search($query){
         return Country::where('name_en','like','%'.$query.'%')
            ->latest()->paginate(40);
    }

  
}
