<?php

namespace App\Cms\Modules\example\Controllers;

use App\Cms\{Controllers\CmsController, Models\Page};
use Illuminate\Http\Request;

class ExampleController extends CmsController
{
      public function index()
      {
          return view('example::example', [
              'action' => 'home',
              'curpage' => Page::with('ancestors')
                  ->where('module', 'example')
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
            'url' => $page,
              'action' => 'edit',
              'curpage' => $curpage,
          ]);
      }
}
