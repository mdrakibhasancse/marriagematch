<?php

namespace Cp\Frontend\Controllers;


use App\Http\Controllers\Controller;
use Cp\BlogPost\Models\BlogCategory;
use Cp\BlogPost\Models\BlogPost;
use Cp\Frontend\Models\ContactUs;
use Cp\Menupage\Models\Page;
use Cp\Slider\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Agent;
use Cp\Membership\Models\MembershipPackage;
use Cp\SuccessStory\Models\SuccessStory;
use Cp\Admin\Models\Language;
use Cp\Admin\Models\LanguageTranslation;
use Session;
use Config;

class FrontendController extends Controller
{
    public function welcome()
    {

        if(Session::has('locale')){
            $locale = Session::get('locale',Config::get('app.locale'));
        }
        else{
            $locale = env('DEFAULT_LANGUAGE');
        }
        $data['stories'] = SuccessStory::whereLocale('title', $locale)->whereActive(true)->whereFeatured(true)->where('story_type', 'story')->latest()->take(4)->get();

        $data['testimonials'] = SuccessStory::whereLocale('title', $locale)->whereActive(true)->whereFeatured(true)->where('story_type', 'testimonial')->latest()->take(4)->get();
        $data['packages'] = MembershipPackage::latest()->whereActive(true)->whereFeatured(true)->take(4)->get();
        
        return view('frontend::welcome.welcome', $data);

        if (Agent::isMobile()) {
            return view('frontend::mobile.welcome');
        } else {
            return view('frontend::welcome.welcome');
        }
    }



    public function blog()
    {

        if(Session::has('locale')){
            $locale = Session::get('locale',Config::get('app.locale'));
        }
        else{
            $locale = env('DEFAULT_LANGUAGE');
        }


        $data['latest_posts'] = BlogPost::whereLocale('title', $locale)->whereActive(true)->whereStatus('published')->take(4)->latest()->get();

        $data['cats'] = $cats = BlogCategory::whereActive(true)->orderBy('name')->get();

        $data['recent_posts'] = BlogPost::latest()->whereLocale('title', $locale)->whereActive(true)->whereStatus('published')->latest()->take(6)->get();

        $data['featured_posts'] = BlogPost::latest()->whereLocale('title', $locale)->whereActive(true)->whereStatus('published')->where('featured_slider', 1)->take(3)->get();

        $data['popular_posts'] =  BlogPost::orderBy('view_count', 'DESC')->whereActive(true)->whereStatus('published')->whereLocale('title', $locale)->take(6)->get();
       

        return view('frontend::welcome.blog', $data);
    }


    public function singlePost($id)
    {
        if(Session::has('locale')){
            $locale = Session::get('locale',Config::get('app.locale'));
        }
        else{
            $locale = env('DEFAULT_LANGUAGE');
        }
        BlogPost::find($id)->increment('view_count');
        $post = BlogPost::with('files')->find($id);
        $postCategories = $post->blogCategories->pluck('id');
        $postIds = DB::table('blog_category_posts')->whereIn('blog_category_id', $postCategories)->take(8)->pluck('blog_post_id');

        $data['relatedPosts'] = BlogPost::whereLocale('title', $locale)->find($postIds);
        $data['post'] = $post;

        $data['popular_posts'] =  BlogPost::orderBy('view_count', 'DESC')->whereActive(true)->whereStatus('published')->whereLocale('title', $locale)->take(6)->get();

        return view('frontend::welcome.singlePost', $data);
    }




    public function lazyloadContent(Request $request)
    {
        $data['front_sliders'] = Slider::whereActive(true)->take(5)->get();
        $carouselContainer = view('frontend::welcome.includes.carouselContent', $data)->render();

        $homepageContainer = view('frontend::welcome.includes.homepageContent', $data)->render();

        return response()->json([
            'carouselContainer' => $carouselContainer,
            'homepageContainer' => $homepageContainer
        ]);
    }


    public function page($id)
    {
        $data['page'] = Page::whereActive(true)->find($id);
        return view('frontend::welcome.page', $data);
    }


    public function contactUs(Request $request)
    {


        $request->validate([
            'full_name' => 'required',
            'email'     => 'required',
            'subject'   => 'required',
            'number'    => 'required',
            'message'   => 'required',
        ]);

        $contactUs = new ContactUs();
        $contactUs->full_name  = $request->full_name;
        $contactUs->email      = $request->email;
        $contactUs->subject    = $request->subject;
        $contactUs->number     = $request->number;
        $contactUs->message    = $request->message;
        $contactUs->addedBy_id = Auth::id();
        $contactUs->save();


        toast('Success', 'success');
        return redirect()->back();
    }


    public function languageUpdateStatus(Language $language){

        request()->session()->put('locale', $language->language_code);
        $translate = 'Language Changed successfully';
        $success = 'success';
        // toast($translate, $success);
        return back();

    }



    public function NilofaMarriageMedia(){
        $data['page'] = Page::whereActive(true)->where('id' , 7)->first();
        return view('frontend::welcome.NilofaMarriageMedia',$data);
    }
}