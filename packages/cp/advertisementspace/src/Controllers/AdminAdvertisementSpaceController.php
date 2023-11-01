<?php

namespace Cp\AdvertisementSpace\Controllers;


use App\Http\Controllers\Controller;
use Cp\AdvertisementSpace\Models\AdvertisementSpace;
use Cp\Media\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class AdminAdvertisementSpaceController extends Controller
{
    public function advertisementSpacesAll()
    {
        menuSubmenu('advertisement', 'advertisementsAll');
        $data['advertisements'] = $advertisements = AdvertisementSpace::latest()->paginate(30);
        return view('advertisementspace::admin.advertisementSpaces.advertisementSpacesAll', $data);
    }


    public function advertisementSpaceCreate()
    {
        menuSubmenu('advertisement', 'advertisementCreate');
        $data['medias'] = Media::latest()->paginate(20);
        return view('advertisementspace::admin.advertisementSpaces.advertisementSpaceCreate', $data);
    }


    public function advertisementSpaceStore(Request $request)
    {

        menuSubmenu('advertisement', 'advertisementCreate');
        $request->validate([
            'title' => 'string|required',
            'position' => 'string',
            'description' => 'string',
        ]);

        $advertisement =  new AdvertisementSpace();
        $advertisement->title = $request->title;
        $advertisement->position = $request->position;
        $advertisement->description = $request->description;
        $advertisement->editor = $request->editor ?? 0;
        $advertisement->active = $request->active ?? 0;
        $advertisement->addedby_id = Auth::id();
        $advertisement->save();
        cache()->flush();
        toast('Ad Space  successfully Created', 'success');
        return redirect()->back();
    }


    public function advertisementSpaceEdit(AdvertisementSpace  $advertisement)
    {

        menuSubmenu('advertisement', 'advertisementCreate');
        $data['advertisement'] = $advertisement;
        $data['medias'] = Media::latest()->paginate(20);
        return view('advertisementspace::admin.advertisementSpaces.advertisementSpaceEdit', $data);
    }




    public function advertisementSpaceUpdate(Request $request, AdvertisementSpace  $advertisement)
    {


        menuSubmenu('advertisement', 'advertisementCreate');
        $request->validate([
            'title' => 'string|required',
            'position' => 'string',
            'description' => 'string',
        ]);
        $advertisement->title = $request->title;
        $advertisement->position = $request->position;
        $advertisement->description = $request->description;
        $advertisement->editor = $request->editor ?? 0;
        $advertisement->active = $request->active ?? 0;
        $advertisement->editedby_id = Auth::id();
        $advertisement->save();
        cache()->flush();
        toast('Aadvertisment  successfully Updated', 'success');
        return redirect()->back();
    }

    public function advertisementSpaceDelete(AdvertisementSpace  $advertisement)
    {
        menuSubmenu('advertisement', 'advertisementsAll');
        $advertisement->delete();
        cache()->flush();
        toast('Advertisment  successfully deleted', 'success');
        return redirect()->back();
    }
}
