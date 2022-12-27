<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Faq;

class FaqsController extends Controller
{
  
    public function home()
    {
        return view('admin.faqs',['pageTitle'=>'Pages','pageSubTitle'=>'faqs']);
    }
    public function index()
    {
        $faqs=admin_faqs(40);

        return $faqs;
    }
    public function get_categories()
    {
        $faqs=admin_faqs();

        return $faqs;
    }

    
  
    public function store(Request $request)
    {
        $data=$this->validate($request,[
            'question' => ['required','max:1000'],
            'answer' => ['required', ],
        ]);
        
        $faq=Faq::create($data);
        return $faq;
    }

   
    public function update(Request $request, $id)
    {
        $faq=Faq::find($id);
        $data=$this->validate($request,[
            'question' => ['required','max:1000'],
            'answer' => ['required', ],
        ]);
        
        $faq->update($data);
        return 'success';
    }

  
    public function destroy($id)
    {
        $faq=Faq::find($id);

        $faq->delete();
        return 'success';
    }

    public function search($query){
         return Faq::where('question_en','like','%'.$query.'%')
            ->latest()->paginate(40);
    }


}
