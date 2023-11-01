<?php

namespace Cp\Gallery\Controllers;



use App\Http\Controllers\Controller;
use Cp\Gallery\Models\Gallery;
use Cp\Gallery\Models\GalleryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class AdminGalleryController extends Controller
{
    public function galleriesAll()
    {
        menuSubmenu('gallery', 'galleriesAll');
        $data['galleries'] = Gallery::where('status', "!=", "temp")->paginate(30);
        return view('gallery::admin.galleries.galleriesAll', $data);
    }

    public function galleryCreate()
    {
        menuSubmenu('gallery', 'galleriesAll');
        $temp = Gallery::where("status", "temp")->first();
        if (!$temp) {
            $db = new Gallery;
            $db->addedby_id = Auth::id();
            $db->save();
        }
        return view('gallery::admin.galleries.galleryCreate');
    }


    public function galleryStore(Request $request)
    {
        menuSubmenu('gallery', 'galleriesAll');

        $request->validate([
            'title' => 'required',
            'featured_image' => 'required|image',
        ]);

        $temp = Gallery::where("status", "temp")->first();
        if ($temp) {
            $gallery = $temp;
            $gallery->title = $request->title;
            $gallery->description = $request->description;
            $gallery->featured = $request->featured ? true : false;
            $gallery->status = $request->published ? "published" : "draft";
            if ($request->hasFile('featured_image')) {
                $file = $request->featured_image;
                $ext = "." . $file->getClientOriginalExtension();
                $imageName = time() . $ext;
                Storage::disk('public')->put('galleries/' . $imageName, File::get($file));
                $gallery->featured_image = $imageName;
            }

            $gallery->addedby_id = Auth::id();
            $gallery->save();


            if ($request->hasfile('extraImages')) {
                foreach ($request->file('extraImages') as $file) {

                    $imageName = rand(111111, 999999) . time() . '.' . $file->getClientOriginalExtension();
                    Storage::disk('public')->put('gallery_items/' . $imageName, File::get($file));
                    $galleryItem = new GalleryItem();
                    $galleryItem->gallery_id = $gallery->id;
                    $galleryItem->image = $imageName;
                    $galleryItem->description = $gallery->description;
                    $galleryItem->addedby_id = Auth::id();
                    $galleryItem->save();
                }
            }

            toast('Gallery Created Successfuly', 'success');
            return back();
        } else {

            $db = new Gallery();
            $db->addedby_id = Auth::id();
            $db->save();
            toast('Someting went Problem', 'warning');
            return back();
        }
    }


    public function galleryEdit(Gallery $gallery)
    {
        menuSubmenu('gallery', 'galleriesAll');
        return view('gallery::admin.galleries.galleryEdit', compact('gallery'));
    }


    public function galleryUpdate(Request $request, Gallery $gallery)
    {
        menuSubmenu('gallery', 'galleriesAll');
        $request->validate([
            'title' => 'required',
        ]);

        $gallery->title = $request->title;
        $gallery->description = $request->description;
        $gallery->featured = $request->featured ? true : false;
        $gallery->status = $request->published ? "published" : "draft";
        if ($request->hasFile('featured_image')) {
            $old_file = 'galleries/' . $gallery->featured_image;
            if (Storage::disk('public')->exists($old_file)) {
                Storage::disk('public')->delete($old_file);
            }
            $file = $request->featured_image;
            $ext = "." . $file->getClientOriginalExtension();
            $imageName = time() . $ext;
            Storage::disk('public')->put('galleries/' . $imageName, File::get($file));
            $gallery->featured_image = $imageName;
        }

        $gallery->editedby_id = Auth::id();
        $gallery->save();


        if ($request->hasfile('extraImages')) {

            foreach ($request->file('extraImages') as $file) {
                $galleryItem = new GalleryItem();
                $old_file = 'gallery_items/' . $galleryItem->image;
                if (Storage::disk('public')->exists($old_file)) {
                    Storage::disk('public')->delete($old_file);
                }
                $imageName = rand(111111, 999999) . time() . '.' . $file->getClientOriginalExtension();
                Storage::disk('public')->put('gallery_items/' . $imageName, File::get($file));
                $galleryItem->gallery_id = $gallery->id;
                $galleryItem->image = $imageName;
                $galleryItem->description = $gallery->description;
                $galleryItem->editedby_id = Auth::id();
                $galleryItem->save();
            }
        }
        toast('Gallery Upadated Successfuly', 'success');
        return redirect()->back();
    }


    public function galleryDelete(Gallery $gallery)
    {
        menuSubmenu('gallery', 'galleriesAll');
        $old = 'galleries/' . $gallery->featured_image;
        if (Storage::disk('public')->exists($old)) {
            Storage::disk('public')->delete($old);
        }
        $gallery->delete();
        toast('Gallery successfully deleted', 'success');
        return redirect()->back();
    }


    public function galleryItemDescriptionUpdate(Request $request, GalleryItem $imageItem)
    {
        $imageItem->description = $request->data;
        $imageItem->save();
        return true;
    }

    public function galletyImageItemDelete(GalleryItem $imageItem)
    {
        if ($imageItem->image) {
            $old_file = 'gallery_items/' . $imageItem->image;
            if (Storage::disk('public')->exists($old_file)) {
                Storage::disk('public')->delete($old_file);
            }
        }

        $imageItem->delete();
        return true;
    }
}
