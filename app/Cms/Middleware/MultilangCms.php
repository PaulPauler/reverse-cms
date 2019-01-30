<?php

namespace App\Cms\Middleware;

use App, Auth, Session;

use App\Cms\Models\Language;

class MultilangCms
{
    public function handle($request, $next)
    {
        $user = Auth::user();

        if (isset($user)) {
            App::setLocale(Auth::user()->lang);
        }
        
        $lang_id = Language::where(['enabled' => 1, 'id' => Session::get('content_lang_id')])->first() != null ? Session::get('content_lang_id') : 1;
        Session::put('content_lang_id', $lang_id);

        return $next($request);
    }
}
