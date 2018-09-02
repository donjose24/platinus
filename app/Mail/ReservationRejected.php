<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReservationRejected extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reservation, $reason)
    {
        $this->reservation = $reservation;
        $this->reason = $reason;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $startDate = \DateTime::createFromFormat('Y-m-d', $this->reservation->start_date);
        $endDate = \DateTime::createFromFormat('Y-m-d', $this->reservation->end_date);

        $diff = date_diff($startDate, $endDate);
        $diff = $diff->days;
        return $this->markdown('emails.reservation.rejected')->with(['reservation' => $this->reservation, 'reason' => $this->reason, 'diff' => $diff])->subject("Your reservation has been rejected");
    }
}
