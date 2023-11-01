<?php

namespace Cp\UserRole\Controllers;

use Hash;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Cp\Membership\Models\UserProfile;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;

class UserRoleController extends Controller
{
    public function dashboard()
    {
        menuSubmenu('dashboard', 'dashboard');
        $user = Auth::user();

        if ($user->profile && $user->profile->religion_id && (($user->profile->submit_by_user == 0))) {
            return redirect()->route('user.newProfileNextStep');
        }

        $data['userProfiles'] = User::whereHas('profile', function ($q) {
            $q->where('checked', 1);
            $q->where('gender', Auth::user()->altGender());
        })->latest()->take(4)->get();

        $data['userVisitors'] = Auth::user()->visitorUsers()->latest()->take(4)->get();
        $data['userVisiteds'] = Auth::user()->visitedUsers()->latest()->take(4)->get();
        $data['userFavourites'] = Auth::user()->favouriteUsers()->latest()->take(4)->get();
        $data['userContacts'] = Auth::user()->contactUsers()->latest()->take(4)->get();


        return view('userrole::user.userDashboard', $data);
    }

    public function userEdit()
    {
        menuSubmenu('userInfo', 'userEdit');
        return view('userrole::user.userEdit');
    }

    public function userUpdate(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'current_password' => ['required', 'string', 'max:255', 'min:4'],
                'new_password' => ['required', 'string', 'min:6', 'confirmed'],
            ]
        );

        if ($validation->fails()) {
            toast('Please, fill-up the information correctly', 'error');
            return back()
                ->withInput()
                ->withErrors($validation);
        }

        $me = Auth::user();

        if (Hash::check($request->current_password, $me->password)) {
            $me->password = Hash::make($request->current_password);
            $me->password_temp = null;
            $me->save();
            toast('Your Password Successfully Updated!', 'success');
            return back();
        } else {
            toast('Your password did not match', 'error');
            return back();
        }
    }
}