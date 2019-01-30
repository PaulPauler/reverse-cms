<?php

namespace App\Cms\Middleware;

use App, Session, Config;
use App\Cms\Models\Language;

class MultilangSite
{
    public function handle($request, $next)
    {
        $locale = Language::where(['enabled' => 1, 'code' => Session::get('locale')])->first() != null ? Session::get('locale') : Config::get('app.locale');
        $lang_id = Language::where(['enabled' => 1, 'id' => Session::get('content_lang_id')])->first() != null ? Session::get('content_lang_id') : 1;
        Session::put('content_lang_id', $lang_id);
        App::setLocale($locale);

        return $next($request);
    }
}
