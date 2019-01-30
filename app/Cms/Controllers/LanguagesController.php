<?php

namespace App\Cms\Controllers;

use Auth, View, Session, Config;
use App\Cms\{Controllers\CmsController, Models\Page, Models\Language};

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LanguagesController extends CmsController
{
    public function __construct()
    {
        Parent::__construct();
        View::share('parent', 'languages');
    }

    public function index()
    {
        return view('Cms::languages', [
            'action' => 'home',
        ]);
    }

    public function show($id)
    {
        $curlang = Language::where('id',$id)
            ->firstOrFail();

        return view('Cms::languages', [
            'action' => 'edit',
            'curlang' => $curlang,
        ]);
    }

    public function create()
    {
        return view('Cms::languages', [
          'action' => 'create'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:2|max:50',
            'code' => 'required|string|min:2|max:2|unique:languages,code'
        ]);

        DB::transaction(function () use ($request) {
            /*Add new language supporting*/
            $new_lang = Language::create(['name' => $request->name, 'code' => $request->code]);

            $pages = Page::all();
            foreach ($pages as $page) {
                $translate = $page->translate()->first();

                $page->translate()
                ->create([
                    'name' => $translate->name,
                    'title' => $translate->title,
                    'content' => $translate->content,
                    'language_id' => $new_lang->id
                ]);
            }
        });

        return redirect()->route('languages.index')->with('message', 'Cms::cms.success_create_language');
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:2|max:50',
            'code' => 'required|string|min:2|max:2|unique:languages,code,' . $request->id
        ]);

        $latest_language_code = Language::where('id', $request->id)->first();
        if ($latest_language_code != null) {
            /*Update language*/
            Language::where('id', $request->id)
                ->update([
                    'name' => $request->name,
                    'code' => $request->code
                ]);

            /*Update locale session*/
            if ($latest_language_code->id == Session::get('content_lang_id', 1)) {
                Session::put('content_lang', $request->code);
            }
        }

        return redirect()->route('languages.index')->with('message', 'Cms::cms.success_save_message');
    }

    public function deleteLanguage(Request $request)
    {
        if ((int)$request->language_id > 1) {
            $language_id = $request->language_id;
            $message = 'Cms::cms.success_delete_language';
            $type_message = 'message';

            Language::where('id', $language_id)
                ->delete();

            if ($language_id == Session::get('content_lang_id')) {
                Session::forget('content_lang_id');
            }
        } else {
            $message = (int)$request->page_id == 1 ? 'Cms::cms.error_delete_main_language_message' : 'Cms::cms.error_delete_language_message';
            $type_message = 'error';
        }

        /*Coming soon*/
        return redirect()->back()->with('language_' . $type_message, $message);
    }

    public function changeContentLanguage(Request $request)
    {
        $lang = Language::where('id', $request->lang_id)->first();
        $lang_id = $lang != null ? $lang->id : 1;
        Session::put('content_lang_id', $lang_id);

        return redirect()->back();
    }
}
