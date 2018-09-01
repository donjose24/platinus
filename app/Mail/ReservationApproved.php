<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReservationApproved extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reservation)
    {
        $this->reservation = $reservation;
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

        return $this->markdown('emails.reservation.approved')->with(['reservation' => $this->reservation, 'diff' => $diff])->subject("Your reservation has been approved");
    }
}
