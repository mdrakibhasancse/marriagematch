<?php

namespace Cp\Membership\Controllers;


use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Cp\Membership\Models\MembershipOrderPayment;
use Cp\Membership\Models\MembershipPackage;
use Cp\Membership\Models\MembershipPackageOrder;
use Cp\Membership\Models\ProfileCast;
use Cp\Membership\Models\ProfileCat;
use Cp\Membership\Models\ProfileCategory;
use Cp\Membership\Models\ProfileParameter;
use Cp\Membership\Models\ProfileReligion;
use Cp\Membership\Models\ProfileSettingField;
use Cp\Membership\Models\ProfileSettingValue;
use Cp\Membership\Models\ProfileSubcat;
use Cp\Membership\Models\ProfileSubcategory;
use Cp\Membership\Models\UserCvPicture;
use Cp\Membership\Models\UserEducationRecord;
use Cp\Membership\Models\UserMessage;
use Cp\Membership\Models\UserProfile;
use Cp\Membership\Models\UserRelative;
use Cp\Membership\Models\UserSearchTerm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;


class AdminMembershipController extends Controller
{


    public function messageUsers(User $user)
    {
        $msgUsers = $user->messageContacts();



        return view('membership::admin.users.messageUsers', compact('msgUsers', 'user'));
    }

    public function conversationsDetailsOfUsers(Request $request)
    {
        $user1 = User::where('id', $request->user1)->first();
        $user2 = User::where('id', $request->user2)->first();
        $messages = $user1->messageWithUser($user2)->reverse();
        return view('membership::admin.users.conversationsDetailsOfUsers', compact('messages', 'user1', 'user2'));
    }


    // Profile Category SubCategory start 

    public function profileCategoriesAll()
    {
        menuSubmenu('marriageParameter', 'profileCategoriesAll');
        $data['categories'] = ProfileCategory::latest()->paginate(30);
        return view('membership::admin.profileCategories.profileCategoriesAll', $data);
    }


    public function profileCategoryCreate()
    {
        menuSubmenu('marriageParameter', 'profileCategoriesAll');
        return view('membership::admin.profileCategories.profileCategoryCreate');
    }


    public function profileCategoryStore(Request $request)
    {

        menuSubmenu('marriageParameter', 'profileCategoriesAll');
        $request->validate([
            'title' => 'string|required',
        ]);

        $category =  new ProfileCategory();
        $category->title = $request->title;
        $category->description = $request->description;
        $category->addedby_id = Auth::id();

        if ($request->hasFile('feature_image')) {
            $file = $request->feature_image;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = time() . $ext;
            Storage::disk('public')->put('profile_categories_images/' . $imageName, File::get($file));
            $category->feature_image = $imageName;
        }

        $category->save();
        cache()->flush();
        toast('Profile Category Successfully Created', 'success');
        return redirect()->back();
    }


    public function profileCategoryEdit(ProfileCategory $category)
    {
        menuSubmenu('marriageParameter', 'profileCategoriesAll');
        $data['category'] = $category;
        return view('membership::admin.profileCategories.profileCategoryEdit', $data);
    }



    public function profileCategoryUpdate(Request $request, ProfileCategory $category)
    {
        menuSubmenu('profile', 'profileCategoriesAll');
        $request->validate([
            'title' => 'string|required',
        ]);

        $category->title  = $request->title;
        $category->description = $request->description;
        $category->active  = $request->active ?? 0;
        $category->editedby_id = Auth::id();

        if ($request->hasFile('feature_image')) {
            $old_file = 'profile_categories_images/' . $category->feature_image;
            if (Storage::disk('public')->exists($old_file)) {
                Storage::disk('public')->delete($old_file);
            }
            $file = $request->feature_image;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = time() . $ext;
            Storage::disk('public')->put('profile_categories_images/' . $imageName, File::get($file));
            $category->feature_image = $imageName;
        }

        $category->save();
        cache()->flush();
        toast('profile Category Successfully Updated', 'success');
        return redirect()->back();
    }

    public function profileCategoryDelete(ProfileCategory $category)
    {
        menuSubmenu('marriageParameter', 'profileCategoriesAll');
        $old_file = 'profile_categories_images/' . $category->image;
        if (Storage::disk('public')->exists($old_file)) {
            Storage::disk('public')->delete($old_file);
        }
        $category->delete();
        cache()->flush();
        toast('profile Category Successfully Deleted', 'success');
        return redirect()->back();
    }


    public function profileCategoryActive(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('profile_categories')->where('id', $request->id)->update(['active' => 1]);
        } else {
            DB::table('profile_categories')->where('id', $request->id)->update(['active' => 0]);
        }
        return response()->json(['msg' => 'Status Successfully updated ', 'status' => true]);
    }



    public function profileSubCategoriesAll()
    {
        menuSubmenu('marriageParameter', 'profileSubcategoriesAll');
        $data['subCategories'] = ProfileSubcategory::latest()->paginate(30);
        return view('membership::admin.profileSubcategories.profileSubcategoriesAll', $data);
    }

    public function profileSubCategoryCreate()
    {
        menuSubmenu('marriageParameter', 'profileSubcategoriesAll');
        $data['categories'] = profileCategory::latest()->get();
        return view('membership::admin.profileSubcategories.profileSubcategoryCreate', $data);
    }


    public function profileSubCategoryStore(Request $request)
    {

        menuSubmenu('marriageParameter', 'profileSubcategoriesAll');

        $request->validate([
            'title' => 'string|required',
            'profile_category_id' => 'required',
        ]);

        $subCategory = new ProfileSubcategory();
        $subCategory->profile_category_id = $request->profile_category_id;
        $subCategory->title   = $request->title;
        $subCategory->description = $request->description;
        $subCategory->addedby_id  = Auth::id();
        if ($request->hasFile('feature_image')) {
            $file = $request->feature_image;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = time() . $ext;
            Storage::disk('public')->put('profile_SubCategories_images/' . $imageName, File::get($file));
            $subCategory->feature_image = $imageName;
        }
        $subCategory->save();
        cache()->flush();
        toast('Profile Subcategory Successfully Created', 'success');
        return redirect()->back();
    }


    public function profileSubCategoryEdit(ProfileSubcategory $subCategory)
    {
        menuSubmenu('marriageParameter', 'profileSubcategoriesAll');
        $data['subCategory'] = $subCategory;
        $data['categories'] = profileCategory::latest()->get();
        return view('membership::admin.profileSubcategories.profileSubcategoryEdit', $data);
    }



    public function profileSubCategoryUpdate(Request $request, ProfileSubcategory $subCategory)
    {
        menuSubmenu('marriageParameter', 'profileSubcategoriesAll');
        $request->validate([
            'title' => 'string|required',
            'profile_category_id' => 'required'
        ]);

        $subCategory->profile_category_id = $request->profile_category_id;
        $subCategory->title  = $request->title;
        $subCategory->description = $request->description;
        $subCategory->active      = $request->active ?? 0;
        $subCategory->editedby_id = Auth::id();
        if ($request->hasFile('feature_image')) {
            $old_file = 'profile_subCategories_images/' . $subCategory->feature_image;
            if (Storage::disk('public')->exists($old_file)) {
                Storage::disk('public')->delete($old_file);
            }
            $file = $request->feature_image;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = time() . $ext;
            Storage::disk('public')->put('profile_subCategories_images/' . $imageName, File::get($file));
            $subCategory->feature_image = $imageName;
        }
        $subCategory->save();
        cache()->flush();
        toast('Profile Subcategory Successfully Updated', 'success');
        return redirect()->back();
    }

    public function profileSubCategoryDelete(ProfileSubcategory $subCategory)
    {
        menuSubmenu('marriageParameter', 'profileSubcategoriesAll');
        $old_file = 'profile_subCategories_images/' . $subCategory->image;
        if (Storage::disk('public')->exists($old_file)) {
            Storage::disk('public')->delete($old_file);
        }
        $subCategory->delete();
        cache()->flush();
        toast('profile Subcategory Successfully Deleted', 'success');
        return redirect()->back();
    }


    public function profileSubCategoryActive(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('profile_subcategories')->where('id', $request->id)->update(['active' => 1]);
        } else {
            DB::table('profile_subcategories')->where('id', $request->id)->update(['active' => 0]);
        }
        return response()->json(['msg' => 'Status Successfully updated ', 'status' => true]);
    }

    // Profile Category SubCategory End



    // Profile Category Religion Start

    public function profileReligionsAll()
    {
        menuSubmenu('marriageParameter', 'profileReligionsAll');
        $data['religions'] = ProfileReligion::latest()->paginate(30);
        return view('membership::admin.profileReligions.profileReligionsAll', $data);
    }

    public function profileReligionStore(Request $request)
    {
        menuSubmenu('marriageParameter', ' profileReligionsAll');
        $request->validate([
            'name' => 'string|required',
        ]);

        $religion = new ProfileReligion();
        $religion->name = $request->name;
        $religion->addededby_id = Auth::id();
        $religion->save();
        toast('Profile Religion Successfully Created', 'success');
        return redirect()->back();
    }

    public function profileReligionEdit(ProfileReligion $religion)
    {
        menuSubmenu('marriageParameter', 'profileReligionsAll');
        return view('membership::admin.profileReligions.profileReligionEdit', compact('religion'));
    }

    public function profileReligionUpdate(Request $request, ProfileReligion $religion)
    {
        menuSubmenu('marriageParameter', ' profileReligionsAll');

        $request->validate([
            'name' => 'string|required',
        ]);

        $religion->name = $request->name;
        $religion->editedby_id = Auth::id();
        $religion->active  = $request->active ?? 0;
        $religion->save();
        toast('Profile Religion Successfully Updated', 'success');
        return redirect()->route('admin.profileReligionsAll');
    }


    public function profileReligionDelete(ProfileReligion $religion)
    {
        menuSubmenu('marriageParameter', 'profileReligionsAll');
        $religion->delete();
        cache()->flush();
        toast('Profile Religion Successfully Deleted', 'success');
        return redirect()->back();
    }



    public function profileCastsAll()
    {
        menuSubmenu('marriageParameter', 'profileCastsAll');
        $data['casts'] = ProfileCast::with('religion')->latest()->paginate(30);
        // dd($data['casts']);
        $data['religions'] = ProfileReligion::latest()->get();
        return view('membership::admin.profileCasts.profileCastsAll', $data);
    }

    public function profileCastStore(Request $request)
    {
        menuSubmenu('marriageParameter', ' profileCastsAll');
        $request->validate([
            'name' => 'string|required',
            'religion_id' => 'required',
        ]);

        $cast = new ProfileCast();
        $cast->name = $request->name;
        $cast->religion_id = $request->religion_id;
        $cast->addedby_id = Auth::id();
        $cast->save();
        toast('Profile Cast Successfully Created', 'success');
        return redirect()->back();
    }

    public function profileCastEdit(ProfileCast $cast)
    {
        menuSubmenu('marriageParameter', ' profileCastsAll');
        $religions = ProfileReligion::latest()->get();
        return view('membership::admin.profileCasts.profileCastEdit', compact('cast', 'religions'));
    }


    public function profileCastUpdate(Request $request, ProfileCast $cast)
    {
        menuSubmenu('marriageParameter', ' profileCastsAll');
        $request->validate([
            'name' => 'string|required',
            'religion_id' => 'required',
        ]);

        $cast->name = $request->name;
        $cast->religion_id = $request->religion_id;
        $cast->editedby_id = Auth::id();
        $cast->active  = $request->active ?? 0;
        $cast->save();
        toast('Profile Cast Successfully Updated', 'success');
        return redirect()->route('admin.profileCastsAll');
    }


    public function profileCastDelete(ProfileCast $cast)
    {
        menuSubmenu('marriageParameter', 'profileCastsAll');
        $cast->delete();
        cache()->flush();
        toast(
            'profile Cast Successfully Deleted',
            'success'
        );
        return redirect()->back();
    }

    // Profile Category Religion End



    // Profile Setting field Religion Start

    public function profileSettingFieldsAll()
    {
        menuSubmenu('marriageParameter', 'profileSettingFieldsAll');
        $data['fields'] = ProfileSettingField::orderBy('group_name')->orderBy('name')->paginate(30);
        return view('membership::admin.profileSettingFields.profileSettingFieldsAll', $data);
    }

    public function profileSettingFieldStore(Request $request)
    {

        menuSubmenu('marriageParameter', ' profileSettingFieldsAll');
        $request->validate([
            'name' => 'string|required',
        ]);

        $field = new ProfileSettingField();
        $field->name = $request->name;
        $field->group_name = $request->group_name;

        $field->multiple_value = $request->multiple_value ?  1 : 0;
        $field->addedby_id = Auth::id();
        $field->save();
        toast(
            'Profile Setting Field Successfully Created',
            'success'
        );
        return redirect()->back();
    }


    public function profileSettingFieldEdit(ProfileSettingField $field)
    {
        menuSubmenu('marriageParameter', 'profileSettingFieldsAll');
        return view('membership::admin.profileSettingFields.profileSettingFieldEdit', compact('field'));
    }


    public function profileSettingFieldUpdate(Request $request, ProfileSettingField $field)
    {
        menuSubmenu('marriageParameter', ' profileSettingFieldsAll');

        $request->validate([
            'name' => 'string|required',
        ]);

        $field->name = $request->name;
        $field->group_name = $request->group_name;
        $field->editedby_id = Auth::id();
        $field->active  = $request->active ?  1 : 0;
        $field->multiple_value = $request->multiple_value ?  1 : 0;
        $field->save();
        toast(
            'Profile Setting Field Successfully Updated',
            'success'
        );
        return redirect()->route('admin.profileSettingFieldsAll');
    }


    public function profileSettingFieldDelete(ProfileSettingField $field)
    {
        menuSubmenu('marriageParameter', 'profileSettingFieldsAll');
        $field->delete();
        cache()->flush();
        toast(
            'Profile Setting Field Successfully Deleted',
            'success'
        );
        return redirect()->back();
    }



    public function profileSettingValuesAll()
    {
        menuSubmenu('marriageParameter', 'profileSettingValuesAll');
        $data['values'] = ProfileSettingValue::latest()->paginate(30);
        $data['fields'] = ProfileSettingField::latest()->get();
        return view('membership::admin.profileSettingValues.profileSettingValuesAll', $data);
    }


    public function profileSettingValueStore(Request $request)
    {
        menuSubmenu('marriageParameter', ' profileSettingValuesAll');
        $request->validate([
            'name' => 'string|required',
            'profile_setting_field_id' => 'required',
        ]);

        $value = new ProfileSettingValue();
        $value->name = $request->name;
        $value->profile_setting_field_id = $request->profile_setting_field_id;
        $value->gender = $request->gender;
        $value->addedby_id = Auth::id();
        $value->save();
        toast('Profile Setting Value Successfully Created', 'success');
        return redirect()->back()->withInput();
    }


    public function profileSettingValueEdit(ProfileSettingValue $value)
    {
        menuSubmenu('marriageParameter', ' profileSettingValuesAll');
        $fields = ProfileSettingField::latest()->get();
        return view('membership::admin.profileSettingValues.profileSettingValueEdit', compact('value', 'fields'));
    }


    public function profileSettingValueUpdate(
        Request $request,
        ProfileSettingValue $value
    ) {
        menuSubmenu('marriageParameter', ' profileSettingValuesAll');
        $request->validate([
            'name' => 'string|required',
            'profile_setting_field_id' => 'required',
        ]);

        $value->name = $request->name;
        $value->profile_setting_field_id = $request->profile_setting_field_id;
        $value->gender = $request->gender;
        $value->editedby_id = Auth::id();
        $value->active  = $request->active ? 1 : 0;
        $value->save();
        toast('Profile Setting Value Successfully Updated', 'success');
        return redirect()->route('admin.profileSettingValuesAll');
    }


    public function profileSettingValueDelete(ProfileSettingValue $value)
    {
        menuSubmenu('marriageParameter', 'profileSettingValuesAll');
        $value->delete();
        cache()->flush();
        toast(
            'profile Setting Value Successfully Deleted',
            'success'
        );
        return redirect()->back();
    }

    // Profile Setting Field  End



    // Profile parameter  Start

    public function profileParametersAll()
    {
        menuSubmenu('marriageParameter', 'profileParametersAll');
        $data['parameters'] = ProfileParameter::groupBy('field_name')->orderBy('field_name')->get();
        return view('membership::admin.profileParameters.profileParametersAll', $data);
    }

    public function profileParameterStore(Request $request)
    {
        menuSubmenu('marriageParameter', 'profileParametersAll');
        $request->validate([
            'field_name' => 'string|required',
        ]);

        $parameter = new ProfileParameter();
        $parameter->field_name = str_replace(' ', '_', $request->field_name);
        $parameter->field_value = $request->field_value;
        $parameter->gender = $request->gender ?? null;
        $parameter->addedby_id = Auth::id();
        $parameter->save();
        toast('Profile Parameter Successfully Created', 'success');
        return redirect()->back()->withInput();
    }

    public function profileParameterEdit(ProfileParameter $parameter)
    {
        menuSubmenu('marriageParameter', 'profileParametersAll');
        $data['parameter'] = $parameter;
        return view('membership::admin.profileParameters.profileParameterEdit', $data);
    }


    public function profileParameterUpdate(Request $request, ProfileParameter $parameter)
    {
        menuSubmenu('marriageParameter', 'profileParametersAll');
        // dd($request->all());
        $parameter->field_value = $request->field_value;
        $parameter->gender = $request->gender ?  $request->gender  : null;
        $parameter->active  = $request->active ? 1 : 0;
        $parameter->editedby_id = Auth::id();
        $parameter->save();
        toast('Profile Parameter Successfully Updated', 'success');
        return redirect()->route('admin.profileParametersAll');
    }

    public function profileParameterDelete(ProfileParameter $parameter)
    {
        menuSubmenu('marriageParameter', 'profileParametersAll');
        $parameter->delete();
        cache()->flush();
        toast('profile Parameter Successfully Deleted', 'success');
        return redirect()->back();
    }

    // Profile parameter  end


    //Membership Package start 

    public function packagesAll()
    {
        menuSubmenu('membershipPackage', 'packagesAll');
        $data['packages'] = MembershipPackage::latest()->paginate(100);
        return view('membership::admin.membershipPackages.membershipPackagesAll', $data);
    }


    public function packageCreate()
    {
        menuSubmenu('membershipPackage', 'packageCreate');
        return view('membership::admin.membershipPackages.membershipPackageCreate');
    }


    public function packageStore(Request $request)
    {

        menuSubmenu('membershipPackage', 'packageCreate');
        $request->validate([
            'title' => 'string|required',
            'regular_price' => 'required',
            'duration' => 'required',
        ]);

        $package =  new MembershipPackage();
        $package->title = $request->title;
        $package->description = $request->description;
        $package->regular_price = $request->regular_price ?? 0;
        $package->discount = $request->discount ?? 0;
        $package->discount_price = (($request->discount / 100) * $request->regular_price) ?? 0;
        $package->final_price = ($request->regular_price - $package->discount_price);
        $package->duration = $request->duration ?? 0;
        $package->daily_contact_limit = $request->daily_contact_limit ?? 0;
        $package->total_contact_limit = $request->total_contact_limit ?? 0;
        $package->daily_proposal_sent = $request->daily_proposal_sent ?? 0;
        $package->total_proposal_sent = $request->total_proposal_sent ?? 0;
        $package->daily_cv_collect_limit = $request->daily_cv_collect_limit ?? 0;
        $package->total_cv_collect_limit = $request->total_cv_collect_limit ?? 0;
        $package->daily_matched_profile_sent = $request->daily_matched_profile_sent ?? 0;
        $package->total_matched_profile_sent = $request->total_matched_profile_sent ?? 0;
        $package->addedby_id = Auth::id();

        if ($request->hasFile('img_name')) {
            $file = $request->img_name;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = time() . $ext;
            Storage::disk('public')->put('membership_package_images/' . $imageName, File::get($file));
            $package->img_name = $imageName;
        }

        $package->save();
        cache()->flush();
        toast('Package Successfully Created', 'success');
        return redirect()->back();
    }


    public function packageEdit(MembershipPackage $package)
    {
        menuSubmenu('membershipPackage', 'packageCreate');
        $data['package'] = $package;
        return view('membership::admin.membershipPackages.membershipPackageEdit', $data);
    }



    public function packageUpdate(Request $request, MembershipPackage $package)
    {
        menuSubmenu('membershipPackage', 'packageCreate');
        $request->validate([
            'title' => 'string|required',
        ]);

        $package->title = $request->title;
        $package->description = $request->description;
        $package->regular_price = $request->regular_price ?? 0;
        $package->discount = $request->discount ?? 0;
        $package->discount_price = (($request->discount / 100) * $request->regular_price) ?? 0;
        $package->final_price = ($request->regular_price - $package->discount_price);
        $package->duration = $request->duration ?? 0;
        $package->daily_contact_limit = $request->daily_contact_limit ?? 0;
        $package->total_contact_limit = $request->total_contact_limit ?? 0;
        $package->daily_proposal_sent = $request->daily_proposal_sent ?? 0;
        $package->total_proposal_sent = $request->total_proposal_sent ?? 0;
        $package->daily_cv_collect_limit = $request->daily_cv_collect_limit ?? 0;
        $package->total_cv_collect_limit = $request->total_cv_collect_limit ?? 0;
        $package->daily_matched_profile_sent = $request->daily_matched_profile_sent ?? 0;
        $package->total_matched_profile_sent = $request->total_matched_profile_sent ?? 0;
        $package->active  = $request->active ? 1 : 0;
        $package->featured  = $request->featured ? 1 : 0;
        $package->editedby_id = Auth::id();

        if ($request->hasFile('img_name')) {
            $old_file = 'membership_package_images/' . $package->img_name;
            if (Storage::disk('public')->exists($old_file)) {
                Storage::disk('public')->delete($old_file);
            }
            $file = $request->img_name;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = time() . $ext;
            Storage::disk('public')->put('membership_package_images/' . $imageName, File::get($file));
            $package->img_name = $imageName;
        }

        $package->save();
        cache()->flush();
        toast('Package Successfully Updated', 'success');
        return redirect()->back();
    }

    public function packageDelete(MembershipPackage $package)
    {
        menuSubmenu('membershipPackage', 'packagesAll');
        $old_file = 'membership_package_images/' . $package->image;
        if (Storage::disk('public')->exists($old_file)) {
            Storage::disk('public')->delete($old_file);
        }
        $package->delete();
        cache()->flush();
        toast('Package Successfully Deleted', 'success');
        return redirect()->back();
    }

    public function pacakgeUpdateForAdmin(Request $request, User $user)
    {

        $up  = $user->profile;
        $up->package_id = $request->package_id;
        $up->duration = $up->duration + $request->duration;
        $up->daily_contact_limit = $up->daily_contact_limit + $request->daily_contact_limit;
        $up->total_contact_limit = $up->total_contact_limit + $request->total_contact_limit;
        $up->daily_cv_collect_limit = $up->daily_cv_collect_limit + $request->daily_cv_collect_limit;
        $up->total_cv_collect_limit = $up->total_cv_collect_limit + $request->total_cv_collect_limit;
        $up->daily_proposal_sent = $up->daily_proposal_sent + $request->daily_proposal_sent;
        $up->total_proposal_sent = $up->total_proposal_sent + $request->total_proposal_sent;
        $up->daily_matched_profile_sent = $up->daily_matched_profile_sent + $request->daily_matched_profile_sent;
        $up->total_matched_profile_sent = $up->total_matched_profile_sent + $request->total_matched_profile_sent;

        $up->save();
        toast('Package update successfully', 'success');
        return redirect()->back();
    }





    //Membership Package end


    //membership order start

    public function ordersAll(Request $request)
    {

        
        $type = $request->type;
        menuSubmenu('orders', 'ordersAll' . $type);
        if ($request->user_id) {
            $data['user'] = User::where('id', $request->user_id)->first();
            $data['orders'] = MembershipPackageOrder::where('user_id', $request->user_id)->paginate(10);
        } else {

            if ($type == 'ordersAll') {
               $data['orders'] = MembershipPackageOrder::latest()->paginate(100);
            }     
            elseif ($type == 'paidOrders') {
                $data['orders'] = MembershipPackageOrder::where('order_status','delivered')->latest()->paginate(100);
               
            } elseif ($type == 'pendingOrders') {
                $data['orders'] = MembershipPackageOrder::where('order_status','pending')->latest()->paginate(100);
              
            } 
            elseif ($type == 'tryPayment') {
                $data['orders'] = MembershipPackageOrder::where('transaction_id','<>', null)->where('order_status','pending')->latest()->paginate(100);
              
            } 
        }

        return view('membership::admin.orders.ordersAll', $data);
    }


    public function orderDeatils(MembershipPackageOrder $order)
    {
        menuSubmenu('orders', 'ordersAll');
        return view('membership::admin.orders.orderDetails', compact('order'));
    }



    public function orderPayment(
        Request $request,
        MembershipPackageOrder $order
    ) {

        menuSubmenu('orders', 'ordersAll');
        $request->validate([
            'payment_date'   => 'required',
            'payment_method' => 'required',
            'paid_amount'     => 'required',
        ]);

        $payment = new  MembershipOrderPayment();
        $payment->user_id = $order->user_id;
        $payment->order_id = $order->id;
        $payment->package_id = $order->membership_package_id;
        $payment->note = $request->note;
        $payment->payment_status = $request->payment_status;
        $payment->payment_method = $request->payment_method;
        $payment->transaction_id = $request->transaction_id;
        $payment->previous_due = $order->due();
        $payment->paid_amount = $request->paid_amount;
        $payment->current_due = $payment->previous_due - $payment->paid_amount;
        $payment->payment_date = $request->payment_date;
        $payment->payment_status = 'paid';
        $payment->addedby_id =  Auth::id();
        $payment->save();

        if ($order->due() > 0.99) {
            $order->payment_status = 'partial';
        } else {
            $order->payment_status = 'paid';
        }
        $order->editedby_id == Auth::id();
        $order->save();

        toast('Order Payment Successfully', 'success');
        return redirect()->back();
    }

    public function orderStatus(Request $request, MembershipPackageOrder $order)
    {
        menuSubmenu('orders', 'ordersAll');
        if ($order->order_status == 'delivered') {
            toast('Order already delivered', 'warning');
            return redirect()->back();
        } else {
            if ($request->order_status == 'pending') {
                $order->order_status = $request->order_status;
                $order->save();
            } elseif ($request->order_status == 'delivered') {
                $order->order_status = $request->order_status;
                $order->save();
                $user = User::find($order->user_id);
                $up  = $user->profile;
                $up->package_id = $order->membership_package_id;
                $up->duration = $up->duration + $order->duration;

                $up->daily_contact_limit = $up->daily_contact_limit + $order->daily_contact_limit;

                $up->total_contact_limit = $up->total_contact_limit + $order->total_contact_limit;

                $up->daily_cv_collect_limit = $up->daily_cv_collect_limit + $order->daily_cv_collect_limit;

                $up->total_cv_collect_limit = $up->total_cv_collect_limit + $order->total_cv_collect_limit;

                $up->daily_proposal_sent = $up->daily_proposal_sent + $order->daily_proposal_sent;

                $up->total_proposal_sent = $up->total_proposal_sent + $order->total_proposal_sent;

                $up->daily_matched_profile_sent = $up->daily_matched_profile_sent + $order->daily_matched_profile_sent;

                $up->total_matched_profile_sent = $up->total_matched_profile_sent + $order->total_matched_profile_sent;

                $up->save();
            }

            toast('Order Status Change Successfully', 'success');
            return redirect()->back();
        }
    }

    public function orderDelete(MembershipPackageOrder $order)
    {
        $order->delete();
        toast('Order Successfully Deleted', 'success');
        return redirect()->back();
    }


    public function orderPrint(MembershipPackageOrder $order)
    {

        return view('membership::admin.orders.orderPrint', [
            'order' => $order,
        ]);
    }

    //membership order end


    public function userInfoUpdate(Request $request, User $user)
    {

        $validation = Validator::make(
            $request->all(),
            [
                'name'     => 'required|string',
                'mobile'    => 'required|unique:users,mobile,' . $user->id,
                'email'     => 'required|email|unique:users,email,' . $user->id,
                'gender' => ['required', 'string'],
                'profession' => 'required|string',
                'day' => 'required',
                'month' => 'required',
                'year' => 'required',
            ]
        );

        if ($validation->fails()) {
            toast('Please, fill-up all the fields correctly and try again', 'error');
            return back()
                ->with('warning', 'Please, fill-up all the fields correctly and try again')
                ->withInput()
                ->withErrors($validation);
        }

        $dob = $request->year . '-' . $request->month . '-' . $request->day;

        $user->name = $request->name ?? Auth::user()->name;
        $user->mobile = $request->mobile ?? Auth::user()->mobile;
        $user->email = $request->email ?? Auth::user()->email;
        $user->dob =  Date($dob) ?? Auth::user()->dob;
        $user->gender = $request->gender ??  Auth::user()->gender;
        $user->profession = $request->profession ?? Auth::user()->profession;
        $user->save();

        $up = $user->profile;
        $up->dob =  $user->dob;
        $up->gender =  $user->gender;
        $up->profession = $user->profession;
        $up->save();

        

        toast('User information successfully updated', 'success');
        return redirect()->back();
    }




     public function userSettingProfilePicChange(Request $request, User $user)
    {
        $validation = Validator::make($request->all(),
            ['profile_picture' => 'required|image|mimes:jpeg,bmp,png,gif,jpg|dimensions:min_width=160,min_height=160'
        ]);
        if($validation->fails())
        {
            if($request->ajax())
            {
              return Response()->json(View('membership::admin.users.ajax.userProfilePic', ['user' => $user])
                ->render());
            }

           
            return redirect()->back()
            ->withErrors($validation)
            ->withInput()
            ->with('error', 'image must be at least 160px width and 160px height');
        }

        if($request->hasFile('profile_picture'))
        {
            $f = 'photo/' . $user->img_name;
            if (Storage::disk('public')->exists($f)) {
                Storage::disk('public')->delete($f);
            }

            $cp = $request->file('profile_picture');
            $extension = strtolower($cp->getClientOriginalExtension());


            $randomFileName = $user->id . '_fi_' . date('Y_m_d_his') . '_' . rand(10000000, 99999999) . '.' . $extension;



            Storage::disk('public')->put('photo/' . $randomFileName, File::get($cp));

            $user->img_name = $randomFileName;
            $user->save();



            if($request->ajax())
            {
          
              return Response()->json(View('membership::admin.partials.userProfilePic', ['user' => $user])
                ->render());
          }
      }
      return back();
    }





    public function marriageInfoPost(Request $request, User $user)
    {

        $validation = Validator::make(
            $request->all(),
            [
                'marital_status' => 'required',
                'religion_id' => 'required',
                // 'profession' => 'required',
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
                'will_job_after_marriage' => 'nullable',

            ]
        );

        if ($validation->fails()) {
            toast('Please submit your data correctly', 'error');
            return back()->withInput()->withErrors($validation)->with('card-open', 'card-open');
        }



        $mi = $user->profile;
        $mi->marital_status = $request->marital_status ?: null;
        $mi->religion_id = $request->religion_id ?: null;
        $mi->cast_id = $request->cast_id ?: null;
        $mi->education_level = $request->education_level ?: null;
        // $mi->profession = $request->profession ?: null;
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
        $mi->checked = $request->checked ? 1 : 0;
        $mi->family_info_checked = $request->family_info_checked ? 1 : 0;
        $mi->education_info_checked = $request->education_info_checked ? 1 : 0;
        $mi->partner_info_checked = $request->partner_info_checked ? 1 : 0;
        $mi->submit_by_user = $request->submit_by_user ? 1 : 0;

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


        $mi->save();



        $user->profileCategories()->detach();
        $user->profileCategories()->attach($request->categories);
        $user->profileSubcategories()->detach();


        if ($request->subcategories) {
            foreach ($request->subcategories as $subcat) {
                $sc = ProfileSubcat::where('profile_subcategory_id', $subcat)->where('user_id', $user->id)->first();
                if (!$sc) {
                    $sc = new ProfileSubcat;
                    $sc->profile_subcategory_id = $subcat;
                    $sc->user_id = $user->id;
                    $sc->addedby_id = Auth::id();
                    $sc->save();

                    $subcategory = ProfileSubcategory::find($subcat);


                    $category = $subcategory->profileCategory;



                    $c = ProfileCat::where('profile_category_id', $category->id)->where('user_id', $user->id)->first();




                    if (!$c) {
                        $c = new ProfileCat();
                        $c->profile_category_id = $category->id;
                        $c->user_id = $user->id;
                        $c->addedby_id = Auth::id();
                        $c->save();
                    }
                }
            }
        }

        if ($mi->checked == 1) {
            $user->adminApprovedProfile();
        }

        toast('একাউন্টের প্রোফাইল ইনফরমেশন সফলভাবে আপডেট হয়েছে!', 'success');
        return redirect()->back();
    }




    public function newProfileEducationStore(Request $request, User $user)
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

        toast('শিক্ষার তথ্যসহ একটি তথ্য সারি তৈরি হয়েছে। আরো তথ্য যুক্ত করতে একই রকমভাবে চেষ্টা করুন!', 'success');
        return redirect()->back();
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

        toast('শিক্ষার তথ্যসহ আপডেট হয়েছে!', 'success');
        return redirect()->back();
    }

    public function newProfileEducationDelete(UserEducationRecord $edu)
    {
        $edu->delete();
        toast('শিক্ষার তথ্যসহ ডিলিট করা হয়েছে!', 'success');
        return redirect()->back();
    }


    public function newUserProfileCreate(User $user)
    {
        $up = new UserProfile();
        $up->user_id = $user->id;
        $up->dob = $user->dob;
        $up->profession = $user->profession;
        $up->gender = $user->gender;
        $up->save();

        $us = new UserSearchTerm();
        $us->user_id = $user->id;
        $us->save();
        toast('নতুন ইউজার প্রোফাইল তৈরি করা হয়েছে!', 'success');
        return redirect()->back();
    }


    public function relativeInfoStore(Request $request, User $user)
    {

        $validation = Validator::make(
            $request->all(),
            [

                'name' => 'required|min:1|max:200',
                'details' => 'required|min:1|max:255',
                'relation_with_user' => 'required|min:1|max:255',
                'working_role' => 'required|min:1|max:255',
                'org_name' => 'nullable|min:2|max:255',

            ]
        );

        if ($validation->fails()) {
            toast('Please submit your data correctly', 'error');
            return back()->withInput()->withErrors($validation)->with('card-open', 'card-open');
        }


        $rel = new UserRelative();
        $rel->user_id = $user->id;
        $rel->relation_with_user = $request->relation_with_user;
        $rel->name = $request->name;
        $rel->working_role = $request->working_role;
        $rel->org_name = $request->org_name;
        $rel->details = $request->details;
        $rel->addedby_id = Auth::id();
        $rel->save();


        toast('আত্মীয়র তথ্যসহ একটি তথ্য সারি তৈরি হয়েছে। আরো তথ্য যুক্ত করতে একই রকমভাবে চেষ্টা করুন!', 'success');
        return redirect()->back();
    }


    public function relativeInfoUpdate(Request $request)
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


        toast('আত্মীয়র তথ্যসহ আপডেট হয়েছে!', 'success');
        return redirect()->back();
    }

    public function relativeInfoDelete(UserRelative $relative)
    {
        $relative->delete();
        toast('আত্মীয়র তথ্যসহ ডিলিট করা হয়েছে!', 'success');
        return redirect()->back();
    }


    public function newUserPartnerPreference(User $user)
    {
        $up = new UserSearchTerm();
        $up->user_id = $user->id;
        $up->save();
        toast('নতুন পার্টনার প্রেফারেন্স তৈরি করা হয়েছে!', 'success');
        return redirect()->back();
    }


    public function partnerPreferenceInfoStore(Request $request, User $user)
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
                "a_religion_id" => 'required',
                "languages" => 'required',
            ]
        );



        if ($validation->fails()) {

            toast('Please submit your data correctly', 'error');
            return back()->withInput()->withErrors($validation)->with('card-open', 'card-open');
        }


        $pp = $user->partnerPreference;

        $pp->min_age = $request->min_age;
        $pp->max_age = $request->max_age;
        $pp->min_height = $request->min_height;
        $pp->max_height = $request->max_height;
        $pp->min_weight = $request->min_weight;
        $pp->max_weight = $request->max_weight;
        $pp->religion_id = $request->a_religion_id;
        $pp->cast_id = $request->a_cast_id;
        $pp->user_id = $user->id;

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


        if ($request->maritals_status) {
            $pp->marital_status = implode(', ', $request->maritals_status);
        } else {
            $pp->marital_status = null;
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

        toast('পাত্র/পাত্রী সম্পর্কে আপনার চাওয়াগুলো আপডেট করা হয়েছে!', 'success');
        return Redirect()->back();
    }


    public function newProfileEducationEdit(Request $request)
    {
        $edu = UserEducationRecord::find($request->q);
        return response()->json([
            'success' => true,
            'edu' =>  $edu
        ]);
    }


    public function relativeInfoEdit(Request $request)
    {
        $relative = UserRelative::find($request->q);
        return response()->json([
            'success' => true,
            'relative' =>  $relative
        ]);
    }


    public function userAction(Request $request)
    {
        $action = $request->action;
        $user = User::withoutGlobalScopes()->where('id', request()->user)->firstOrFail();

        if ($action == 'passwordUpdate') {
            $validation = Validator::make(
                $request->all(),
                [
                    'new_password' => 'required|min:8'
                ]
            );

            if ($validation->fails()) {
                if ($request->ajax()) {
                    return Response()->json(array(
                        'success' => false,
                        'errors' => $validation->errors()->toArray(),
                        'sessionMessage' => 'Something went wrong! Try again'
                    ));
                }

                return back()
                    ->withInput()
                    ->withErrors($validation);
            }

            $user->password_temp = $request->new_password;
            $user->password = Hash::make($request->new_password);
            $user->editedby_id = Auth::id();
            $user->save();

            if ($request->ajax()) {
                return Response()->json([
                    'success' => true,
                    'sessionMessage' => "New temporary password set for {$user->mobile}",
                ]);
            }

            return back()->with('success', "New temporary password set for {$user->mobile}");
        }
    }


    public function userCvPictures()
    {
        menuSubmenu('users', 'userCvPictures');
        $data['userCvPictures']  = UserCvPicture::latest()->paginate(100);
        return view('membership::admin.users.userCvPictures', $data);
    }


    public function createCvPictureProfileStore(Request $request, UserCvPicture $picture)
    {
        $profile = $picture->userProfile;
        if (!$profile) {
            $up = new UserProfile();
            $up->user_id = $picture->user_id;
            $up->gender   = $picture->gender;
            $up->profile_pic = $picture->profile_pic;
            $up->extra_pic_first = $picture->extra_pic_first;
            $up->extra_pic_second = $picture->extra_pic_second;
            $up->extra_pic_third = $picture->extra_pic_third;
            $up->addedby_id = Auth::id();
            $up->save();

            $pp = new UserSearchTerm();
            $pp->user_id = $up->user_id;
            $pp->addedby_id = Auth::id();
            $pp->save();
        }

        return back();
    }
}