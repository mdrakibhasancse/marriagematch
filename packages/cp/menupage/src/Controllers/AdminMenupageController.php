<?php

namespace Cp\Menupage\Controllers;


use Cp\Menupage\Models\Menu;
use Cp\Menupage\Models\Page;
use App\Http\Controllers\Controller;
use Cp\Media\Models\Media;
use Cp\Menupage\Models\PageItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Psy\Output\OutputPager;
use Illuminate\Support\Facades\Validator;

class AdminMenupageController extends Controller
{
    public function menusAll()
    {
        menuSubmenu('menupage', 'menusAll');
        $data['menus'] = $menus = Menu::orderBy('drag_id')->latest()->paginate(30);
        return view('menupage::admin.menus.menusAll', $data);
    }


    public function menuStore(Request $request)
    {

        
        menuSubmenu('menupage', 'menusAll');
        $request->validate([
            'name' => 'string|required',
            'type' => 'string|required',
        ]);

        $menu =  new Menu();
        $menu->name = $request->name;
        $menu->type = $request->type;
        $menu->link = $request->link ?: null;
        $menu->addedby_id = Auth::id();
        $menu->save();
        cache()->flush();
        toast('Menu successfully Created', 'success');
        return redirect()->back();
    }


    public function menuEdit(Menu $menu)
    {
        menuSubmenu('menupage', 'menusAll');
        $data['menu'] = $menu;
        return view('menupage::admin.menus.menuEdit', $data);
    }

    public function menuShow(Menu $menu)
    {
        menuSubmenu('menupage', 'menusAll');
        $data['menu'] = $menu;
        return view('menupage::admin.menus.menuShow', $data);
    }


    public function menuUpdate(Request $request, Menu $menu)
    {
        menuSubmenu('menupage', 'menusAll');
        $request->validate([
            'name' => 'string|required',
            'type' => 'string|required',
        ]);

        $menu->name        = $request->name;
        $menu->type        = $request->type;
        $menu->active      = $request->active ?? 0;
        $menu->link        = $request->link ?: null;
        $menu->editedby_id = Auth::id();
        $menu->save();
        cache()->flush();
        toast('Menu successfully Updated', 'success');
        return redirect()->back();
    }

    public function menuDelete(Menu $menu)
    {
        menuSubmenu('menupage', 'menusAll');
        $menu->delete();
        cache()->flush();
        toast('Menu successfully deleted', 'success');
        return redirect()->back();
    }


    public function menuSort(Request $request)
    {
        foreach ($request->sorted_data as $key => $d) {
            DB::table('menus')->where('id', $d)->update(['drag_id' => ($key + 1)]);
        }
        return response()->json([
            'success' => true,
        ]);
    }




    public function pagesAll()
    {
        menuSubmenu('menupage', 'pagesAll');
        $data['menus'] = Menu::latest()->get();
        $data['pages'] = Page::orderBy('drag_id')->latest()->paginate(30);
        return view('menupage::admin.pages.pagesAll', $data);
    }


    public function pageStore(Request $request)
    {
       
        menuSubmenu('menupage', 'pagesAll');

        // $request->validate([
        //     'name' => 'string|required',
        // ]);


        $page = new Page();
        $page->name = $request->name;
        $page->excerpt = $request->excerpt;
        $page->link  = $request->link ?: null;
        $page->meta_title = $request->meta_title ?? '';
        $page->meta_description = $request->meta_description ?? '';
        $page->addedby_id = Auth::id();
        $page->save();
        $page->menus()->attach($request->menus_id, ['addedby_id' => Auth::id()]);
        toast('Page successfully created', 'success');
        cache()->flush();
        return redirect()->back();
    }


    public function pageEdit(Page $page)
    {
        menuSubmenu('menupage', 'pagesAll');
        $data['page'] = $page;
        $data['menus'] = Menu::latest()->get();
        return view('menupage::admin.pages.pageEdit', $data);
    }




    public function pageUpdate(Request $request, Page $page)
    {
        menuSubmenu('menupage', 'pagesAll');
        // $request->validate([
        //     'name' => 'string|required',
        // ]);

        $page->name        = $request->name;
        $page->excerpt     = $request->excerpt;
        $page->active      = $request->active ?? 0;
        $page->link        = $request->link ?: null;
        $page->meta_title = $request->meta_title ?? '';
        $page->meta_description = $request->meta_description ?? '';
        $page->editedby_id = Auth::id();
        $page->save();
        $page->menus()->detach($page->menus_id);
        $page->menus()->attach($request->menus_id, ['editedby_id' => Auth::id()]);
        cache()->flush();
        toast('page successfully Updated', 'success');
        return redirect()->back();
    }

    public function pageDelete(Page $page)
    {
        menuSubmenu('menupage', 'pagesAll');
        $page->delete();
        cache()->flush();
        toast('Page successfully deleted', 'success');
        return redirect()->back();
    }


    public function pageSort(Request $request)
    {
        foreach ($request->sorted_data as $key => $d) {
            DB::table('pages')->where('id', $d)->update(['drag_id' => ($key + 1)]);
        }

        return response()->json([
            'success' => true,
        ]);
    }








    public function pageItemCreate($page_id)
    {
        $data['page'] = Page::find($page_id);
        $data['medias'] = Media::latest()->paginate(20);
        return view('menupage::admin.pageItems.pageItemCreate', $data);
    }




    public function pageItemStore(Request $request)
    {
        // dd(json_encode($request->description), $request->description, $request->all());
   
        $request->validate([
            'name' => 'required',
            // 'description.*' => 'required',
        ]);
        $description = $request->description;

        $pageItem = new PageItem();
        $pageItem->page_id     = $request->page_id;
        $pageItem->name        = $request->name;
        $pageItem->description = $description;
        $pageItem->editor = $request->editor ?? 0;
        $pageItem->active = $request->active ?? 0;
        $pageItem->addedby_id = Auth::id();
        $pageItem->save();
        toast('PageItem successfully created', 'success');
        return redirect()->back();
    }



    public function pageItemEdit(pageItem $pageItem)
    {
        $data['pageItems'] = PageItem::where('page_id', $pageItem->page_id)->get();
        $data['pageItem'] =  $pageItem;
        $data['medias'] = Media::latest()->paginate(20);
        return view('menupage::admin.pageItems.pageItemEdit', $data);
    }


    public function pageItemUpdate(Request $request, pageItem $pageItem)
    {



        // $request->validate([
        //     'name' => 'required',
        //     'description' => 'required',
        // ]);

        $pageItem->page_id     = $request->page_id;
        $pageItem->name        = $request->name;
        $pageItem->description = $request->description;
        $pageItem->editor      = $request->editor ?? 0;
        $pageItem->active      = $request->active ?? 0;
        $pageItem->editedby_id = Auth::id();
        $pageItem->save();
        toast('PageItem successfully updated', 'success');
        return redirect()->back();
    }


    public function pageItemDelete(pageItem $pageItem)
    {
        $pageItem->delete();
        toast('PageItem successfully deleted', 'success');
        return redirect()->back();
    }
}