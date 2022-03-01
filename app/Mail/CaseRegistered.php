<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CaseRegistered extends Mailable
{
  use Queueable, SerializesModels;

  public $case;

  /**
   * Create a new message instance.
   *
   * @return void
   */
  public function __construct($case)
  {
    $this->case = $case;
  }

  /**
   * Build the message.
   *
   * @return $this
   */
  public function build()
  {
    return $this->subject("Caso N°" . $this->case['case_number'] . " enviado exitosamente")
                ->view('home.completed_case');
  }
}
