<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LeaveMail extends Mailable
{
    use Queueable, SerializesModels;

    public $permohonan;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($permohonan)
    {
        $this->permohonan = $permohonan;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('no-reply.hr@nitigura.com', 'PT Nitigura Indonesia')
            ->subject('Permohonan Cuti')
            ->view('emails.leave-accepted')
            ->with([
                "name" => $this->permohonan['name'],
                'start_date' => $this->permohonan['start_date'],
                'end_date' => $this->permohonan['end_date'],
                'status' => $this->permohonan['status'],
                'total' => $this->permohonan['total'],
                'remaining' => $this->permohonan['remaining'],
                'note' => $this->permohonan['note'],
            ]);
    }
}
