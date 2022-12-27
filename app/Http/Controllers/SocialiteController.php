<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Str;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
   public function redirectToProvider()
    {
        return Socialite::driver('google')->stateless()->redirect()->getTargetUrl();
    }
   

    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();
        if(!$user->token){
            dd('faild');
        }
        $appuser=User::whereEmail($user->email)->first();
        if(!$appuser){
            //create app user
            $appuser=User::create([
                'name'=>$user->name,
                'email'=>$user->email,
                'password'=>Str::random(8),
                'phone_code'=>'+90',
                'email_verified_at'=>Carbon::today(),
            ]);
        }
        $token=$appuser->createToken('google-login')->plainTextToken;
        return $token;
        dd($user);
        // $user->token;
    }
    public function redirectToFacebookProvider()
    {
        return Socialite::driver('facebook')->stateless()->redirect()->getTargetUrl();
    }
    public function handleFacebookProviderCallback()
    {
        $user = Socialite::driver('facebook')->stateless()->user();

        if(!$user->token){
            dd('faild');
        }
        $appuser=User::whereEmail($user->email)->first();
        if(!$appuser){
            //create app user
            $appuser=User::create([
                'name'=>$user->name,
                'email'=>$user->email,
                'password'=>Str::random(8),
                'phone_code'=>'+90',
                'email_verified_at'=>Carbon::today(),
            ]);
        }
        $token=$appuser->createToken('facebook-login')->plainTextToken;
        return $token;
        dd($user);
        // $user->token;
    }
}
