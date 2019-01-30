<?php

namespace App\Cms\Models;

use Illuminate\Database\Eloquent\Model;

class PagesTranslate extends Model
{
      protected $fillable = ['name', 'title', 'content', 'language_id'];

      public function language()
      {
          return $this->hasOne('App\Cms\Models\Language');
      }
}
