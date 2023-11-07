<?php

namespace Cp\BlogPost\Controllers;


use App\Http\Controllers\Controller;
use Cp\Media\Models\Media;
use Cp\BlogPost\Models\BlogPost;
use Cp\BlogPost\Models\BlogCategory;
use Cp\BlogPost\Models\BlogPostFile;
use Cp\BlogPost\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class AdminBlogPostController extends Controller
{
    public function blogCategoriesAll()
    {
        menuSubmenu('blogPost', 'blogCategoriesAll');
        $data['categories']  = BlogCategory::latest()->paginate(30);
        return view('blogpost::admin.blogCategories.blogCategoriesAll', $data);
    }


    public function blogCategoryCreate()
    {
        menuSubmenu('blogPost', 'blogCategoriesAll');
        return view('blogpost::admin.blogCategories.blogCategoryCreate');
      
    }


    public function blogCategoryStore(Request $request)
    {

        menuSubmenu('blogPost', 'blogCategoriesAll');
        $request->validate([
            'name' => 'string|required',

        ]);

        $category =  new BlogCategory();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->addedby_id = Auth::id();
        $category->save();
        cache()->flush();
        toast('Blog Category successfully Created', 'success');
        return redirect()->back();
    }


    public function blogCategoryEdit(BlogCategory $category)
    {
        menuSubmenu('blogPost', 'blogCategoriesAll');
        $data['category'] = $category;
        return view('blogpost::admin.blogCategories.blogCategoryEdit', $data);
    }




    public function blogCategoryUpdate(Request $request, BlogCategory $category)
    {
        menuSubmenu('blogPost', 'blogCategoriesAll');
        $request->validate([
            'name' => 'string|required',
        ]);
        $category->name        = $request->name;
        $category->slug = Str::slug($request->name);
        $category->active      = $request->active ?? 0;
        $category->editedby_id = Auth::id();
        $category->save();
        cache()->flush();
        toast('Blog Category successfully Updated', 'success');
        return redirect()->back();
    }

    public function blogCategoryDelete(BlogCategory $category)
    {
        menuSubmenu('blogPost', 'blogCategoriesAll');
        $category->delete();
        cache()->flush();
        toast('Blog Category successfully deleted', 'success');
        return redirect()->back();
    }


    public function blogCategoryActive(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('blog_categories')->where('id', $request->id)->update(['active' => 1]);
        } else {
            DB::table('blog_categories')->where('id', $request->id)->update(['active' => 0]);
        }
        return response()->json(['msg' => 'Status Successfully updated ', 'status' => true]);
    }





    public function blogPostsAll()
    {
        menuSubmenu('blogPost', 'blogPostsAll');
        $data['bolgPosts'] = $bolgPosts = BlogPost::latest()->paginate(30);
    //    dd( $data['bolgPosts']);
     
        return view('blogpost::admin.blogPosts.blogPostsAll', $data);
    }


   

    public function  blogPostCreate()
    {

        // $string = 'dfsfskd';
        
        //     if (ctype_alnum($string))
        //         dd("Yes");
        //     else
        //         dd("no");
 


    //    $posts = BlogPost::get();
    //    foreach ($posts as $post) {
    //       $post->title = $post->oldtitle;
    //       $post->oldtitle = null;
    //       $post->excerpt = $post->oldexcerpt;
    //       $post->oldexcerpt = null;
    //       $post->description = $post->olddescription;
    //       $post->olddescription = null;
    //       $post->save();
    //    }
    //    return back();
         
        menuSubmenu('blogPost', 'blogPostsAll');
        $data['categories'] = BlogCategory::latest()->get();
        $data['medias'] = Media::latest()->paginate(20);
        return view('blogpost::admin.blogPosts.blogPostCreate', $data);
    }




    public function blogPostStore(Request $request)
    {

    //    dd($request->all());
        menuSubmenu('blogPost', 'blogPostsAll');

        // $this->validate($request, [
        //     'title' => 'required|string',
        //     'excerpt' => 'nullable|string',
        //     'description' => 'nullable|string',
        //     'tags' => 'nullable',
        //     'feature_image' => 'nullable|image|mimes:jpeg,webp,jpg,png',
        // ]);

        if ($request->tags) {
            foreach ($request->tags as $tag) {

                $t = Tag::where('name', $tag)->first();
                if (!$t) {
                    $t = new Tag;
                    $t->name = $tag;
                    $t->addedby_id = Auth::id();
                    $t->save();
                }
            }
        }

        $blogPost = new BlogPost();
        $blogPost->title = $request->title;
        $blogPost->excerpt = $request->excerpt;
        $blogPost->description = $request->description;
        $blogPost->active = $request->active ?? 0;
        $blogPost->editor = $request->editor ?? 0;
        $blogPost->featured_slider = $request->featured_slider ?? 0;
        $blogPost->status = $request->status ?? 'pending';
        $blogPost->addedby_id = Auth::id();
        if ($request->hasFile('featured_image')) {
            $file = $request->featured_image;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = time() . $ext;
            Storage::disk('public')->put('blog_post_images/' . $imageName, File::get($file));
            $blogPost->featured_image = $imageName;
        }

        if ($request->tags) {
            $blogPost->tags = implode(', ', $request->tags);
        } else {
            $blogPost->tags = null;
        }
        $blogPost->save();

        if ($request->post_files) {
            $this->PostFileUpload($request->post_files, $blogPost);
        }
        $blogPost->blogCategories()->attach($request->categories);

        cache()->flush();
        toast('Blog Post Create Successfully', 'success');
        return redirect()->back();
    }


    public function PostFileUpload($files, $blogPost)
    {
        foreach ($files as $file) {
            $extension = strtolower($file->getClientOriginalExtension());
            $file_mime = strtolower($file->getClientMimeType());
            $file_original_name = strtolower($file->getClientOriginalName());

            $file_name = 'post_file_' . uniqid() . "_" . date('Y_m_d_his') . '.' . $extension;
            Storage::disk('public')->put('blog_post_files/' . $file_name, File::get($file));


            if (in_array($extension, BlogPostFile::SUPPORTED_IMAGE_TYPES)) {
                $file_type = "image";
            } else if (in_array($extension, BlogPostFile::SUPPORTED_WORD_TYPES)) {
                $file_type = "word";
            } else if (in_array($extension, BlogPostFile::SUPPORTED_PDF_TYPES)) {
                $file_type = "pdf";
            }

            $post_file = new BlogPostFile();
            $post_file->blog_post_id = $blogPost->id;
            $post_file->file_name = $file_name;
            $post_file->file_mime = $file_mime;
            $post_file->file_type = $file_type;
            $post_file->file_ext = $extension;
            $post_file->file_original_name = $file_original_name;
            $post_file->addedby_id = Auth::id();
            $post_file->save();
        }
    }



    public function blogPostEdit(BlogPost $blogPost)
    {
   
        menuSubmenu('blogPost', 'blogPostsAll');
        $data['blogPost'] =  $blogPost;
        $data['categories'] = BlogCategory::latest()->get();
        $data['medias'] = Media::latest()->paginate(20);
        $data['ots'] = $data['blogPost']->tags ? explode(", ", $data['blogPost']->tags) : null;
        return view('blogpost::admin.blogPosts.blogPostEdit', $data);
    }


    public function blogPostUpdate(Request $request, BlogPost $blogPost)
    {

        // dd($request->all());
        menuSubmenu('blogPost', 'blogPostsAll');
        // $this->validate($request, [
        //     'title' => 'required|string',
        //     'excerpt' => 'nullable|string',
        //     'description' => 'nullable|string',
        //     'tags' => 'nullable',
        //     'feature_image' => 'nullable|image|mimes:jpeg,webp,jpg,png',
        // ]);

        if ($request->tags) {
            foreach ($request->tags as $tag) {

                $t = Tag::where('name', $tag)->first();
                if (!$t) {
                    $t = new Tag;
                    $t->name = $tag;
                    $t->addedby_id = Auth::id();
                    $t->save();
                }
            }
        }

        $blogPost->title = $request->title;
        $blogPost->excerpt = $request->excerpt;
        $blogPost->description = $request->description;
        $blogPost->active = $request->active ?? 0;
        $blogPost->editor = $request->editor ?? 0;
        $blogPost->status = $request->status ?? 'pending';
        $blogPost->featured_slider = $request->featured_slider ?? 0;
        $blogPost->editedby_id = Auth::id();
        if ($request->hasFile('featured_image')) {
            $old_file = 'blog_post_images/' . $blogPost->featured_image;
            if (Storage::disk('public')->exists($old_file)) {
                Storage::disk('public')->delete($old_file);
            }
            $file = $request->featured_image;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = time() . $ext;
            Storage::disk('public')->put('blog_post_images/' . $imageName, File::get($file));
            $blogPost->featured_image = $imageName;
        }

        if ($request->tags) {
            $blogPost->tags = implode(', ', $request->tags);
        } else {
            $blogPost->tags = null;
        }

        $blogPost->save();

        if ($request->post_files) {
            $this->PostFileUpload($request->post_files, $blogPost);
        }

        $blogPost->blogCategories()->detach($blogPost->categories);
        $blogPost->blogCategories()->attach($request->categories);



        toast('Blog Post successfully updated', 'success');
        return redirect()->back();
    }



    public function blogPostDelete(BlogPost $blogPost)
    {
        menuSubmenu('blogPost', 'blogPostsAll');
        $old_file = 'blog_post_images/' . $blogPost->featured_image;
        if (Storage::disk('public')->exists($old_file)) {
            Storage::disk('public')->delete($old_file);
        }
        $blogPost->delete();
        toast('Blog Post successfully deleted', 'success');
        return redirect()->back();
    }


    public function blogPostActive(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('blog_posts')->where('id', $request->id)->update(['active' => 1]);
        } else {
            DB::table('blog_posts')->where('id', $request->id)->update(['active' => 0]);
        }
        return response()->json(['msg' => 'Status Successfully updated ', 'status' => true]);
    }



    public function postFileDelete(BlogPostFile $file)
    {
        $old_file = 'blog_post_files/' . $file->file_name;
        if (Storage::disk('public')->exists($old_file)) {
            Storage::disk('public')->delete($old_file);
        }

        $file->delete();
        toast('Post File successfully deleted', 'success');
        return redirect()->back();
    }



    public function selectTags(Request $request)
    {

        $tags = Tag::where('name', 'like', '%' . $request->q . '%')
            ->select(['name'])->take(30)->get();
        if ($tags->count()) {
            if ($request->ajax()) {
                return $tags;
            }
        } else {
            if ($request->ajax()) {
                return $tags;
            }
        }
    }
}