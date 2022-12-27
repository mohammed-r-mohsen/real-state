<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Mail\UserResetPassword;
use App\Mail\UserActivateAccount;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Validator;
use App\Models\UsersDetail;
use App\Models\SmsHistory;
use App\Mail\UserRegisterAccount;
use App\Mail\UserResendActiviationCode;
use App\Models\Api\User as ApiUser;
use App\Models\Role;
use App\Models\TrainingOrder;
use App\User;
use Vzool\Malath\Malath_SMS;
use Illuminate\Support\Facades\Mail;
use App\Mail\AuthMail;
class UserController extends Controller
{
    public $successStatus = 200;
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){
        
        if(is_numeric(request('phone_email'))){
            if(Auth::attempt(['phone' => request('phone_email'), 'password' => request('password')])){
                $user_id = Auth::id();
                $this->select_state=['id','name_en'];
                $this->select_city=['id','name_en'];
                if (request()->header('lang') == 'ar') {
                    $this->select_state=['id','name_ar'];
                    $this->select_city=['id','name_ar'];
                }elseif (request()->header('lang') == 'en') {
                    $this->select_state=['id','name_en'];
                    $this->select_city=['id','name_en'];
                }elseif (request()->header('lang') == 'tr') {
                    $this->select_state=['id','name_tr'];
                    $this->select_city=['id','name_tr'];
                }
                $user = ApiUser::with(['state'=>function($q){
                    $q->select($this->select_state);
                },'city'=>function($query){
                    $query->select($this->select_city);
                }])->select('id','name','phone','email','avatar','whatsapp','address','is_provider','is_company','c_name','lisence_number','lisence_document','state_id','city_id')->find($user_id);
                $data['user']=$user;
                if($user->avatar == null){
                    $data['user']['avatar']='https://no-comission.com/assets2/images/user-icon.jpg';
                }else{
                    $data['user']['avatar']='https://no-comission.com'.$user->avatar;
                }
                $data['token'] =  $user->createToken('real-estate')->accessToken;

                $data_json['status']=true;
                $data_json['message']='';
                $data_json['data']=$data;
                return response()->json($data_json, $this->successStatus);
            }else{
                $message='Bu veriler bende yok kayıtlarımız';
                if (request()->header('lang') == 'ar') {
                   $message='هذه البيانات ليست لدي سجلاتنا';
                }elseif (request()->header('lang') == 'en') {
                    $message='This data I do not have our records';
                }elseif (request()->header('lang') == 'tr') {
                    $message='Bu veriler bende yok kayıtlarımız';
                }
                $data_json['status']=false;
                $data_json['message']=$message;
                $data_json['data']=null;
                return response()->json($data_json, $this->successStatus);
            }
        }else{
            if(Auth::attempt(['email' => request('phone_email'), 'password' => request('password')])){
                $user_id = Auth::id();
                $this->select_state=['id','name_en'];
                $this->select_city=['id','name_en'];
                if (request()->header('lang') == 'ar') {
                    $this->select_state=['id','name_ar'];
                    $this->select_city=['id','name_ar'];
                }elseif (request()->header('lang') == 'en') {
                    $this->select_state=['id','name_en'];
                    $this->select_city=['id','name_en'];
                }elseif (request()->header('lang') == 'tr') {
                    $this->select_state=['id','name_tr'];
                    $this->select_city=['id','name_tr'];
                }
                $user = ApiUser::with(['state'=>function($q){
                    $q->select($this->select_state);
                },'city'=>function($query){
                    $query->select($this->select_city);
                }])->select('id','name','phone','email','avatar','whatsapp','address','is_provider','is_company','c_name','lisence_number','lisence_document','state_id','city_id')
                  ->find($user_id);
                $data['user']=$user;
                if($user->avatar == null){
                    $data['user']['avatar']='https://no-comission.com/assets2/images/user-icon.jpg';
                }else{
                    $data['user']['avatar']='https://no-comission.com'.$user->avatar;
                }
                $data['token'] =  $user->createToken('real-estate')->accessToken;

                $data_json['status']=true;
                $data_json['message']='';
                $data_json['data']=$data;
                return response()->json($data_json, $this->successStatus);
            }else{
                $message='Bu veriler bende yok kayıtlarımız';
                if (request()->header('lang') == 'ar') {
                   $message='هذه البيانات ليست لدي سجلاتنا';
                }elseif (request()->header('lang') == 'en') {
                    $message='This data I do not have our records';
                }elseif (request()->header('lang') == 'tr') {
                    $message='Bu veriler bende yok kayıtlarımız';
                }
                $data_json['status']=false;
                $data_json['message']=$message;
                $data_json['data']=null;
                return response()->json($data_json, $this->successStatus);
            }
        }
    }

    public function show($id=0)
    {
        $user_id = Auth::id();
        $this->select_state=['id','name_en'];
        $this->select_city=['id','name_en'];
        if (request('lang') == 'ar') {
            $this->select_state=['id','name_ar'];
            $this->select_city=['id','name_ar'];
        }elseif (request('lang') == 'en') {
            $this->select_state=['id','name_en'];
            $this->select_city=['id','name_en'];
        }elseif (request('lang') == 'tr') {
            $this->select_state=['id','name_tr'];
            $this->select_city=['id','name_tr'];
        }
        $user=ApiUser::with(['state'=>function($q){
            $q->select($this->select_state);
        },'city'=>function($query){
            $query->select($this->select_city);
        }])->select('id','name','phone','email','avatar','whatsapp','address','is_provider','state_id','city_id')->find($user_id);
      
        if(is_null($user) == 1)
        {
            $data['result']=false;
            $data['error_message']='عفوا لا يوجد مستخدم بهذه البيانات';
            $data['error_message_en']='Sorry , Wrong data ';
            $data['data']=[];
            return response()->json($data, 200);
        }

        // $user['mem_type']=['ar'=>$user->role->name,'en'=>$user->role->name_en ];

        $data['result']=true;
        $data['error_message']='';
        $data['error_message_en']='';
        $data['data']=$user;//->only(['id', 'name', 'mobile', 'email','is_confirmed','facility_name','address','commercial_num_file','latitude','longitude']);
        return response()->json($data, $this->successStatus);
    }

    //reset password
    public function reset_pass(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email'=>'required',
         ]);
         if ($validator->fails())
         {
            // $message = $validator->errors()->first();
            $this->message='الايميل مطلوب';
            if (request()->header('lang') == 'ar') {
                $this->message='الايميل مطلوب';
            }elseif (request()->header('lang') == 'en') {
                $this->message='The email field is required.';
            }elseif (request()->header('lang') == 'tr') {
                $this->message='E-posta alanı zorunludur.';
            }
            $data_json['status']=false;
            $data_json['message']=$this->message;
            return response()->json($data_json, 200);
         }
        // ApiUser::find($user_id);
        $chk_user= ApiUser::where(['email'=>$request->email])->first();
        if(is_null($chk_user))
        {
            if (request()->header('lang') == 'ar') {
                $this->message_chk='لا يوجد بيانات لهذا المستخدم';
            }elseif (request()->header('lang') == 'en') {
                $this->message_chk='There is no data for this user';
            }elseif (request()->header('lang') == 'tr') {
                $this->message_chk='Bu kullanıcı için veri yok';
            }
            $data['status']=false;
            $data['message']=$this->message_chk;
            //$data['data']=array();
            return response()->json($data, $this->successStatus);
        }
        else
        {
            $varifaid_symbol=rand(111111,999999);
            $data_upd= ApiUser::find($chk_user->id);
            $data_upd->verification_code=$varifaid_symbol;
            $upd =$data_upd->save();
            if( $upd == true)
            {
                Mail::to($data_upd->email)->send(new AuthMail($data_upd));
                if (request()->header('lang') == 'ar') {
                    $this->message_email='تم ارسال كود التحقق الي البريد الالكتروني بنجاح ';
                }elseif (request()->header('lang') == 'en') {
                    $this->message_email='succefully Validation code send to gmail';
                }elseif (request()->header('lang') == 'tr') {
                    $this->message_email="gmail'e başarıyla gönderilen doğrulama kodu";
                }
                $data['status']=true;
                $data['message']=$this->message_email;
                $data['data']=null;
                return response()->json($data, $this->successStatus);
            }
            else
            {
                if (request()->header('lang') == 'ar') {
                    $this->message_not_fond='لا يوجد بيانات';
                }elseif (request()->header('lang') == 'en') {
                    $this->message_not_fond='not found data';
                }elseif (request()->header('lang') == 'tr') {
                    $this->message_not_fond='veri bulunamadı';
                }
                $data['status']=false;
                $data['message']=$this->message_not_fond;
                return response()->json($data, $this-> successStatus);
            }
        }
    }
    public function verification(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email'=>'required',
            'verification_code'=>'required',
         ]);

         if ($validator->fails())
         {
            $message = $validator->errors()->first();
            $data_json['result']=false;
            $data_json['error_message']=$message;
            $data_json['error_message_en']=$message;
            return response()->json($data_json, 200);
         }

         $data_upd= ApiUser::where('email',$request->email)->first();
         if($data_upd != null){

           if( $data_upd->verification_code == $request->verification_code){
                $data_json['result']=true;
                $data_json['error_message']='تم التحقيق';
                $data_json['error_message_en']='verified';
                return response()->json($data_json, 200);
           }else{
                $data_json['result']=false;
                $data_json['error_message']=' عفوا رمز التحقيق غير صحيح';
                $data_json['error_message_en']='Sorry, the verification code is incorrect';
                return response()->json($data_json, 200);
           }
         }else{
            $data_json['result']=false;
            $data_json['error_message']='هذا الايميل غير مسجل';
            $data_json['error_message_en']='this email not registration';
            return response()->json($data_json, 200);
         }
    }

    public function register(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|string|email|max:191|unique:users',
            'phone' => 'required|string|max:25|unique:users',
            'password' => 'required|required_with:c_password|same:c_password|min:6',
            'c_password' => 'min:6'
        ]);
        if ($validator->fails()) {
            $errors=$validator->errors();
            $error_mg='';
            foreach ($errors->all() as $error) {
                $error_mg.=$error.' . ';
            }
            $data_json['result']=false;
            $data_json['error_message']=$error_mg;
            $data_json['error_message_en']=$error_mg;
            return response()->json($data_json, 200);
        }
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = ApiUser::create($input);
        $success['token'] =  $user->createToken('real-estate')->accessToken;
        $data['id']=$user->id;
        $data['name']=$user->name;
        //$data['l_name']=$user->l_name;
        $data['email']=$user->email;
        $data['phone']=$user->phone;
        if ($request->hasFile('avatar') ) {
            $relativePath=uploadImage($request->avatar);
            $data['avatar']=$relativePath;
        }

        //end send mail
        $data_json['result']=true;
        $data_json['error_message']="تم التسجيل بنجاح";
        $data_json['error_message_en']="register successfully";
        $data_json['success']=$success;
        $data_json['data']=$data;
        return response()->json($data_json, $this->successStatus);
        //return response()->json(['success'=>$success, 'data'=> $data], );
    }
    public function update(Request $request, $id)
    {
        //dd($request);
        $user_id=Auth::id();
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'email' =>  ['required', 'string', 'email', 'max:191', 'unique:users,email,'.$user_id],
            'phone' => 'required|string|max:30',
        ]);
        if ($validator->fails()) {
            $errors=$validator->errors();
            $error_mg='';
            foreach ($errors->all() as $error) {
                $error_mg.=$error.' . ';
            }
            $data_json['result']=false;
            $data_json['error_message']=$error_mg;
            $data_json['error_message_en']=$error_mg;
            return response()->json($data_json, 200);
        }
        $json_dt=array();

        $chk_email_exist=ApiUser::select('email')->where(['email'=>$request->email,['id','!=',$user_id]])->first();
        if(is_null($chk_email_exist)==0)
        {
            $data['result']=false;
            $data['error_message']='عفوا الايميل  مسجل من قبل';
            $data['error_message_en']='Sorry , Email was exist';
            $data['data']=array();
            return response()->json($data, $this-> successStatus);
        }
        $data_upd= ApiUser::find($user_id);
        $data_upd->name=$request->name;
        $data_upd->email=$request->email;
        $data_upd->phone=$request->phone;
        $data_upd->whatsapp=$request->whatsapp;
        $data_upd->address=$request->address;
        $data_upd->city_id=$request->city_id;
        if ($request->hasFile('avatar') ) {
            $relativePath=uploadImage($request->avatar);
            $data['avatar']=$relativePath;
        }

        $user_up=$data_upd->save();
        if( $user_up == true)
        {
            $json_dt['id']=$user_id;
            $json_dt['name']=$data_upd->name;
            $json_dt['email']=$data_upd->email;
            $json_dt['phone']=$data_upd->phone;
            $json_dt['address']=$data_upd->address;
            $json_dt['city_id']=$data_upd->city_id;
            $json_dt['whatsapp']=$data_upd->whatsapp;
            $json_dt['avatar']=$data_upd->avatar;
            $data['result']=true;
            $data['error_message']='تم التعديل بنجاح';
            $data['error_message_en']='succefully updated';
            $data['data']=$json_dt;
            return response()->json($data, $this-> successStatus);
        }
        else
        {
            $data['result']=false;
            $data['error_message']='لايوجد بيانات';
            $data['error_message_en']='No Results';
            $data['data']=array();
            return response()->json($data, $this-> successStatus);
        }
    }
    public function change_password(Request $request)
    {
        if(!Hash::check($request->old_password, auth()->user()->password))
        {
            $data['result']=false;
            $data['error_message']='الرقم السري القديم غير صحيح';
            $data['error_message_en']='The old password is incorrect';
            //$data['data']=array();
            return response()->json($data, $this-> successStatus);
        }
        else
        {
            $validator = \Validator::make($request->all(), [
                'new_password' => 'min:8|same:c_password',
                'c_password' => 'required|min:6'
            ]);
            if ($validator->fails()) {
                $errors=$validator->errors();
                $error_mg='';
                foreach ($errors->all() as $error) {
                    $error_mg.=$error.' . ';
                }
                $data_json['result']=false;
                $data_json['error_message']=$error_mg;
                $data_json['error_message_en']=$error_mg;
                return response()->json($data_json, 200);
            }
            $data_upd= ApiUser::find(auth()->user()->id);
            $success['token'] =$new_token=  $data_upd->createToken('sureFanni')->accessToken;
            $data_upd['password'] = Hash::make($request->new_password);
            $upd =$data_upd->save();
            if( $upd == true)
            {
                $data_user['token']=$new_token;
                $data['result']=true;
                $data['error_message']='تم التعديل بنجاح';
                $data['error_message_en']='edit succefully';
                $data['data']=$data_user;
                return response()->json($data, $this->successStatus);
            }
            else
            {
                $data['result']=false;
                $data['error_message']='لايوجد بيانات';
                $data['error_message_en']='No Results';
               // $data['data']=array();
                return response()->json($data, $this-> successStatus);
            }
        }
    }
    public function new_password(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email',
            'new_password' => 'min:8|same:c_new_password',
        ]);
        if ($validator->fails()) {
            $errors=$validator->errors();
            $error_mg='';
            foreach ($errors->all() as $error) {
                $error_mg.=$error.' . ';
            }
            $data_json['result']=false;
            $data_json['error_message']=$error_mg;
            $data_json['error_message_en']=$error_mg;
            return response()->json($data_json, 200);
        }
        $data_upd= ApiUser::whereEmail($request->email)->first();
        $success['token'] =$new_token=  $data_upd->createToken('sureFanni')->accessToken;
        $data_upd['password'] = Hash::make($request->new_password);
        $upd =$data_upd->save();
        if( $upd == true)
        {
            $data_user['token']=$new_token;
            $data['result']=true;
            $data['error_message']='تم التعديل بنجاح';
            $data['error_message_en']='edit succefully';
            $data['data']=$data_user;
            return response()->json($data, $this->successStatus);
        }
        else
        {
            $data['result']=false;
            $data['error_message']='لايوجد بيانات';
            $data['error_message_en']='No Results';
            // $data['data']=array();
            return response()->json($data, $this-> successStatus);
        }
    }
}
