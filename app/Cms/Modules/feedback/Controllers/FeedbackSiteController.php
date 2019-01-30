<?php

namespace App\Cms\Modules\feedback\Controllers;

use Session, URL;
use App\Cms\{Controllers\CoreController, Modules\feedback\Models\Feedback, Modules\feedback\Mail\FeedbackMail};
use Illuminate\{Http\Request, Support\Facades\Mail};

class FeedbackSiteController extends CoreController
{
      public function store(Request $request)
      {
            // validate the data
            $validatedData = $request->validate([
              'name'  => 'required|string|max:100',
              'phone' => 'required|string|max:17',
              'mail' =>   'required|string|email',
              'message'  => 'required|string',
            ]);

            if(Session::get('cf_message') == $request->mail.$request->message){
              return 're';
            }else{
              $message = Feedback::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'mail' => $request->mail,
                'message' => $request->message
              ]);
              Session::put('cf_message', $message->mail.$message->message);
              $this->ship($message);
              return 'ok';
            }
      }

      public function ship($message, $view = 'emails.feedback', $subject = null)
      {
          $subject = $subject == null ? 'User sent a message from your site "'.env('APP_NAME').'"' : $subject;
          Mail::to(env('MAIL_RECIPIENT', 'support@'.str_replace('http://', '', str_replace('https://', '', URL::to('')))))->send(new FeedbackMail($message, $view, $subject));
      }
}
