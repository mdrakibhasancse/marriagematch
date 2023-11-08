<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Cp\Membership\Models\UserEducationRecord;
use Cp\Membership\Models\UserProfile;
use Cp\Membership\Models\UserVisit;
use Cp\Membership\Models\UserRelative;
use Cp\Membership\Models\UserSearchTerm;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;
use Cp\Membership\Models\MembershipPackage;
use Cp\Membership\Models\MembershipPackageOrder;
use Cp\Membership\Models\ProfileCategory;
use Cp\Membership\Models\ProfileSubcategory;
use Cp\Membership\Models\UserContact;
use Cp\Membership\Models\UserCvPicture;
use Cp\Membership\Models\UserFavourite;
use Cp\Membership\Models\UserMessage;
use Cp\Membership\Models\UserProposal;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'password',
        'password_temp',
        'gender',
        'profession',
        'dob',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function fi()
    {

        if ($this->profile and !$this->profile->photo_hide) {
            if ($this->gender == 'male') {
                return $this->img_name ?: 'profileMale.jpg';
            } elseif ($this->gender == 'female') {
                return $this->img_name ?: 'profileFemale.jpg';
            }
        }

        if ($this->profile and $this->profile->photo_hide) {
            if ($this->gender == 'male') {
                return  'profileMale.jpg';
            } elseif ($this->gender == 'female') {
                return  'profileFemale.jpg';
            }
        }

        if ($this->profile) {

            if ($this->profile->gender == 'female') {
                return $this->img_name ?: 'profileMale.jpg';
            } else {
                return $this->img_name ?: 'profileFemale.jpg';
            }
        }

        if (!$this->profile) {
            if ($this->gender == 'female') {
                return 'profileFemale.jpg';
            } else {
                return 'profileMale.jpg';
            }
        }
    }


    public function profile()
    {
        return $this->hasOne(UserProfile::class, 'user_id', 'id');
    }

    public function userRelativeRecords()
    {
        return $this->hasMany(UserRelative::class);
    }


    public function userEducationRecords()
    {
        return $this->hasMany(UserEducationRecord::class);
    }

    public function partnerPreference()
    {
        return $this->hasOne(UserSearchTerm::class, 'user_id');
    }


    public function age()
    {
        if ($this->dob) {
            return Carbon::parse($this->dob)->diffInYears(Carbon::now());
        } elseif ($this->profile && $this->profile->dob) {
            return Carbon::parse($this->profile->dob)->diffInYears(Carbon::now());
        } else {
            return null;
        }
    }

    public function myProfession()
    {
        if ($this->profession) {
            return $this->profession;
        } elseif ($this->profile && $this->profile->profession) {
            return $this->profile->profession;
        } else {
            return null;
        }
    }

    public function myGender()
    {
        if ($this->gender) {
            return $this->gender;
        } elseif ($this->profile && $this->profile->gender) {
            return $this->profile->gender;
        } else {
            return null;
        }
    }


    


    public function cvPic()
    {
        return $this->hasOne(UserCvPicture::class);
    }


    function visitorUsers()
    {
        return $this->belongsToMany(User::class, 'user_visits', 'user_second_id', 'user_id');
    }

    function visitedUsers()
    {
        return $this->belongsToMany(User::class, 'user_visits', 'user_id', 'user_second_id');
    }

    function visitedProfiles()
    {
        return $this->hasMany(UserVisit::class, 'user_id');
    }


    function profileNewVisit($user_id)
    {
        if ($this->id != $user_id) {
            $a = $this->visitedProfiles()->where('user_second_id', $user_id)->first();
            if ($a) {
                $a->increment('visit_count');
            } else {
                $a = new UserVisit;
                $a->user_id = $this->id;
                $a->user_second_id = $user_id;
                $a->visit_count = 1;
                $a->save();
            }
        }

        return true;
    }



    function visitors()
    {
        return $this->hasMany(UserVisit::class, 'user_second_id');
    }


    function favourites()
    {
        return $this->hasMany(UserFavourite::class);
    }

    function favouriteUs()
    {
        return $this->hasMany(UserFavourite::class, 'user_second_id');
    }

    function isMyFavourite($user_id)
    {
        return (bool) $this->favourites()->where('user_second_id', $user_id)->first();
    }

    /**
     * The roles that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favouriteUsers()
    {
        return $this->belongsToMany(User::class, 'user_favourites', 'user_id', 'user_second_id');
    }


    function contacts()
    {
        return $this->hasMany(UserContact::class);
    }

    function contacteds()
    {
        return $this->hasMany(UserContact::class, 'user_second_id');
    }

    function isMyContact($user_id)
    {
        return (bool) $this->contacts()->where('user_second_id', $user_id)->first();
    }



    public function HasContactLimit()
    {
        if ((UserContact::where('user_id', $this->id)->whereDate('created_at', now()->today()->toDateString())->count() < $this->profile->daily_contact_limit)) {
            if ((UserContact::where('user_id', $this->id)->count() < $this->profile->total_contact_limit)) {
                return true;
            }
        }
        return false;
    }

    function isAlreadyContactOf($user)
    {
        return (bool) UserContact::where('user_id', $this->id)->where('user_second_id', $user->id)->count();
    }



    public function contactUsers()
    {
        return $this->belongsToMany(User::class, 'user_contacts', 'user_id', 'user_second_id');
    }


    public function profileCategories()
    {
        return $this->belongsToMany(ProfileCategory::class, 'profile_cats');
    }

    public function profileSubcategories()
    {
        return $this->belongsToMany(ProfileSubcategory::class, 'profile_subcats', Null, 'profile_subcategory_id');
    }

    public function packages()
    {
        return $this->hasMany(MembershipPackage::class, 'user_id', 'id');
    }

    public function packageOrders()
    {
        return $this->hasMany(MembershipPackageOrder::class, 'user_id', 'id');
    }

    function altGender()
    {
        if ($this->gender == 'male') {
            return 'female';
        }
        return 'male';
    }

    function proposals()
    {
        return $this->hasMany(UserProposal::class);
    }

    function proposalstoUs()
    {
        return $this->hasMany(UserProposal::class, 'user_to_id');
    }


    public function penedingPropsalsFromMe()
    {
        return $this->belongsToMany(User::class, 'user_proposals', 'user_id', 'user_to_id');
    }

    public function penedingPropsalsToMe()
    {
        return $this->belongsToMany(User::class, 'user_proposals', 'user_to_id', 'user_id');
    }


    public function isConnectedWithMe()
    {
        return (bool) UserProposal::where('accepted_at', '<>', null)->where(function ($qq) {
            $qq->where([
                'user_id' => Auth::id(),
                'user_to_id' => $this->id,

            ]);
        })
            ->orWhere(function ($qqq) {
                $qqq->where([
                    'user_id' => $this->id,
                    'user_to_id' => Auth::id(),
                ]);
            })
            ->count();
    }


    public function hasPendingProposalToMe()
    {
        return  UserProposal::where('accepted_at', null)
            ->where([
                'user_id' => $this->id,
                'user_to_id' => Auth::id(),
            ])
            ->first();
    }

    public function hasPendingProposalFromMe()
    {
        return  UserProposal::where('accepted_at', null)
            ->where([
                'user_id' => Auth::id(),
                'user_to_id' => $this->id,
            ])
            ->first();
    }


    function isMyProfosal($user_id)
    {
        return (bool) $this->proposals()->where('user_to_id', $user_id)->first();
    }


    public function hasProposalLimit()
    {
        if ((UserProposal::where('user_id', $this->id)->whereDate('created_at', now()->today()->toDateString())->count() < $this->profile->daily_proposal_sent)) {

            if ((UserProposal::where('user_id', $this->id)->count() < $this->profile->total_proposal_sent)) {
                return true;
            }
        }
        return false;
    }


    public function messageFromMe()
    {
        return $this->belongsToMany(User::class, 'user_messages', 'userfrom_id', 'userto_id');
    }




    public function latestMsgUser()
    {
        $msg = UserMessage::where('last', 1)
            ->where(function ($f) {
                $f->where('userfrom_id', $this->id);
                $f->orWhere('userto_id', $this->id);
            })
            ->orderBy('id', 'desc')
            ->first();


        if ($msg) {
            if ($msg->userfrom_id != $this->id) {
                $user = User::where('id', $msg->userfrom_id)->first();
            } else {
                $user = User::where('id', $msg->userto_id)->first();
            }
        } else {
            $user = null;
        }

        return $user;
    }

    public function readMsgOf($user)
    {
        if ($user) {
            UserMessage::where([
                ['userto_id', '=', $this->id],
                ['userfrom_id', '=',  $user->id]
            ])->update(['read' => 1]);
        }
    }

    public function unreadMsgUsersCount()
    {
        return UserMessage::where('userto_id', $this->id)
            ->where('read', 0)->where('last', 1)->count();
    }


    public function messageWithUser($userto)
    {
        $messages = UserMessage::where([
            ['userto_id', '=', $userto->id],
            ['userfrom_id', '=',  $this->id]
        ])->orWhere([
            ['userto_id', '=', $this->id],
            ['userfrom_id', '=',  $userto->id]
        ])

            ->paginate(100);

        return $messages;
    }

    public function messageContacts()
    {
        $contacts = UserMessage::where('last', 1)
            ->where(function ($f) {
                $f->where('userfrom_id', $this->id);
                $f->orWhere('userto_id', $this->id);
            })
            ->orderBy('id', 'desc')
            ->paginate(100);
        return $contacts;
    }




    public function welcomeEmailSend()
    {
        Mail::send('frontend::emails.welcomeNewUser', ['user' => $this], function ($message) {
            $message->to($this->email, $this->name)
                ->subject('Registration Successful.Create new proffile | Marriage Match BD.');
        });
        return true;
    }


    public function welcomeNewUserToAdmin($user)
    {
        Mail::send('frontend::emails.welcomeNewUserToAdmin', ['user' => $user], function ($message) {

            $message->to($this->email, $this->name)
                ->subject('A new user registration completed | Marriage Match BD.');
        });
        return true;
    }



    public function approvedProfileEmailSent()
    {
        Mail::send('frontend::emails.approvedProfileEmailSent', ['user' => $this], function ($message) {
            $message->to($this->email, $this->name)
                ->subject('প্রোফাইল সাবমিট করা হয়েছে । দায়া করে এপ্রুভের জন্য অপেক্ষা করুন | Marriage Match BD');
        });
        return true;
    }



    public function approvedProfileToAdmin($user)
    {
        Mail::send('frontend::emails.approvedProfileToAdmin', ['user' => $user], function ($message) {

            $message->to($this->email, $this->name)
                ->subject('প্রোফাইল এপ্রুভের জন্য সাবমিট করা হয়েছে ।
                 Marriage Match BD');
        });
        return true;
    }


    public function adminApprovedProfile()
    {
        Mail::send('frontend::emails.adminApprovedProfile', ['user' => $this], function ($message) {
            $message->to($this->email, $this->name)
                ->subject('আপনার প্রোফাইলটি লাইভ করা হয়েছে । Marriage Match BD');
        });
        return true;
    }


    public function orderSubmissionEmailSend($order)
    {
        Mail::send('frontend::emails.orders.orderSubmissionSendToUser', ['user' => $this, 'order' => $order], function ($message) {

            $message->to($this->email, $this->name)
                ->subject('Order Successful submitted. | Marriage Match BD');
        });
        return true;
    }


    public function orderSubmissionSentToAdmin($order)
    {
        Mail::send('frontend::emails.orders.orderSubmissionSentToAdmin', ['user' => $this, 'order' => $order], function ($message) {

            $message->to($this->email, $this->name)
                ->subject('A new order is placed. | Marriage Match BD.');
        });
        return true; 
    }


    public function orderPaidEmailToUserSent($order)
    {
        Mail::send('frontend::emails.orders.orderPaidEmailToUserSent', ['user' => $this, 'order' => $order], function ($message) {

            $message->to($this->email, $this->name)
                ->subject('Order paid Successfully | Marriage Match BD');
        });
        return true;
    }


     public function orderPaidEmailToAdminSent($order)
    {
        Mail::send('frontend::emails.orders.orderPaidEmailToAdminSent', ['user' => $this, 'order' => $order], function ($message) {

            $message->to($this->email, $this->name)
                ->subject('New order is paid successfully. Please cheek. | Marriage Match BD');
        });
        return true;
    }

    public function myMatchedUsers()
    {
        $searchTerm = Auth::user()->partnerPreference;
      
        $users = User::whereHas('profile', function ($q) use ($searchTerm) {
            $q->where('checked', 1);
            $q->where('gender', Auth::user()->altGender());
            $minAgeDate = Carbon::now()->subYear($searchTerm->min_age)->toDateString();
            $q->where('dob', '<=', $minAgeDate);
    
            $maxAgeDate = Carbon::now()->subYear($searchTerm->max_age)->toDateString();
            $q->where('dob', '>=', $maxAgeDate);
    
            
            if($searchTerm->marital_status){
            $q->whereIn('marital_status',explode(',', $searchTerm->marital_status));
            }
            
            if($searchTerm->education_level){
            $q->whereIn('education_level', explode(',', $searchTerm->education_level));
            }

            if($searchTerm->profession){
            $q->whereIn('profession', explode(',', $searchTerm->profession));
            }

     
            if($searchTerm->language){
            $q->whereIn('language_one', explode(',', $searchTerm->language));
            }

            if($searchTerm->present_country){
            $q->whereIn('present_country', explode(',', $searchTerm->present_country));
            }

            if($searchTerm->birth_country){
            $q->whereIn('birth_country', explode(',', $searchTerm->birth_country));
            }

    
        })->orderBy('updated_at', 'desc')->paginate(20);
        return $users;


    }


    //match fuction
    public function ageMatched($user)
    {
   
      if ( in_array($this->age(), range($user->partnerPreference->min_age,$user->partnerPreference->max_age)))
      {
        return true;
      } 
      return false;
    }

    public function religionMatched($user)
    {
        
        if(($user->partnerPreference->religion_id == $this->profile->religion_id) && ($this->profile->cast_id == $user->partnerPreference->cast_id) )
        {
            return true;
        }
        return false;
    }

    public function maritalStatusMatched($user)
    {
        $marital_statuses = $user->partnerPreference->marital_status;
        if ( str_contains($marital_statuses, $this->profile->marital_status))
        {
            return true;
        }
        return false;
    }

    public function professionMatched($user)
    {
        $professions = $user->partnerPreference->profession;
        if ( str_contains($professions, $this->profile->profession))
        {
            return true;
        }
        return false;
    }
  
   

    public function languageMatched($user)
    {
        $languages = $user->partnerPreference->language;
        if ( str_contains($languages, $this->profile->language_one))
        {
            return true;
        }
        return false;
    }

    public function presentCountryMatched($user)
    {
        $countries = $user->partnerPreference->present_country;
        if ( str_contains($countries, $this->profile->present_country))
        {
            return true;
        }
        return false;
    }
    public function birthCountryMatched($user)
    {
        $countries = $user->partnerPreference->birth_country;
        if ( str_contains($countries, $this->profile->birth_country))
        {
            return true;
        }
        return false;
    }

    public function matchRate($user)
    {
        $a = 0;
        if($this->ageMatched($user))
        {
            $a = $a + 1;
        }
        if($this->religionMatched($user))
        {
            $a = $a + 1;
        }
        if($this->maritalStatusMatched($user))
        {
            $a = $a + 1;
        }
        if($this->professionMatched($user))
        {
            $a = $a + 1;
        }
        if($this->languageMatched($user))
        {
            $a = $a + 1;
        }
        if($this->presentCountryMatched($user))
        {
            $a = $a + 1;
        }
        if($this->birthCountryMatched($user))
        {
            $a = $a + 1;
        }

        return $a;
    }



  
 

}