<?php

namespace App\Cms\Modules\feedback\Mail;

use App\Cms\Modules\feedback\Models\Feedback;
use Illuminate\{Bus\Queueable, Mail\Mailable, Queue\SerializesModels, Contracts\Queue\ShouldQueue};

class FeedbackMail extends Mailable
{
    use Queueable, SerializesModels;

    // public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    // public function __construct(Order $order)
    // {
    //     $this->order = $order;
    // }
    public $order;
    public $view;
    public $subject;

    public function __construct($message, $view, $subject)
    {
      $this->order = $message;
      $this->view = $view;
      $this->subject = $subject;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->markdown($this->view, ['order'=>$this->order])
          ->subject($this->subject);
    }
}
