<?php

namespace App\Cms\Modules\sitemap\Controllers;

use App\Cms\{Controllers\CmsController, Models\Page};
use Illuminate\Http\Request;

class SitemapController extends CmsController
{
    public function index()
    {
        return view('sitemap::sitemap', [
            'parent' => 'sitemap',
            'curpage' => Page::with('ancestors')
                ->where('module', 'sitemap')
                ->firstOrFail(),
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
            'curpage' => $curpage
        ]);
    }

    public function sitemap()
    {
        return response()->view('content.modules.xml.sitemap')->header('Content-Type', 'text/xml');
    }
}
