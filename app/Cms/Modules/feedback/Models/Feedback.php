<?php

namespace App\Cms\Modules\feedback\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
      public $table = 'feedback_log';
      protected $fillable = ['name', 'phone', 'mail', 'message'];

}
