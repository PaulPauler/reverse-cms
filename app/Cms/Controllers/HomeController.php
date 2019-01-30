<?php

namespace App\Cms\Controllers;

use App\Cms\{Controllers\CmsController, Models\Page, Models\Language};
use Illuminate\Http\Request;

class HomeController extends CmsController
{
    public function index()
    {
        return view('Cms::home', [
          'parent' => 'settings',
        ]);
    }

    public function show($page)
    {
        return view('Cms::home');
    }
}
