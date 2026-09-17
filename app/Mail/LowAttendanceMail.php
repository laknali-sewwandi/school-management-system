<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LowAttendanceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $parent;
    public $student;
    public $percentage;

    public function __construct($parent, $student, $percentage)
    {
        $this->parent = $parent;
        $this->student = $student;
        $this->percentage = $percentage;
    }

    public function build()
    {
        return $this->subject('🚨 URGENT: Low Attendance Notice - ' . $this->student->name)
                    ->view('emails.low_attendance');
    }
}