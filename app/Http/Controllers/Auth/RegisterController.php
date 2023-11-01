<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Cp\Membership\Models\ProfileParameter;
use Cp\Membership\Models\UserProfile;
use Cp\Membership\Models\UserSearchTerm;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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


    public function showRegistrationForm()
    {
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


        // $user->welcomeEmailSend();

        // $admins = User::whereHas('roles', function ($q) {
        //     $q->where('name', 'admin');
        // })->where('active', 1)->get();

        // foreach ($admins as $admin) {
        //     $admin->welcomeNewUserToAdmin($user);
        // }

        return $user;
    }

   
}