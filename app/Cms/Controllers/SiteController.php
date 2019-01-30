<?php

namespace App\Cms\Controllers;

use View, Session, Config;
use App\Cms\{Models\Page, Models\Language, Controllers\CoreController};

class SiteController extends CoreController
{
    public function index()
    {
        $curpage = Page::with('ancestors')
            ->where('id',1)
            ->firstOrFail();

        return view('home', compact('curpage'));
    }

    public function show($pages)
    {
        $pages = explode('/', $pages);

        $curpage = Page::with('ancestors')
            ->where('url', end($pages))
            ->firstOrFail() ;

        foreach ($curpage->ancestors as $ancestor) {
            if (!in_array($ancestor->url, $pages)) {
              abort(404);
            }
        }

        try {
            foreach (explode(',', $curpage->module) as $module) {
                $func = $module != null ? 'getModuleData' : 'getData';
                $data = $this->$func($curpage->url, $module);
            }
        } catch (Exception $e) {
            echo 'Exception: ',  $e->getMessage(), "\n";
        } finally {
            if (Config::get('app.debug') == false) {
                return view('page', compact('curpage', 'data'));
            }
        }

        if (Config::get('app.debug') == true) {
            return view('page', compact('curpage', 'data'));
        }
    }
}
