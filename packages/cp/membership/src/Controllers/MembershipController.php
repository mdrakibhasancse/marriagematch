<?php

namespace Cp\Membership\Controllers;


use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Cp\Membership\Models\Country;
use Cp\Membership\Models\MembershipPackage;
use Cp\Membership\Models\UserVisit;
use Cp\Membership\Models\MembershipPackageOrder;
use Cp\Membership\Models\ProfileCast;
use Cp\Membership\Models\ProfileParameter;
use Cp\Membership\Models\ProfileReligion;
use Cp\Membership\Models\UserContact;
use Cp\Membership\Models\UserCvPicture;
use Cp\Membership\Models\UserEducationRecord;
use Cp\Membership\Models\UserFavourite;
use Cp\Membership\Models\UserMessage;
use Cp\Membership\Models\UserProfile;
use Cp\Membership\Models\UserProposal;
use Cp\Membership\Models\UserRelative;
use Cp\Membership\Models\UserSearchTerm;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;


class MembershipController extends Controller
{


    public function newProfileCreate()
    {
        return view('membership::user.includes.newProfileCreate');
    }

    public function newProfileFor(Request $request)
    {

        return view('membership::user.includes.newProfileFor', [
            'profile_for' => $request->profile_for,
            'religions' => ProfileReligion::latest()->get(),
            'casts' => ProfileCast::latest()->get(),
        ]);
    }



    public function cvPictureUpload(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'cv' => 'required|file|mimes:pdf,doc,docx',
            'profile_pic' => 'required|file|image|mimes:jpg,bmp,png,jpeg,gif',
            'extra_photo_first' => 'required|file|image|mimes:jpg,bmp,png,jpeg,gif',
            'extra_photo_second' => 'required|file|image|mimes:jpg,bmp,png,jpeg,gif',
            'extra_photo_third' => 'required|file|image|mimes:jpg,bmp,png,jpeg,gif',
            'profile_for' => 'required|string|min:2',
            'gender' => 'required',
        ]);

        if ($validator->fails()) {
            toast('Please submit your data correctly', 'error');
            return back()->withInput()->withErrors($validator)->with('card-open', 'card-open');
        }


        $cvPic = Auth::user()->cvPic;
        if ($cvPic) {
            toast('Cv Picture Already Uploaded', 'error');
            return redirect()->back();
        }

        $me = $request->user();
        $cvpic = new UserCvPicture();
        $cvpic->user_id = $me->id;
        $cvpic->profile_for = $request->profile_for;
        $cvpic->gender = $request->gender;
        $cvpic->profile_user_id = $me->id;

        if ($cv = $request->cv) {

            $extension = strtolower($cv->getClientOriginalExtension());
            $randomCvName = $me->id . '_cv_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

            Storage::disk('public')->put('cv/' . $randomCvName, File::get($cv));
            $cvpic->cv = $randomCvName;
        }

        if ($pp = $request->profile_pic) {
            $extension = strtolower($pp->getClientOriginalExtension());
            $randomPpName = $me->id . '_pic_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

            Storage::disk('public')->put('photo/' . $randomPpName, File::get($pp));
            $cvpic->profile_pic = $randomPpName;
        }

        if ($ep1 = $request->extra_photo_first) {

            $extension = strtolower($ep1->getClientOriginalExtension());
            $randomEp1Name = $me->id . '_pic_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

            Storage::disk('public')->put('photo/' . $randomEp1Name, File::get($ep1));
            $cvpic->extra_pic_first = $randomEp1Name;
        }

        if ($ep2 = $request->extra_photo_second) {

            $extension = strtolower($ep2->getClientOriginalExtension());
            $randomEp2Name = $me->id . '_pic_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

            Storage::disk('public')->put('photo/' . $randomEp2Name, File::get($ep2));
            $cvpic->extra_pic_second = $randomEp2Name;
        }

        if ($ep3 = $request->extra_photo_third) {

            $extension = strtolower($ep3->getClientOriginalExtension());
            $randomEp3Name = $me->id . '_pic_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

            Storage::disk('public')->put('photo/' . $randomEp3Name, File::get($ep3));
            $cvpic->extra_pic_third = $randomEp3Name;
        }

        $cvpic->addedby_id = $me->id;
        $cvpic->save();

        toast('Cv Picture Create Successfully', 'success');
        return redirect()->back();
    }



    public function newProfileForStore(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:20',
            'religion_id' => 'required',
        ]);


        if ($validator->fails()) {
            toast('Please submit your data correctly', 'error');
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', ' Try Again With correct Info');
        }



        $up = Auth::user()->profile;
        if (!$up) {
            $up = new UserProfile();
            $up->user_id = Auth::id();
            $up->addedby_id = Auth::id();
            $up->save();

            $us = new UserSearchTerm();
            $us->user_id = Auth::user()->id;
            $us->save();
        }

        $up->gender = Auth::user()->gender ?: null;
        $up->religion_id = $request->religion_id ?: null;
        $up->cast_id = $request->cast_id ?: null;
        $up->profession = Auth::user()->profession ?: null;
        $up->dob = Auth::user()->dob ?: null;
        $up->profile_created_by = Auth::user()->name;
        $up->profile_for = $request->profile_for ?: null;
        $up->save();

        $user = Auth::user();
        $user->name = $request->name;
        $user->save();

        toast('You have successfully created new profile. Please, upload photo and update other information.', 'success');
        return redirect()->route('user.newProfileNextStep');
    }


    public function newProfileNextStep()
    {
        $data['countries'] = Country::get();
        $data['profile'] =  Auth::user()->profile;
        $data['religions'] = ProfileReligion::latest()->get();
        $data['casts'] = ProfileCast::latest()->get();
        $data['parameters'] = ProfileParameter::where('active', 1)->get();
        return view('membership::user.includes.newProfileNextStep', $data);
    }



    public function profileInfoUpdate()
    {
        menuSubmenu('userSettings', 'profileInfo');
        $data['countries'] = Country::get();
        $data['profile'] =  Auth::user()->profile;
        $data['religions'] = ProfileReligion::latest()->get();
        $data['casts'] = ProfileCast::latest()->get();
        $data['parameters'] = ProfileParameter::where('active', 1)->get();
        return view('membership::user.includes.newProfileNextStep', $data);
    }





    public function newProfileNextStepStore(Request $request)
    {

        $user = Auth::user();
        $validation = Validator::make(
            $request->all(),
            [
                'marital_status' => 'required',
                'education_level' => 'required|string|min:2|max:50',
                'height' => 'required',
                'skin_color' => 'required',
                'body_build' => 'required',
                'weight' => 'required',
                'language_one' => 'required',
                'language_two' => 'nullable',
                'language_three' => 'nullable',
                'birth_country' => 'required',
                'birth_city' => 'required|string|min:2|max:50',
                'present_country' => 'required',
                'present_city' => 'required|string|min:2|max:50',
                'present_address' => 'required|string|min:2|max:800',
                'permanent_address' => 'required|string|min:2|max:800',
                'citizenship' => 'nullable',
                'photo_hide' => 'nullable',
                'will_job_after_marriage' => 'nullable',
                'profile_pic' => 'nullable|file|image|mimes:jpg,bmp,png,jpeg,gif',
                'extra_photo_first' => 'nullable|file|image|mimes:jpg,bmp,png,jpeg,gif',
                'extra_photo_second' => 'nullable|file|image|mimes:jpg,bmp,png,jpeg,gif',
                'extra_photo_third' => 'nullable|file|image|mimes:jpg,bmp,png,jpeg,gif',
                'father_name' => 'required',
                'father_occupation' => 'required',
                'mother_name' => 'required',
                'mother_occupation' => 'required',
                'number_of_brother' => 'nullable',
                'how_many_brother_married' => 'nullable',
                'number_of_sister' => 'nullable',
                'how_many_sister_married' => 'nullable',
                'about_myself' => 'required|min:3|max:1000',

            ]
        );

        if ($validation->fails()) {
            toast('Please submit your data correctly', 'error');
            return back()->withInput()->withErrors($validation)->with('card-open', 'card-open');
        }

        $mi = Auth::user()->profile;
        $mi->marital_status = $request->marital_status ?: null;
        $mi->education_level = $request->education_level ?: null;
        $mi->profession = $request->profession ?: Auth::user()->profession;
        $mi->height = $request->height ?: null;
        $mi->skin_color = $request->skin_color ?: null;
        $mi->body_build = $request->body_build ?: null;
        $mi->weight = $request->weight ?: null;
        $mi->language_one = $request->language_one ?: null;
        $mi->language_two = $request->language_two ?: null;
        $mi->language_three = $request->language_three ?: null;
        $mi->birth_country = $request->birth_country ?: null;
        $mi->birth_city = $request->birth_city ?: null;
        $mi->present_country = $request->present_country ?: null;
        $mi->present_city = $request->present_city ?: null;
        $mi->present_address = $request->present_address ?: null;
        $mi->permanent_address = $request->permanent_address ?: null;
        $mi->citizenship = $request->citizenship ?: null;
        $mi->photo_hide = $request->photo_hide ? 1 : 0;
        $mi->will_job_after_marriage = $request->will_job_after_marriage ? 1 : 0;

        $mi->father_name = $request->father_name ?: null;
        $mi->father_occupation = $request->father_occupation ?: null;
        $mi->mother_name = $request->mother_name ?: null;
        $mi->mother_occupation = $request->mother_occupation ?: null;
        $mi->number_of_brother = $request->number_of_brother ?: null;
        $mi->how_many_brother_married = $request->how_many_brother_married ?: null;
        $mi->number_of_sister = $request->number_of_sister ?: null;
        $mi->how_many_sister_married = $request->how_many_sister_married ?: null;
        $mi->about_myself = $request->about_myself ?: null;
        $mi->profile_for = $request->profile_for ?: $mi->profile_for;
        $mi->status = 'pending';




        if ($pp = $request->profile_pic) {
            $extension = strtolower($pp->getClientOriginalExtension());
            $randomPpName = $user->id . '_pic_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

            Storage::disk('public')->put('photo/' . $randomPpName, File::get($pp));

            if ($mi->profile_pic) {
                $f = 'photo/' . $mi->profile_pic;
                if (Storage::disk('public')->exists($f)) {
                    Storage::disk('public')->delete($f);
                }
            }

            $mi->profile_pic = $randomPpName;
        }




        if ($ep1 = $request->extra_photo_first) {

            $extension = strtolower($ep1->getClientOriginalExtension());
            $randomEp1Name = $user->id . '_pic_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

            Storage::disk('public')->put('photo/' . $randomEp1Name, File::get($ep1));

            if ($mi->extra_pic_first) {
                $f = 'photo/' . $mi->extra_pic_first;
                if (Storage::disk('public')->exists($f)) {
                    Storage::disk('public')->delete($f);
                }
            }

            $mi->extra_pic_first = $randomEp1Name;
        }



        if ($ep2 = $request->extra_photo_second) {

            $extension = strtolower($ep2->getClientOriginalExtension());
            $randomEp2Name = $user->id . '_pic_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;

            Storage::disk('public')->put('photo/' . $randomEp2Name, File::get($ep2));

            if ($mi->extra_pic_second) {
                $f = 'photo/' . $mi->extra_pic_second;
                if (Storage::disk('public')->exists($f)) {
                    Storage::disk('public')->delete($f);
                }
            }
            $mi->extra_pic_second = $randomEp2Name;
        }




        if ($ep3 = $request->extra_photo_third) {
            $extension = strtolower($ep3->getClientOriginalExtension());
            $randomEp3Name = $user->id . '_pic_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;
            Storage::disk('public')->put('photo/' . $randomEp3Name, File::get($ep3));

            if ($mi->extra_pic_third) {
                $f = 'photo/' . $mi->extra_pic_third;
                if (Storage::disk('public')->exists($f)) {
                    Storage::disk('public')->delete($f);
                }
            }
            $mi->extra_pic_third = $randomEp3Name;
        }


        $mi->checked = 0;
        $mi->submit_by_user = 0;
        $mi->save();


        toast('একাউন্টের প্রোফাইল ইনফরমেশন সফলভাবে আপডেট হয়েছে!', 'success');
        return redirect()->back();
    }



    public function newProfileEducationStore(Request $request)
    {

        $validation = Validator::make(
            $request->all(),
            [
                'organization_name' => 'required|min:1|max:200',
                'organization_address' => 'nullable|min:1|max:255',
                'passed_degree' => 'required',
                'passed_department' => 'nullable',
                'year_from' => 'required',
                'year_to' => 'required',
                'passed_year' => 'required',
                'passed_grade' => 'required',


            ]
        );

        if ($validation->fails()) {
            toast('Please submit your data correctly', 'error');
            return back()->withInput()->withErrors($validation)->with('card-open', 'card-open');
        }

        $user = Auth::user();
        $year_from = date_create("{$request->year_from}-01-01");
        $year_to = date_create("{$request->year_to}-01-01");
        $passed_year = date_create("{$request->passed_year}-01-01");

        $edu = new UserEducationRecord();
        $edu->passed_degree = $request->passed_degree;
        $edu->passed_grade = $request->passed_grade;
        $edu->passed_department = $request->passed_department;
        $edu->organization_name = $request->organization_name;
        $edu->organization_address = $request->organization_address;
        $edu->year_from = $year_from;
        $edu->year_to = $year_to;
        $edu->passed_year = $passed_year;
        $edu->user_id = $user->id;
        $edu->save();

        $mi = Auth::user()->profile;
        $mi->education_info_checked = 0;
        $mi->submit_by_user = 0;
        $mi->save();

        toast('শিক্ষার তথ্যসহ একটি তথ্য সারি তৈরি হয়েছে। আরো তথ্য যুক্ত করতে একই রকমভাবে চেষ্টা করুন!', 'success');
        return redirect()->back();
    }


    public function newProfileEducationEdit(Request $request)
    {
        $edu = UserEducationRecord::find($request->q);
        return response()->json([
            'success' => true,
            'edu' =>  $edu
        ]);
    }


    public function newProfileEducationUpdate(Request $request)
    {

        $validation = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:1|max:200',
                'address' => 'nullable|min:1|max:255',
                'degree' => 'required',
                'department' => 'nullable',
                'from' => 'required',
                'to' => 'required',
                'year' => 'required',
                'grade' => 'required',
            ]
        );

        if ($validation->fails()) {
            toast('Please submit your data correctly', 'error');
            return back()->withInput()->withErrors($validation)->with('card-open', 'card-open');
        }

        $year_from = date_create("{$request->from}-01-01");
        $year_to = date_create("{$request->to}-01-01");
        $passed_year = date_create("{$request->year}-01-01");

        $edu = UserEducationRecord::find($request->edu_id);
        $edu->passed_degree = $request->degree;
        $edu->passed_grade = $request->grade;
        $edu->passed_department = $request->department;
        $edu->organization_name = $request->name;
        $edu->organization_address = $request->address;
        $edu->year_from = $year_from;
        $edu->year_to = $year_to;
        $edu->passed_year = $passed_year;
        $edu->save();


        $mi = Auth::user()->profile;
        $mi->education_info_checked = 0;
        $mi->submit_by_user = 0;
        $mi->save();

        toast('শিক্ষার তথ্য আপডেট হয়েছে!', 'success');
        return redirect()->back();
    }


    public function newProfileEducationDelete(UserEducationRecord $edu)
    {
        $edu->delete();
        toast('শিক্ষার তথ্যসহ ডিলিট করা হয়েছে!', 'success');
        return redirect()->back();
    }



    public function newProfileRelativeStore(Request $request)
    {


        $validation = Validator::make(
            $request->all(),
            [

                'name' => 'required|min:1|max:200',
                'details' => 'required|min:1|max:255',

                // 'orgType' => 'required',
                'relation_with_user' => 'required|min:1|max:255',
                'working_role' => 'required|min:1|max:255',
                // 'passedGrade'=> 'required',
                'org_name' => 'nullable|min:2|max:255',

            ]
        );

        if ($validation->fails()) {
            toast('Please submit your data correctly', 'error');
            return back()->withInput()->withErrors($validation)->with('card-open', 'card-open');
        }

        $user = Auth::user();
        $rel = new UserRelative();
        $rel->user_id = $user->id;
        $rel->relation_with_user = $request->relation_with_user;
        $rel->name = $request->name;
        $rel->working_role = $request->working_role;
        $rel->org_name = $request->org_name;
        $rel->details = $request->details;
        $rel->addedby_id = Auth::id();
        $rel->save();

        $mi = Auth::user()->profile;
        $mi->family_info_checked = 0;
        $mi->submit_by_user = 0;
        $mi->save();

        toast('আত্মীয়র তথ্যসহ একটি তথ্য সারি তৈরি হয়েছে। আরো তথ্য যুক্ত করতে একই রকমভাবে চেষ্টা করুন!', 'success');
        return redirect()->back();
    }

    public function newProfileRelativeEdit(Request $request)
    {
        $relative = UserRelative::find($request->q);
        return response()->json([
            'success' => true,
            'relative' =>  $relative
        ]);
    }

    public function newProfileRelativeUpdate(Request $request)
    {

        $validation = Validator::make(
            $request->all(),
            [

                'r_name' => 'required|min:1|max:200',
                'r_details' => 'required|min:1|max:255',
                'r_relation_with_user' => 'required|min:1|max:255',
                'r_working_role' => 'required|min:1|max:255',
                'r_org_name' => 'nullable|min:2|max:255',

            ]
        );

        if ($validation->fails()) {
            toast('Please submit your data correctly', 'error');
            return back()->withInput()->withErrors($validation)->with('card-open', 'card-open');
        }


        $rel = UserRelative::find($request->relative_id);
        $rel->relation_with_user = $request->r_relation_with_user;
        $rel->name = $request->r_name;
        $rel->working_role = $request->r_working_role;
        $rel->org_name = $request->r_org_name;
        $rel->details = $request->r_details;
        $rel->addedby_id = Auth::id();
        $rel->save();

        $mi = Auth::user()->profile;
        $mi->family_info_checked = 0;
        $mi->submit_by_user = 0;
        $mi->save();


        toast('আত্মীয়র তথ্যসহ আপডেট হয়েছে!', 'success');
        return redirect()->back();
    }

    public function newProfileRelativeDelete(UserRelative $relative)
    {
        $relative->delete();
        toast('আত্মীয়র তথ্যসহ ডিলিট করা হয়েছে!', 'success');
        return redirect()->back();
    }



    public function marriagePartnerPreference(Request $request)
    {

        $validation = Validator::make(
            $request->all(),
            [
                "min_age" => 'required',
                "max_age" => 'required',
                "min_height" => 'required',
                "max_height" => 'required',
                "min_weight" => 'required',
                "max_weight" => 'required',
                "citizenships" => 'nullable',
                "present_countries" => 'required',
                "birth_countries" => 'required',
                "professions" => 'required',
                "skin_colors" => 'required',
                "body_builds" => 'required',
                "maritals_status" => 'required',
                "education_levels" => 'required',
                "u_religion_id" => 'required',
                "languages" => 'required',
            ]
        );



        if ($validation->fails()) {
            toast('Please submit your data correctly', 'error');
            return back()->withInput()->withErrors($validation)->with('card-open', 'card-open');
        }

        if (Auth::user()->partnerPreference) {
            $pp = Auth::user()->partnerPreference;
            $pp->min_age = $request->min_age;
            $pp->max_age = $request->max_age;
            $pp->min_height = $request->min_height;
            $pp->max_height = $request->max_height;
            $pp->min_weight = $request->min_weight;
            $pp->max_weight = $request->max_weight;
            $pp->religion_id = $request->u_religion_id;
            $pp->cast_id = $request->u_cast_id;
            $pp->user_id = Auth::id();

            if ($request->maritals_status) {
                $pp->marital_status = implode(', ', $request->maritals_status);
            } else {
                $pp->marital_status = null;
            }

            if ($request->skin_colors) {
                $pp->skin_color = implode(', ', $request->skin_colors);
            } else {
                $pp->skin_color = null;
            }

            if ($request->body_builds) {
                $pp->body_build = implode(', ', $request->body_builds);
            } else {
                $pp->body_build = null;
            }


            if ($request->education_levels) {
                $pp->education_level = implode(', ', $request->education_levels);
            } else {
                $pp->education_level = null;
            }



            if ($request->citizenships) {
                $pp->citizenship = implode(', ', $request->citizenships);
            } else {
                $pp->citizenship = null;
            }

            if ($request->present_countries) {
                $pp->present_country = implode(', ', $request->present_countries);
            } else {
                $pp->present_country = null;
            }

            if ($request->birth_countries) {
                $pp->birth_country = implode(', ', $request->birth_countries);
            } else {
                $pp->birth_country = null;
            }

            if ($request->professions) {
                $pp->profession = implode(', ', $request->professions);
            } else {
                $pp->profession = null;
            }

            if ($request->languages) {
                $pp->language = implode(', ', $request->languages);
            } else {
                $pp->language = null;
            }


            $pp->will_job_after_marriage = $request->will_job_after_marriage ? 1 : 0;

            $pp->review_request = true;


            $pp->save();

            $mi = Auth::user()->profile;
            $mi->partner_info_checked = 0;
            $mi->submit_by_user = 0;
            $mi->save();

            toast('পাত্র/পাত্রী সম্পর্কে আপনার চাওয়াগুলো আপডেট করা হয়েছে।.', 'success');
            return redirect()->back();
        } else {
            $pp = new UserSearchTerm();
            $pp->min_age = $request->min_age;
            $pp->max_age = $request->max_age;
            $pp->min_height = $request->min_height;
            $pp->max_height = $request->max_height;
            $pp->min_weight = $request->min_weight;
            $pp->max_weight = $request->max_weight;
            $pp->marital_status = $request->marital_status;
            $pp->religion = $request->religion;
            $pp->user_id = Auth::id();

            if ($request->skin_colors) {
                $pp->skin_color = implode(', ', $request->skin_colors);
            } else {
                $pp->skin_color = null;
            }

            if ($request->body_builds) {
                $pp->body_build = implode(', ', $request->body_builds);
            } else {
                $pp->body_build = null;
            }




            if ($request->education_level) {
                $pp->education_level = implode(', ', $request->education_level);
            } else {
                $pp->education_level = null;
            }



            if ($request->citizenship) {
                $pp->citizenship = implode(', ', $request->citizenship);
            } else {
                $pp->citizenship = null;
            }

            if ($request->present_country) {
                $pp->present_country = implode(', ', $request->present_country);
            } else {
                $pp->present_country = null;
            }

            if ($request->birth_country) {
                $pp->birth_country = implode(', ', $request->birth_country);
            } else {
                $pp->birth_country = null;
            }

            if ($request->profession) {
                $pp->profession = implode(', ', $request->profession);
            } else {
                $pp->profession = null;
            }

            if ($request->language) {
                $pp->language = implode(', ', $request->language);
            } else {
                $pp->language = null;
            }

            $pp->will_job_after_marriage = $request->will_job_after_marriage ? 1 : 0;

            $pp->review_request = true;

            $pp->save();

            toast('পাত্র/পাত্রী সম্পর্কে আপনার চাওয়াগুলো আপডেট করা হয়েছে।', 'success');
            return back();
        }
    }

    public function newUserEndPartnerPreference()
    {
        $up = new UserSearchTerm();
        $up->user_id = Auth::user()->id;
        $up->save();
        toast('নতুন পার্টনার প্রেফারেন্স তৈরি করা হয়েছে!', 'success');
        return redirect()->back();
    }


    public function informationUpdate()
    {
        $user = Auth::user();
        $up  =  $user->profile;
        $up->submit_by_user = 1;

        $user->approvedProfileEmailSent();

        $admins = User::whereHas('roles', function ($q) {
            $q->where('name', 'admin');
        })->where('active', 1)->get();

        foreach ($admins as $admin) {
            $admin->approvedProfileToAdmin($user);
        }
        $up->save();
        toast('উপরের তথ্যগুলো অপ্প্রভড করা হয়েছে!', 'success');
        return redirect()->route('userrole.dashboard');
    }



    //membership package 
    public function allPackages()
    {
        $data['packages'] = MembershipPackage::latest()->whereActive(true)->whereFeatured(true)->simplePaginate(20);
        return view('membership::frontend.membershipPackage.allPackages', $data);
    }


    public function viewPackage(MembershipPackage $package)
    {

        $pendingOrder = auth()->user()->packageOrders()->where('order_status', 'pending')->first();

        return view('membership::frontend.membershipPackage.viewPackage', compact('package', 'pendingOrder'));
    }


    public function packageOrder(Request $request, MembershipPackage $package)
    {

        $pendingOrder = auth()->user()->packageOrders()->where('order_status', 'pending')->first();

        // dd($pendingOrder);

        if ($pendingOrder != null) {
            Alert::warning('Order already pending! You have pending order, please wait. ', 'warning');
            return redirect()->back();
        }
        $order = new MembershipPackageOrder();
        $order->user_id = auth()->user()->id;
        $order->membership_package_id = $package->id;
        $order->title = $package->title;
        $order->description = $package->description;
        $order->regular_price = $package->regular_price;
        $order->discount = $package->discount;
        $order->discount_price = $package->discount_price;
        $order->final_price = $package->final_price;
        $order->duration = $package->duration;
        $order->daily_contact_limit = $package->daily_contact_limit ?? 0;
        $order->total_contact_limit = $package->total_contact_limit ?? 0;
        $order->daily_cv_collect_limit = $package->daily_cv_collect_limit ?? 0;
        $order->total_cv_collect_limit = $package->total_cv_collect_limit ?? 0;
        $order->daily_proposal_sent = $package->daily_proposal_sent ?? 0;
        $order->total_proposal_sent = $package->total_proposal_sent ?? 0;
        $order->daily_matched_profile_sent = $package->daily_matched_profile_sent ?? 0;
        $order->total_matched_profile_sent = $package->total_matched_profile_sent ?? 0;
        $order->addedby_id = Auth::id();
        $order->save();
        // Alert::success('Order successfully submitted. please wait for review.', 'Success');

        Auth::user()->orderSubmissionEmailSend($order);

        $admins = User::whereHas('roles', function ($q) {
            $q->where('name', 'admin');
        })->where('active', 1)->get();

        foreach ($admins as $admin) {
            $admin->orderSubmissionSentToAdmin($order);
        }


        toast('Order successfully submitted. please wait for review.', 'success');
        return redirect()->route('membership.myOrderDeatils', $order->id);
    }



    public function viewProfile(User $user)
    {
        if (Auth::user()->profile) {
            $vp = Auth::user()->profileNewVisit($user->id);
            return view('membership::user.viewProfile', compact('user'));
        } else {
            toast('You have no profile, please create a profile and then try again.', 'warning');
            return redirect()->back();
        }
    }


    public function favouriteProfile(User $user)
    {
        if (Auth::user()->profile) {
            if (Auth::user()->id != $user->id) {
                $favourite = Auth::user()->favourites()->where('user_second_id', $user->id)->first();
                if ($favourite) {
                    $favourite->delete();
                    $msg = 'ফেভারিট লিস্ট থেকে রিমুভ করা হয়েছে!';
                    $msgStatus = 'success';
                    if (request()->ajax()) {
                        return response()->json([
                            'success' => true,
                            'msg' => $msg,
                            'msgStatus' => $msgStatus
                        ]);
                    }
                    toast($msg, $msgStatus);
                    return redirect()->back();
                }
                $favourite = new UserFavourite();
                $favourite->user_id = Auth::user()->id;
                $favourite->user_second_id = $user->id;
                $favourite->save();

                $msg = 'ফেভারিট লিস্ট এড  হয়েছে!';
                $msgStatus = 'success';
                if (request()->ajax()) {
                    return response()->json([
                        'success' => true,
                        'msg' => $msg,
                        'msgStatus' => $msgStatus
                    ]);
                }
                toast($msg, $msgStatus);
                return redirect()->back();
            }
        } else {
            $msg = 'You have no profile, please create a profile and then try again.!';
            $msgStatus = 'warning';
            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'msg' => $msg,
                    'msgStatus' => $msgStatus
                ]);
            }
            return redirect()->back();
        }
    }

    public function contactProfile(User $user)
    {


        // dd(Auth::user()->profile->total_contact_limit);
        if (Auth::user()->profile) {
            if (Auth::user()->HasContactLimit()) {
                if (Auth::user()->isAlreadyContactOf($user)) {
                    $msg = 'অলরেডি কন্টাক্ট করা হয়েছে!';
                    $msgStatus = 'success';
                    if (request()->ajax()) {
                        return response()->json([
                            'success' => true,
                            'msg' => $msg,
                            'msgStatus' => $msgStatus
                        ]);
                    }
                    toast($msg, $msgStatus);
                    return redirect()->back();
                } else {

                    if ($user->id == Auth::id()) {
                        return back();
                    }

                    $contact = new UserContact();
                    $contact->user_id = Auth::user()->id;
                    $contact->user_second_id = $user->id;
                    $contact->save();



                    $msg = 'কন্টাক্ট করা হয়েছে!';
                    $msgStatus = 'success';
                    if (request()->ajax()) {
                        return response()->json([
                            'success' => true,
                            'msg' => $msg,
                            'msgStatus' => $msgStatus
                        ]);
                    }
                    toast($msg, $msgStatus);
                    return redirect()->back();
                }
            } else {

                $msg = 'You have no contact limit please, upgrade your account!';
                $msgStatus = 'warning';
                if (request()->ajax()) {
                    return response()->json([
                        'success' => true,
                        'msg' => $msg,
                        'msgStatus' => $msgStatus
                    ]);
                }
                toast($msg, $msgStatus);

                return redirect()->back();
            }
        } else {

            $msg = 'You have no profile, please create a profile and then try again!';
            $msgStatus = 'warning';
            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'msg' => $msg,
                    'msgStatus' => $msgStatus
                ]);
            }
            toast($msg, $msgStatus);
            return redirect()->back();
        }
    }



    public function myProfileDetails(Request $request)
    {


        $type = $request->type;

        if ($type == 'profile') {
            $profile = Auth::user()->profile;
            $partnerPreference = $profile->user->partnerPreference;
            $userRelativeRecords = $profile->user->userRelativeRecords;
            $userEducationRecords = $profile->user->userEducationRecords;
            return view('membership::user.myProfile', compact('profile', 'partnerPreference', 'userRelativeRecords', 'userEducationRecords'));
        } elseif ($type == 'latest_profiles') {
            $data['users'] = User::whereHas('profile', function ($q) {
                $q->where('checked', 1);
                $q->where('gender', Auth::user()->altGender());
            })->latest()->paginate(4);
            return view('membership::user.my', $data);
        } elseif ($type == 'visitors') {
            $data['users'] = Auth::user()->visitorUsers()->paginate(4);
            return view('membership::user.my', $data);
        } elseif ($type == 'visiteds') {

            $data['users'] = Auth::user()->visitedUsers()->paginate(4);

            return view('membership::user.my', $data);
        } elseif ($type == 'favourites') {
            $data['users'] = Auth::user()->favouriteUsers()->paginate(4);

            return view('membership::user.my', $data);
        } elseif ($type == 'contacts') {
            $data['users'] = Auth::user()->contactUsers()->paginate(4);
            return view('membership::user.my', $data);
        }
        





        
        
        elseif ($type == 'my_matched') {
            $data['users'] = Auth::user()->myMatchedUsers();
            return view('membership::user.my', $data);
        }






        
         elseif ($type == 'pending_proposal_from_me') {
            $data['users'] = Auth::user()->penedingPropsalsFromMe()->where('accepted_at', null)->paginate(4);
            return view('membership::user.my', $data);
        } elseif ($type == 'pending_proposal_to_me') {
            $data['users'] = Auth::user()->penedingPropsalsToMe()->where('accepted_at', null)->paginate(4);
            return view('membership::user.my', $data);
        } elseif ($type == 'proposal_from_me') {
            $data['users'] = Auth::user()->penedingPropsalsFromMe()->where('accepted_at', '!=', null)->paginate(4);
            return view('membership::user.my', $data);
        } elseif ($type == 'proposal_to_me') {
            $data['users'] = Auth::user()->penedingPropsalsToMe()->where('accepted_at', '!=', null)->paginate(4);
            return view('membership::user.my', $data);
        }
    }


    public function proposalModal(Request $request)
    {

        $user = User::find($request->user);
        return response()->json([
            'success' => true,
            'page' => view('membership::user.includes.modalProposalPart', [
                'user' => $user,
            ])->render()


        ]);
    }


    public function proposalSend(Request $request, User $user)
    {

        if (Auth::user()->profile) {
            if (Auth::user()->hasProposalLimit()) {
                if (Auth::user()->id != $user->id) {
                    $proposal = new UserProposal();
                    $proposal->user_id = Auth::user()->id;
                    $proposal->user_to_id = $user->id;
                    $proposal->message = $request->message;
                    $proposal->save();
                    toast('প্রপোসাল সেন্ড করা হয়েছে!', 'success');
                    return redirect()->back();
                }
            } else {
                toast('You have no proposal limit please, upgrade your account.', 'warning');
                return redirect()->back();
            }
        } else {
            toast('You have no profile, please create a profile and then try again.', 'warning');
            return redirect()->back();
        }
    }

    public function proposalDelete(UserProposal $proposal)
    {
        $proposal->delete();
        toast('প্রপোসাল ডিলিট করা হয়েছে!', 'success');
        return redirect()->back();
    }

    public function proposalAccept(UserProposal $proposal)
    {
        $proposal->accepted_at = Carbon::now();
        $proposal->save();
        toast('প্রপোসাল একসেপ্টে করা হয়েছে!', 'success');
        return redirect()->back();
    }



    public function messageDashboard(Request $request)
    {
        menuSubmenu('message', 'message');
        if ($request->userto) {
            $user = User::where('id', $request->userto)->where('id', '<>', Auth::id())->first();
            $open = 0;
        } else {
            $user = Auth::user()->latestMsgUser();
            $open = 1;
        }

        return view('membership::user.myMessages', ['userto' => $user, 'open' => $open]);
    }


    public function messageDashboardPost(Request $request)
    {

        $user = User::where('id', $request->userto)->where('id', '<>', Auth::id())->first();

        if (!$user) {
            abort(404);
        }

        UserMessage::where('last', 1)
            ->where(function ($f) use ($user) {

                $f->where([
                    ['userto_id', '=', $user->id],
                    ['userfrom_id', '=',  Auth::id()]
                ]);

                $f->orWhere([
                    ['userto_id', '=', Auth::id()],
                    ['userfrom_id', '=',  $user->id]
                ]);
            })->update(['last' => 0]);

        $m = new UserMessage;
        $m->userfrom_id = Auth::id();
        $m->userto_id = $user->id;
        $m->message = $request->message;
        $m->save();

        // $user->sendMsgNotifyEmailToUser();
        toast('Your message successfully sent.', 'success');
        return redirect()->back();
    }


    public function myOrders()
    {
        $user = Auth::user();
        $data['orders'] = $user->packageOrders()->latest()->paginate(30);
        return view('membership::user.myOrders', $data);
    }

    public function myOrderDeatils(MembershipPackageOrder $order)
    {
        return view('membership::user.myOrdersDetails', compact('order'));
    }

    public function cancelMyOrder(MembershipPackageOrder $order)
    {
        if($order->transaction_id == null && $order->order_status == 'pending'){
            $order->delete();
            toast('Your message successfully sent.', 'success');
            return redirect()->route('membership.myOrders');
        }else{
           return redirect()->back();
        }
    }

    public function myOrderPrint(MembershipPackageOrder $order)
    {
        return view('membership::admin.orders.orderPrint', [
            'order' => $order,
        ]);
    }


    public function profileSearch(){
        $data['parameters'] = ProfileParameter::where('active', 1)->get();
        return view('membership::user.profileSearch',$data);
    }

   
    public function profileSearchResult(Request $request){

        // $me = Auth::user();

            $min_age = $request->min_age;
            $max_age = $request->max_age;
            $users = User::whereHas('profile', function ($q) use ($request) {
                $q->where('checked', 1);
                $q->where('gender', Auth::user()->altGender());

                if ($request->min_age != null and $request->max_age != null) {
                $start = Carbon::now()->subYear($request->min_age)->toDateString();
                $end = Carbon::now()->subYear($request->max_age)->toDateString();
                $q->whereBetween('dob', [$end, $start]);
                }
                
                elseif ($request->min_age !== null) {
                    $minAgeDate = Carbon::now()->subYear($request->min_age)->toDateString();
                    $q->where('dob', '<=', $minAgeDate);
                } elseif ($request->max_age != null) {
                    $maxAgeDate = Carbon::now()->subYear($request->max_age + 1)->toDateString();
                    $q->where('dob', '>=', $maxAgeDate);
                }
                if( $request->religion)
                {
                    $q->where('religion', $request->religion);
                }

                if( $request->education_level)
                {
                    $q->where('education_level', $request->education_level);
                }
                if( $request->marital_status)
                {
                $q->where('marital_status',  $request->marital_status);
                }

                if( $request->profession)
                {
                    $q->where('profession', $request->profession);
                }
        
            })->latest()->paginate(20);
            
         


            return view('membership::user.profileSearchResult', [
                'users' => $users,
            ]);
    }
}