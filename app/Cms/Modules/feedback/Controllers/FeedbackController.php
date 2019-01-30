<?php

namespace App\Cms\Modules\feedback\Controllers;

use Session, Auth;
use App\Cms\{Controllers\CmsController, Models\Page, Modules\feedback\Models\Feedback, Modules\feedback\Mail\FeedbackMail};
use Illuminate\{Http\Request, Support\Facades\Mail};
use Carbon\Carbon;

class FeedbackController extends CmsController
{
      public function index()
      {
          $messages = Feedback::orderby('answer_status')
          ->orderby('created_at', 'DESC')
          ->get();
          return view('feedback::feedback', [
            'action' => 'home',
            'curpage' => Page::with('ancestors')
                ->where('module', 'feedback')
                ->firstOrFail(),
            'messages' => $messages
          ]);
      }

      public function show($page)
      {
          $curpage = Page::with('ancestors')
              ->where('url',$page)
              ->first();

          if($curpage == null)
              return view('Cms::errors.404');

          return view('Cms::page', [
              'action' => 'edit',
              'curpage' => $curpage,
          ]);
      }

      public function deleteFeedback(Request $request)
      {
          if((int)$request->feedback_id > 0){
              $feedback_id = $request->feedback_id;
              $message = 'feedback::feedback.delete_success_message';
              $type_message = 'message';

              Feedback::where('id', $feedback_id)
                  ->delete();
          }else{
              $message = 'feedback::feedback.delete_error_message';
              $type_message = 'error';
          }

          return redirect()->back()->with('feedback_'.$type_message, $message);
      }

      public function truncateFeedbackTable(Request $request)
      {
          var_dump($request->type);

          switch ($request->type) {
            case 'all':
              Feedback::truncate();
              break;
            case 'with_answers':
              Feedback::whereNotNull('answer_status')->delete();
              break;
            default:
              return redirect()->back()->with('feedback_error', 'feedback::feedback.delete_error');
              break;
          }

          return redirect()->back()->with('feedback_messages', 'feedback::feedback.delete_success_messages');
      }

      public function answer($message_id)
      {
          $curmessage = Feedback::where('id', $message_id)
            ->first();

          if($curmessage == null)
            return view('Cms::errors.404');

          return view('feedback::feedback', [
            'action' => 'answer',
            'curmessage' => $curmessage,
          ]);
      }

      public function sendAnswer(Request $request)
      {
          $message = Feedback::where('id', $request->message_id)
            ->where('answer_status', null)
            ->first();

          if($message == null)
            return view('Cms::errors.404');

          // validate the data
          $validatedData = $request->validate([
            'answer'  => 'required|string'
          ]);

          // store in the database
          $message->answer_status = 1;
          $message->answer = $request->answer;
          $message->answer_author = Auth::user()->email;
          $message->save();

          $this->ship($message);

          return redirect()->back()->with('message', 'feedback::feedback.success');
      }

      public function ship($message, $view = 'emails.answer', $subject = null)
      {
          $subject = $subject == null ? 'New message from "'.env('APP_NAME').'"' : $subject;
          Mail::to($message->mail)->send(new FeedbackMail($message, $view, $subject));
      }
}
