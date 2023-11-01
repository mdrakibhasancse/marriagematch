<?php

namespace Cp\JobPost\Controllers;


use App\Http\Controllers\Controller;
use Cp\Media\Models\Media;
use Cp\JobPost\Models\JobPost;
use Cp\JobPost\Models\JobPostCv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class AdminJobPostController extends Controller
{

    public function jobPostsAll()
    {
        menuSubmenu('jobPost', 'jobPostsAll');
        $data['jobPosts'] = $jobPosts = JobPost::latest()->paginate(30);
        return view('jobpost::admin.jobPosts.jobPostsAll', $data);
    }


    public function  jobPostCreate()
    {
        menuSubmenu('jobPost', 'jobPostsAll');
        $data['medias'] = Media::latest()->paginate(20);
        return view('jobpost::admin.jobPosts.jobPostCreate', $data);
    }




    public function jobPostStore(Request $request)
    {
        menuSubmenu('jobPost', 'jobPostsAll');

        $this->validate($request, [
            'title' => 'required|string',
            'excerpt' => 'required|string',
            'description' => 'required|string',
            'feature_image' => 'nullable|image|mimes:jpeg,webp,jpg,png',
            'designation' => 'required',
            'published_date' => 'required',
            'expired_date' => 'required',
        ]);



        $jobPost = new JobPost();
        $jobPost->title = $request->title;
        $jobPost->excerpt = $request->excerpt;
        $jobPost->description = $request->description;
        $jobPost->active = $request->active ?? 0;
        $jobPost->editor = $request->editor ?? 0;
        $jobPost->salary = $request->salary;
        $jobPost->published_date = $request->published_date;
        $jobPost->expired_date = $request->expired_date;
        $jobPost->designation = $request->designation;
        $jobPost->addedby_id = Auth::id();
        if ($request->hasFile('featured_image')) {
            $file = $request->featured_image;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = time() . $ext;
            Storage::disk('public')->put('job_post_images/' . $imageName, File::get($file));
            $jobPost->featured_image = $imageName;
        }
        $jobPost->save();
        cache()->flush();
        toast('Job Post Create Successfully', 'success');
        return redirect()->back();
    }






    public function jobPostEdit(JobPost $jobPost)
    {
        menuSubmenu('jobPost', 'jobPostsAll');
        $data['jobPost'] =  $jobPost;
        $data['medias'] = Media::latest()->paginate(20);
        return view('jobpost::admin.jobPosts.jobPostEdit', $data);
    }


    public function jobPostUpdate(Request $request, JobPost $jobPost)
    {
        menuSubmenu('jobPost', 'jobPostsAll');
        $this->validate($request, [
            'title' => 'required|string',
            'excerpt' => 'required|string',
            'description' => 'required|string',
            'feature_image' => 'nullable|image|mimes:jpeg,webp,jpg,png',
            'designation' => 'required',
            'published_date' => 'required',
            'expired_date' => 'required',
        ]);



        $jobPost->title = $request->title;
        $jobPost->excerpt = $request->excerpt;
        $jobPost->description = $request->description;
        $jobPost->active = $request->active ?? 0;
        $jobPost->editor = $request->editor ?? 0;
        $jobPost->salary = $request->salary;
        $jobPost->published_date = $request->published_date;
        $jobPost->expired_date = $request->expired_date;
        $jobPost->designation = $request->designation;
        $jobPost->editedby_id = Auth::id();
        if ($request->hasFile('featured_image')) {
            $old_file = 'job_post_images/' . $jobPost->featured_image;
            if (Storage::disk('public')->exists($old_file)) {
                Storage::disk('public')->delete($old_file);
            }
            $file = $request->featured_image;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = time() . $ext;
            Storage::disk('public')->put('job_post_images/' . $imageName, File::get($file));
            $jobPost->featured_image = $imageName;
        }

        $jobPost->save();

        toast('Job Post successfully updated', 'success');
        return redirect()->back();
    }



    public function jobPostDelete(JobPost $jobPost)
    {
        menuSubmenu('jobPost', 'jobPostsAll');
        $old_file = 'job_post_images/' . $jobPost->featured_image;
        if (Storage::disk('public')->exists($old_file)) {
            Storage::disk('public')->delete($old_file);
        }
        $jobPost->delete();
        toast('Job Post successfully deleted', 'success');
        return redirect()->back();
    }


    public function jobPostActive(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('job_posts')->where('id', $request->id)->update(['active' => 1]);
        } else {
            DB::table('job_posts')->where('id', $request->id)->update(['active' => 0]);
        }
        return response()->json(['msg' => 'Status Successfully updated ', 'status' => true]);
    }

    public function dropAllCv(JobPost $jobPost)
    {
        menuSubmenu('jobPost', 'jobPostsAll');
        $data['dropCvs'] = $jobPost->jobPostCvs()->paginate(20);
        return view('jobpost::admin.jobPosts.jobPostCvs', $data);
    }

    public function dropCvDelete(JobPostCv $dropCv)
    {
        menuSubmenu('jobPost', 'jobPostsAll');
        $old_file = 'job_post_cvs/' . $dropCv->cv;
        if (Storage::disk('public')->exists($old_file)) {
            Storage::disk('public')->delete($old_file);
        }
        $dropCv->delete();
        toast('Job Post Cv successfully deleted', 'success');
        return redirect()->back();
    }
}
