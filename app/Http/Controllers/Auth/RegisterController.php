<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\RegisterMobile;
use Cp\Membership\Models\ProfileParameter;
use Cp\Membership\Models\UserProfile;
use Cp\Membership\Models\UserSearchTerm;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function showRegistrationForm(Request $request)
    {
        $cookie = $request->cookie('usermobile');
        if($cookie)
        {
            return redirect()->route('registerstep2');            
        }
        
        $professions = ProfileParameter::where('field_name', 'profession')->where('active', 1)->select('field_value', 'gender')->get();
        return view('auth.register', compact('professions'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $data['mobile'] = $data['valid_mobile'];

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'mobile' => ['required', 'string',  'max:20', 'unique:users'],
            'gender' => ['required', 'string'],
            'profession' => ['required', 'string'],
            'day' => 'required',
            'month' => 'required',
            'year' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
     

        $data['mobile'] = $data['valid_mobile'];

        $dob = $data['year'] . '-' . $data['month'] . '-' . $data['day'];
        
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'gender' => $data['gender'],
            'profession' => $data['profession'],
            'dob' =>  Date($dob),
            'password' => Hash::make($data['password']),
            // 'password_temp' => $data['password'],
        ]);

        $profile = new UserProfile();
        $profile->user_id = $user->id;
        $profile->gender = $user->gender;
        $profile->dob = $user->dob;
        $profile->profession = $user->profession;
        $profile->save();

        $us = new UserSearchTerm();
        $us->user_id = $user->id;
        $us->save();

        $rm = RegisterMobile::where('mobile', $user->mobile)->first();
        if($rm)
        {
            $rm->user_id = $user->id;
            $rm->save();
        }

        cookie()->queue(cookie()->forget('usermobile'));


        $user->welcomeEmailSend();

        $admins = User::whereHas('roles', function ($q) {
            $q->where('name', 'admin');
        })->where('active', 1)->get();

        foreach ($admins as $admin) {
            $admin->welcomeNewUserToAdmin($user);
        }

        return $user;
    }


    

    public function registerstep2(Request $request){

        $cookie = $request->cookie('usermobile');
        if(!$cookie)
        {
            return redirect()->route('register');            
        }
            
        $professions = ProfileParameter::where('field_name', 'profession')->where('active', 1)->select('field_value', 'gender')->get();
        return view('auth.registerstep2', compact('professions'));
    }


    public function unsaveMobile(){
        cookie()->queue(cookie()->forget('usermobile'));
        return redirect()->route('register');
    }




    public function registerstep1(Request $request)
    {
         

        // return Validator::make($request->all(), [
        //     'valid_mobile' => ['required', 'string',  'max:20', 'unique:users'],
 
        // ]);

       $user =  User::where('mobile', $request->valid_mobile)->count();
  
       if(!$user)
        {
            $cookie = $request->cookie('usermobile');
            if($cookie)
            {
 
                return redirect()->route('registerstep2')->cookie($cookie);
                
            }  

            $name = 'usermobile';
            $value = $request->valid_mobile;
            $min = 60 * 24 * 60; //2 month;
            $cookie = cookie($name, $value, $min);


            $registerMobile = RegisterMobile::where('mobile', $request->valid_mobile)
                ->where('user_id', null)
                ->first();
            if($registerMobile)
            {
                $registerMobile->created_at = now();
                $registerMobile->save();

            }
            else
            {
                $registerMobile = new RegisterMobile();
                $registerMobile->mobile = $request->valid_mobile;
                $registerMobile->save();
            }

            return redirect()->route('registerstep2')->cookie($cookie);
             

        }

        toast('This mobile number already used', 'error');
        return redirect()->route('register');
        
    }

   
}