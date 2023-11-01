<?php

namespace Cp\SuccessStory\Controllers;

use Auth;
use App\Http\Controllers\Controller;
use Cp\SuccessStory\Models\SuccessStory;

class SuccessStoryController extends Controller
{
    public function viewStory($id)
    {
        $data['story'] = SuccessStory::whereActive(true)->find($id);
        return view('successstory::frontend.viewStory.viewStory', $data);
    }

    public function allStories()
    {
        $data['stories'] = SuccessStory::latest()->whereActive(true)->where('story_type', 'story')->simplePaginate(20);
        return view('successstory::frontend.story.allStories', $data);
    }

    public function allTestimonials()
    {
        $data['testimonials'] = SuccessStory::latest()->whereActive(true)->where('story_type', 'testimonial')->simplePaginate(20);
        return view('successstory::frontend.testimonial.allTestimonials', $data);
    }
}