<?php

namespace Cp\SuccessStory\Controllers;


use App\Http\Controllers\Controller;
use App\Models\User;
use Cp\Media\Models\Media;
use Cp\SuccessStory\Models\SuccessStory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class AdminSuccessStoryController extends Controller
{


    public function storiesAll()
    {
        menuSubmenu('story', 'storiesAll');
        $data['stories'] = $stories = successStory::where('story_type', 'story')->latest()->paginate(30);
        return view('successstory::admin.successStories.storiesAll', $data);
    }

    public function testimonialsAll()
    {
        menuSubmenu('story', 'testimonialsAll');
        $data['testimonials'] = $testimonials = successStory::where('story_type', 'testimonial')->latest()->paginate(30);
        return view('successstory::admin.successStories.testimonialsAll', $data);
    }



    public function  successStoryCreate()
    {
        menuSubmenu('story', 'storiesAll');
        $data['medias'] = Media::latest()->paginate(20);
        return view('successstory::admin.successStories.successStoryCreate', $data);
    }




    public function successStoryStore(Request $request)
    {
        menuSubmenu('story', 'storiesAll');

        $this->validate($request, [
            'title' => 'required|string',
            'story_type' => 'required',
            'excerpt' => 'nullable|string',
            'description' => 'nullable|string',
            'tags' => 'nullable',
            'feature_image' => 'nullable|image|mimes:jpeg,webp,jpg,png',
        ]);




        $story = new SuccessStory();
        $story->title = $request->title;
        $story->excerpt = $request->excerpt;
        $story->description = $request->description;
        $story->active = $request->active ?? 0;
        $story->editor = $request->editor ?? 0;
        $story->featured = $request->featured ?? 0;
        $story->story_type = $request->story_type;
        $story->addedby_id = Auth::id();
        if ($request->hasFile('featured_image')) {
            $file = $request->featured_image;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = time() . $ext;
            Storage::disk('public')->put('success_story_images/' . $imageName, File::get($file));
            $story->featured_image = $imageName;
        }


        $userMale = User::where('id', $request->male_user_id)->first();
        if ($userMale) {
            $story->male_user_id = $userMale ?? null;
        }

        $userFemale = User::where('id', $request->female_user_id)->first();
        if ($userFemale) {
            $story->female_user_id = $userFemale ?? null;
        }

        $story->save();

        toast('Story Create Successfully', 'success');
        return redirect()->back();
    }





    public function successStoryEdit(SuccessStory $story)
    {
        menuSubmenu('story', 'storiesAll');
        $data['story'] =  $story;
        $data['medias'] = Media::latest()->paginate(20);
        return view('successstory::admin.successStories.successStoryEdit', $data);
    }


    public function successStoryUpdate(Request $request, SuccessStory $story)
    {
        menuSubmenu('story', 'storiesAll');
        $this->validate($request, [
            'title' => 'required|string',
            'story_type' => 'required',
            'excerpt' => 'nullable|string',
            'description' => 'nullable|string',
            'feature_image' => 'nullable|image|mimes:jpeg,webp,jpg,png',
        ]);


        $story->title = $request->title;
        $story->excerpt = $request->excerpt;
        $story->description = $request->description;
        $story->active = $request->active ?? 0;
        $story->editor = $request->editor ?? 0;
        $story->featured = $request->featured ?? 0;
        $story->story_type = $request->story_type;
        $story->editedby_id = Auth::id();
        if ($request->hasFile('featured_image')) {
            $old_file = 'success_story_images/' . $story->featured_image;
            if (Storage::disk('public')->exists($old_file)) {
                Storage::disk('public')->delete($old_file);
            }
            $file = $request->featured_image;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = time() . $ext;
            Storage::disk('public')->put('success_story_images/' . $imageName, File::get($file));
            $story->featured_image = $imageName;
        }

        $story->save();

        toast('Story successfully updated', 'success');
        return redirect()->back();
    }



    public function successStoryDelete(SuccessStory $story)
    {
        menuSubmenu('story', 'storiesAll');
        $old_file = 'success_story_images/' . $story->featured_image;
        if (Storage::disk('public')->exists($old_file)) {
            Storage::disk('public')->delete($old_file);
        }
        $story->delete();
        toast('Story successfully deleted', 'success');
        return redirect()->back();
    }


    public function successStoryActive(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('success_stories')->where('id', $request->id)->update(['active' => 1]);
        } else {
            DB::table('success_stories')->where('id', $request->id)->update(['active' => 0]);
        }
        return response()->json(['msg' => 'Status Successfully updated ', 'status' => true]);
    }
}
