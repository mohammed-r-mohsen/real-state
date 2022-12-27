<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Page;
class SettingsController extends Controller
{
    public function pages_home(){
         return view('admin.pages',['pageTitle'=>'Pages','pageSubTitle'=>'Pages Content']);
    }

    public function update_pages(Request $request){
        $data=$this->validate($request,[
            'terms'=>'required|max:1000',
            'privacy'=>'required|max:1000',
            'banner'=>'required|max:1000',
            'about_title'=>'required|max:1000',
            'about_desc'=>'required|max:1000',
        ]);
        $page=Page::first();
        if($page){
            $page->update($data);
        }
        return 'ok';
    }

    public function settings(){
        return view('admin.settings',['pageTitle'=>'Pages','pageSubTitle'=>'Settings']);
    }

    public function update_settings(Request $request){
        $data=$this->validate($request,[
            'site_name'=>'required|string|max:191',
            'email'=>'required|string|max:191',
            'phone'=>'required|string|max:191',
            'whatsapp'=>'required|string|max:191',
            'address'=>'required|string|max:191',
            // 'status'=>'required|string|max:191',
        ]);
        if($request->site_logo){
            $relativePath=uploadImage($request->site_logo);
            $data['site_logo']=$relativePath;
        }
        settings()->update($data);

        return 'ok';

    }

}
