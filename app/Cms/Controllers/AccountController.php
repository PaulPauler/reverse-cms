<?php

namespace App\Cms\Controllers;

use Auth, View, DateTimeZone;
use App\Cms\Controllers\CmsController;
use Illuminate\{Support\Facades\Hash, Http\Request};

class AccountController extends CmsController
{
  public function __construct()
  {
      Parent::__construct();
      View::share('parent', 'account');
  }

  public function index()
  {
      $user = Auth::user();
      $timezonelist = $this->getTimezoneList();

      return view('Cms::account', [
        'timezonelist' => $timezonelist,
      ]);
  }

  public function store(Request $request)
  {
      $user = Auth::user();

      /*Used*/$regex = 'regex:/^[a-zA-Z0-9_-]{0,}$/|';
      $pass_cond = $request->password != null ? 'required|'.$regex.'min:6' : '';
      $pass_conf_cond = $request->password != null ? 'required|same:password' : '';

      $validatedData = $request->validate([
        'name'  => 'required|string|min:2|max:50',
        'email'  => 'required|email|unique:users,email,'.$user->id,
        'lang'  => 'required|string|regex:/^[a-z]{2,3}$/|min:2|max:3,',
        'password' => $pass_cond,
        'password_confirm' => $pass_conf_cond,
      ]);

      if($request->password != null)
          $user->password = Hash::make($request->password);

      $user->timezone = $request->timezone;
      $user->name = $request->name;
      $user->email = $request->email;
      $user->lang = $request->lang;
      $user->save();

      return redirect()->back()->with('message', 'Cms::cms.success_save_message');
  }

  public function getTimezoneList()
  {
      $zones_array = [];
      foreach(DateTimeZone::listIdentifiers(DateTimeZone::ALL) as $key => $zone) {
          $date = new \DateTime();
          $date->setTimezone(new \DateTimeZone($zone));
        $zones_array[$zone] = $zone. ' (UTC ' . $date->format('P'). ')';
      }

      return $zones_array;
  }
}
