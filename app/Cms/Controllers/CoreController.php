<?php

namespace App\Cms\Controllers;

use App, View, Session, Config, Exception;
use App\Cms\{Models\Page, Models\Language, Controllers\Classes\TreeMaker};
use App\Http\Controllers\Controller;

abstract class CoreController extends Controller
{
    public function __construct()
    {
        $pages = Page::where('show', 1)
            ->orderByRaw('case when `order` is null then 0 else 1 end desc, `order`')
            ->orderby('order')
            ->get();

        $languages = Language::all();
        $languages_enabled_array = [];

        foreach ($languages->where('enabled', 1) as $language) {
            $languages_enabled_array[$language->id] = $language->name;
        }

        View::share([
            'pages' => $pages,
            'languages' => $languages,
            'makeTree' => new TreeMaker($pages->toTree()),
            'languages_enabled_array' => $languages_enabled_array,
        ]);
    }

      public function setLocale($locale)
      {
          $lang = Language::where('code', $locale)->first();
          $lang_id = $lang != null ? $lang->id : 1;
          Session::put('content_lang_id', $lang_id);
          Session::put('locale', $locale);

          return redirect()->back();
      }

      public function getData($url, $module_name = null, $method = 'all', $namespace= 'App\Cms\Modules\\')
      {
          $data = new \stdClass();
          return $data;
      }

      public function getModuleData($url, $module_name = null, $method = 'all', $namespace= 'App\Cms\Modules\\')
      {

          $module_name = $namespace.$module_name.'\Models\\'.ucfirst($module_name);
          $data = new \stdClass();
          $data = $module_name::$method();
          return $data;
      }
}
