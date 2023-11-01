<?php

namespace Cp\Admin\Controllers;

use Event;
use Validator;
use Carbon\Carbon;
use App\Models\User;
use Cp\Admin\Models\Language;
use Cp\Admin\Models\LanguageTranslation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;

class AdminController extends Controller
{ 
    public function dashboard()
     {
        menuSubmenu('dashboard', 'dashboard');
        return view('admin::dashboard.dashboard');
     } 

    public function languages(){
        menuSubmenu('configurations', 'languages');
        $languages = Language::paginate(30);
        $activeLanguages = Language::whereActive(true)->get();
        return view('admin::languages.languages',compact('languages','activeLanguages'));
    }

    public function languageCreate(){
        menuSubmenu('configurations', 'languages');
        return view('admin::languages.languageCreate');
    }

    public function languageStore(Request $request){

        menuSubmenu('configurations', 'languages');

        $validation = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'language_code' => 'required',
               
            ]
        );

        if ($validation->fails()) {
            toast('Please submit your data correctly', 'error');
            return back()->withInput()->withErrors($validation)->with('card-open', 'card-open');
        }


        if(Language::where('language_code',$request->language_code)->first()){
            toast('This code is already used for another language', 'error');
            return back();
        }

        $language = new Language();
        $language->title = $request->title;
        $language->language_code = strtolower($request->language_code);
        $language->addedby_id = Auth::id();
        $language->save(); 
        cache()->flush(); 
        
        
        $translations = LanguageTranslation::where('lang', 'en')->get();
        foreach($translations as $tran){
            $translation = new LanguageTranslation();
            $translation->lang = $language->language_code ?? '';
            $translation->lang_key = $tran->lang_key;
            $translation->lang_value = null;
            $translation->addedby_id = Auth::id();
            $translation->save();
            cache()->flush();
        }
        

        toast('Language has been inserted successfully', 'success');
        return redirect()->route('admin.languages');
        
    }

    
    public function languageEdit(Language $language){
        menuSubmenu('configurations', 'languages');
        return view('admin::languages.languageEdit',compact('language'));
    }

    public function languageUpdate(Request $request, Language $language){
        menuSubmenu('configurations', 'languages');
        $validation = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'language_code' => 'required',
               
            ]
        );

        if ($validation->fails()) {
            toast('Please submit your data correctly', 'error');
            return back()->withInput()->withErrors($validation)->with('card-open', 'card-open');
        }
        
        if(Language::where('language_code', $request->language_code)->where('id', '!=', $language->id)->first()){
            toast('This code is already used for another language', 'error');
            return back();
        }


        $language->title = $request->title;
        $language->language_code = strtolower($request->language_code);;
        $language->active = $request->active ? 1 : 0;
        $language->editedby_id = Auth::id();
        $language->save();
        cache()->flush();   

        toast('Language has been updated successfully', 'success');
        return redirect()->route('admin.languages');
        
    }

    public function languageDelete(Language $language){

        $language->translations()->delete();
        $language->delete();
        cache()->flush();
        toast('Language has been deleted successfully', 'success');
        return redirect()->route('admin.languages');
    }

    public function languageStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('languages')->where('id', $request->id)->update(['active' => 1]);
        } else {
            DB::table('languages')->where('id', $request->id)->update(['active' => 0]);
        }
        return response()->json(['msg' => 'Status Successfully updated ', 'status' => true]);

    }


    public function translations(){
        menuSubmenu('configurations', 'translations');
        return view('admin::translations.translations');
    }

    public function translationStore(Request $request){

        // dd($request->all());
        menuSubmenu('configurations', 'translations');
        $validation = Validator::make(
            $request->all(),
            [
                'lang_key' => 'required|unique:language_translations,lang_key',
            ]
        );

        if ($validation->fails()) {
            toast('Please submit your data correctly', 'error');
            return back()->withInput()->withErrors($validation)->with('card-open', 'card-open');
        }

        $lang_key = str_replace(' ', '_', $request->lang_key); 

        $languages = Language::whereActive(true)->get();
        if($languages){
            foreach($languages as $lang){
                $translation = new LanguageTranslation();
                $translation->lang = $lang->language_code ?? '';
                $translation->lang_key = strtolower($lang_key);
                $translation->lang_value = env('DEFAULT_LANGUAGE') == $lang->language_code ? $request->lang_value : null;
                $translation->addedby_id = Auth::id();
                $translation->save();
                cache()->flush();
            }
        }
        toast('Translation has been Created successfully', 'success');
        return redirect()->back();

       
    }


    public function languageTranslatoins(Language $language){
        $lang_keys = LanguageTranslation::where('lang', $language->language_code)->paginate(500);
        return view('admin::translations.translation_view',compact('lang_keys' ,'language'));
    }


    public function languageTranslateValueStore(Request $request){
        
        
        $language = Language::findOrFail($request->id);
        foreach ($request->values as $key => $value) { 
            $translation = LanguageTranslation::where('lang_key', $key)->where('lang', $language->language_code)->latest()->first();
            if($translation == null){
                $translation = new LanguageTranslation;
                $translation->lang = $language->language_code;
                $translation->lang_key = $key;
                $translation->lang_value = $value;
                $translation->save();
                cache()->flush();
            }
            else {
                $translation->lang_value = $value;
                $translation->save();
                cache()->flush();
            }
        }
        toast('Translations updated', 'success');
        return redirect()->back();
    }

    public function languageTranlationSearchAjax(Request $request)
    {
        $id = $request->id;
        $q = $request->q;
        $language = Language::findOrFail($request->id);

        $lang_keys = LanguageTranslation::where('lang', $language->language_code)->where(function ($qq) use ($q) {
            $qq->orWhere('lang_key', 'like', "%" . $q . "%");
        })   
        ->orderBy('lang_key')
        ->paginate(50);
       

        $page = View('admin::translations.searchLanguageTranslation', ['lang_keys' => $lang_keys, 'language' => $language])->render();

        return response()->json([
            'success' => true,
            'page' => $page,
        ]);
    }


  
}