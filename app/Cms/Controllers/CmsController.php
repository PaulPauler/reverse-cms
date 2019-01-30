<?php

namespace App\Cms\Controllers;

use App, Auth, View, Config, Session;
use App\Cms\{Models\Page, Models\Language, Controllers\Classes\TreeMaker};
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

abstract class CmsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'multilang-cms']);

        /*Get all pages*/
        $pages = Page::where('show', 1)
            ->withDepth()
            ->orderByRaw('case when `order` is null then 0 else 1 end desc, `order`')
            ->orderby('id')
            ->get();

        /*Get all languages and create enabled languages array*/
        $languages = Language::all();
        $languages_enabled_array = [];

        foreach( $languages->where('enabled', 1) as $language) {
            $languages_enabled_array[$language->id] = $language->name;
        }

        /*Sharing for all views*/
        View::share([
            'pages' => $pages,
            'languages' => $languages,
            'makeTree' => new TreeMaker($pages->toTree()),
            'languages_enabled_array' => $languages_enabled_array,
        ]);
    }
}
