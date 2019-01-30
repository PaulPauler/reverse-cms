<?php

namespace App\Cms\Controllers;

use Config, Session;
use App\Cms\{Controllers\CmsController, Models\Page, Models\Language};
use Illuminate\Http\Request;

class PageController extends CmsController
{
    public function index()
    {
        $curpage = Page::with('ancestors')
            ->where('id', 1)
            ->first();

        if($curpage == null)
            return view('Cms::errors.404');

        return view('Cms::page', [
            'action' => 'edit',
            'curpage' => $curpage,
        ]);
    }

    public function show($page)
    {
        $curpage = Page::with('ancestors')
            ->where('url',$page)
            ->first();

        if($curpage == null)
            return view('Cms::errors.404');

        return view('Cms::page', [
            'action' => 'edit',
            'curpage' => $curpage,
        ]);
    }

    public function create(Page $curpage = null)
    {
        return view('Cms::page', [
          'action' => 'create',
          'curpage' => $curpage,
        ]);
    }

    public function store(Request $request, Page $curpage = null)
    {
        /*Used*/$regexURL = 'regex:/^[a-z0-9-]+$/|';
        $url_rule = $request->page_id > 1 ? 'required|' . $regexURL . 'string|unique:pages' : '';

        $validatedData = $request->validate([
            'name' => 'required|string',
            'url' => $url_rule
        ]);

        $page = new Page();
            $page->url = $request->url;
            $page->module = $request->module;
            $page->menu_id = $request->menu_id != null ? 1 : 0;
            $request->parent_id == null ? null : $page->parent_id = $request->parent_id;
        $request->parent_id == null ? $page->saveAsRoot() : $page->save();

        foreach (Language::where('enabled', 1)->cursor() as $language) {
            $page->translate()
                ->create([
                    'name' => $request->name,
                    'h1' => $request->h1,
                    'content' => $request->content,
                    'title' => $request->title,
                    'language_id' => $language->id
                ]);
        }

        return redirect(env('CMS_URL', 'panel') . '/pages/create' . ($curpage != null ? '/' . $curpage->id : ''))
            ->with([
                'message' => 'Cms::cms.success_create_message',
                'curpage' => $curpage
            ]);
    }

    public function update(Request $request)
    {
        /*Used*/$regexURL = 'regex:/^[a-z0-9-]+$/|';
        $url_rule = $request->page_id > 1 ? 'required|' . $regexURL . 'string|unique:pages,url,' . (int)$request->page_id : '';

        $validatedData = $request->validate([
            'name' => 'required|string',
            'url' => $url_rule
        ]);

        $page = Page::where('id', $request->page_id)->first();
            if ($page->id > 1) {
                $page->url = $request->url;
                $page->module = $request->module;
                $request->parent_id == null ? null : $page->parent_id = $request->parent_id;
            }
            $page->menu_id = $request->menu_id != null ? 1 : 0;

        $request->parent_id == null ? $page->saveAsRoot() : $page->save();

        $cur_lang_id = Language::where('enabled', 1)
            ->where('id', Session::get('content_lang_id', 1))
            ->value('id');

        $page->translate()
            ->where('language_id', $cur_lang_id)
            ->update([
                'name' => $request->name,
                'h1' => $request->h1,
                'content' => $request->content,
                'title' => $request->title,
            ]);

        return redirect(env('CMS_URL', 'panel') . '/pages/' . $page->url)->with('message', 'Cms::cms.success_save_message');
    }

    public function deletePage(Request $request)
    {
        if ((int)$request->page_id > 1) {
            $page_id = $request->page_id;
            $message = 'Cms::cms.success_delete_message';
            $type_message = 'message';

            /*Coming soon*/
            // Page::where('id', $page_id)
            //     ->update(['show' => -1]);
            $page = Page::where('id', $page_id)->first();
            $page->delete();
        } else {
            $message = (int)$request->page_id == 1 ? 'Cms::cms.error_delete_index_page_message' : 'Cms::cms.error_delete_page_message';
            $type_message = 'error';
        }

        return redirect()->back()->with('structure_'.$type_message, $message);
    }

    public function sortable(Request $request, $i = 0)
    {
        foreach (json_decode($request->sortArray)[0] as $item) {
            $i++;
            $page = Page::where('id', $item->id)->first();
            $page->order = $i;
            $page->saveAsRoot();
            if (count($item->children[0]) > 0) $this->sortableChildren($item->children, $item->id);
        }

        return count($item->children[0]);
    }

    public function sortableChildren($children, $parent_id, $i = 0)
    {
        foreach ($children[0] as $child) {
            $page = Page::where('id', $child->id)->first();
            $page->order = $i;
            $page->parent_id = $parent_id;
            $page->save();
            if (count($child->children[0]) > 0) $this->sortableChildren($child->children, $child->id);
        }
    }
}
