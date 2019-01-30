<?php

namespace App\Cms\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
      protected $fillable = ['name', 'code'];

      public $timestamps = false;
}
