<?php

namespace App\Cms\Models;

use Session;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Page extends Model
{
      use NodeTrait;

      public function translate()
      {
          return $this->hasMany('App\Cms\Models\PagesTranslate');
      }

      public function getTranslate($lang_default = 1)
      {
          return Self::translate()->where('language_id', Session::get('content_lang_id', $lang_default))->first();
      }

}
