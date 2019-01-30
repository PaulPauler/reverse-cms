<?php

namespace App\Cms\Controllers;

use App\Cms\{Controllers\CmsController, Models\Page, Models\Language};
use Illuminate\Http\Request;

class FileController extends CmsController
{
    public function index()
    {
        return view('Cms::filemanager', [
          'parent' => 'filemanager',
        ]);
    }
}
