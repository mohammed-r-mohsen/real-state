<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgetPassword;
use App\Mail\VerifyEmail;
use Str;
use Carbon\Carbon;
use Arr;

class AuthController extends Controller
{
    public function register(Request $request){
        $data=$this->validate($request, [
            'name' => ['required', 'string', 'max:191'],
            'is_provider' => ['nullable', 'boolean', 'max:191'],
            'phone_code' => ['required', 'string'],
            'state_id' => ['required', 'numeric'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'phone' => ['required', 'numeric','digits_between:1,40', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $data['password']=Hash::make($request->password);
        $user=User::create($data);
        
         return $user;
    }
    public function send_verification_link(Request $request){
        $user=User::where('email',$request->email)->first();
        if(!$user){
            return response()->json([
                'message'=>trans('lang.no_user'),
                'status_code'=>500
            ],500);
        }
            $random=rand(111111,999999);
        if(Carbon::now()->diffInMinutes($user->time_token) > 60){
                $user->update([
                    'time_verified'=>0
                ]);
            }
            if($user->time_verified >=3){
                return response()->json([
                'message'=>trans('lang.max_attempt'),
                'status_code'=>500
            ],500);
            }else{
                $user->update([
                    'email_verification_code'=>$random,
                    'time_token'=>Carbon::now(),
                    'time_verified'=>$user->time_verified+1
                ]);
                // return $user->name;
                Mail::to($user->email)->send(new VerifyEmail($user));
                return $user;
            
            
        }
        
        
    }

    public function check_email_verification_code(Request $request){
        $user=User::where('email',$request->email)->first();
        if(!$user){
            return response()->json([
                'message'=>trans('lang.no_user'),
                'status_code'=>500
            ],500);
        }
        $code=$request->verification_code;
        if(Carbon::now()->diffInMinutes($user->time_token) > 5){
            return response()->json([
                'message'=>trans('lang.this_code_is_exipred'),
                'status_code'=>500
            ],500);
        }else{
        if($user->email_verification_code==$code && $code!=null){
            $user->update([
                'email_verified_at'=>Carbon::today(),
                'email_verification_code'=>null
            ]);
        }else{
            return response()->json([
                'message'=>'This code is invalid',
                'status_code'=>500
            ],500);
        }
        }
        return $user->email_verified_at;
    }
    public function verify_email($user_id,$code){
        $user=User::findOrFail($user_id);
      
        if($user->email_verification_code==$code && $code!=null && Carbon::now()->diffInMinutes($user->time_token) < 5){
            $user->update([
                'email_verified_at'=>Carbon::today(),
                'email_verification_code'=>null
            ]);
        }
        return redirect('verify_email');
    }
    public function login(Request $request){
        $request->validate([
        'email' => 'required',
        'password' => 'required',
        'device_name' => 'required',
    ]);
    $users=User::latest()->get();
    $user='';
     foreach ($users as $key => $value) {
        $m=$value['phone_code'].$value['phone'];
        if(Str::endswith($m,$request->email) || $request->email==$value['email']){
            $user= User::find($value['id']);
        }
     }
    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
    if($user->email_verified_at==null){
        $random=rand(111111,999999);
        $user->update([
            'email_verification_code'=>$random,
            'time_token'=>Carbon::now(),
        ]);
        Mail::to($user->email)->send(new VerifyEmail($user));
        
    }
    $token=$user->createToken($request->device_name)->plainTextToken;
    $user['token']=$token;
     return $user;
         
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return 'ok';
    }

    public function update_my_password(Request $request){
        $user=$request->user();
        if(Hash::check($request->old_password, $user->password)){
            $this->validate($request,[
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $user->update([
                'password'=>Hash::make($request->password)
            ]);
        }else{
            return response()->json([
                'error'=>'Your enter invalid old password. try again !'
            ]);
        }

    }

    public function update(Request $request){
        $user=Auth::user();
        $data=$this->validate($request,[
            'name' => ['required', 'string', 'max:191'],
            'phone' => ['required', 'string', 'max:191'],
            'whatsapp' => ['required', 'string', 'max:191'],
            'state_id' => ['required', 'numeric'],
            'city_id' => ['required', 'numeric'],
            'address' => ['required', 'string','max:191'],
            'is_provider' => ['nullable', 'boolean', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users,email,'.$user->id],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'is_company' => ['nullable', 'boolean', 'max:191'],
            'c_name' => ['required_if:is_company,1','max:191'],
            'lisence_number' => ['required_if:is_company,1','max:191'],
        ]);
        if($request->password){
            $data['password']=bcrypt($request->password);
        }
        if($request->avatar){
            $relativePath=uploadImage($request->avatar);
            $data['avatar']=$relativePath;
        }
        if($request->lisence_document){
            $relativePath=uploadImage($request->lisence_document);
            $data['lisence_document']=$relativePath;
        }
        $user->update($data);
        return $user;
    }
    public function forget_password(Request $request){
        $this->validate($request,[
            'email'=>'required|email|max:191'
        ]);
        $user=User::where('email',$request->email)->first();
        if($user){
            if(Carbon::now()->diffInMinutes($user->time_token) > 60){
                $user->update([
                    'time_verified'=>0
                ]);
            }
            if($user->time_verified >=3){
                return response()->json([
                'message'=>trans('lang.max_attempt'),
                'status_code'=>500
            ],500);
            }else{
                $random=rand(111111,999999);
            $user->update([
                'verification_code'=>$random,
                'time_token'=>Carbon::now(),
                'time_verified'=>$user->time_verified+=1
            ]);
            Mail::to($user->email)->send(new ForgetPassword($user));
            }
            
        }else{
            return response()->json([
                'message'=>trans('lang.no_user'),
                'status_code'=>500
            ],500);
        }
    }

    public function verify_code(Request $request){
        $this->validate($request,[
            'verification_code'=>'required|max:6',
            'email'=>'required|email'
        ]);
        $user=User::where('email',$request->email)->first();
        if(Carbon::now()->diffInMinutes($user->time_token) > 5){
            return response()->json([
                'message'=>trans('lang.this_code_is_exipred'),
                'status_code'=>500
            ],500);
        }else{
            if($user->verification_code==$request->verification_code){
                return 'verified';
            }else{
                return response()->json([
                    'message'=>trans('lang.invalid_code'),
                    'status_code'=>500
                ],500);
            }
        }
       

    }
    public function change_password(Request $request){
        $data=$this->validate($request,[
            'email'=>'required|email',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user=User::where('email',$request->email)->first();
        // return response()->json([
        //             'message'=>Hash::check($request->password, $user->password),
        //             'status_code'=>500
        //         ],500);
        $data['password']=Hash::make($request->password);
        if($user){
             $user->update($data);
             
            return 'ok';
        }else{
            return response()->json([
                    'message'=>trans('lang.no_user_found'),
                    'status_code'=>500
                ],500);
        }

    }

}
