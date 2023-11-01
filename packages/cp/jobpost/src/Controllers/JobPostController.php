<?php

namespace Cp\JobPost\Controllers;


use App\Http\Controllers\Controller;
use Cp\JobPost\Models\JobPost;
use Cp\JobPost\Models\JobPostCv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class JobPostController extends Controller
{
    public function career()
    {

        $data['jobPosts'] = JobPost::whereActive(true)->where('expired_date', '>=', date('Y-m-d'))->latest()->get();
        return view('frontend::welcome.career', $data);
    }

    public function applyForJop(JobPost $jobPost)
    {
        return view('frontend::welcome.applyForJob', compact('jobPost'));
    }

    public function applyForJopStore(Request $request)
    {

        $this->validate($request, [
            'cv' => 'required',
        ]);

        $jobPostCv = new JobPostCv();
        $jobPostCv->job_post_id = $request->job_post_id;
        $jobPostCv->addedby_id = Auth::id() ?? null;

        if ($request->hasFile('cv')) {
            $file = $request->cv;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = time() . $ext;
            Storage::disk('public')->put('job_post_cvs/' . $imageName, File::get($file));
            $jobPostCv->cv = $imageName;
        }
        $jobPostCv->save();
        cache()->flush();
        toast('File Successfully Submitted', 'success');
        return redirect()->back();
    }
}
