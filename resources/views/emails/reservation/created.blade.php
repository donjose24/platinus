@component('mail::message')
# Hello!

Below are the details of your reservation:

## Reservation ID: {{ $reservation->code }}

Check In Date: {{ $reservation->start_date }}

Check Out Date: {{ $reservation->end_date }}

Duration of Stay: {{ $diff->days . " Nights" }}
@php
$total = 0;
@endphp

Rooms:

@foreach($reservation->roomTypes()->get() as $room)
@component('mail::panel')
Room Type: {{ $room->name }}

Price per night: PHP {{ number_format($room->daily_rate, 2) }}
@php
$total = $total + ($room->daily_rate * $diff->days)
@endphp

@endcomponent
@endforeach

# Grand Total {{ number_format($total, 2) }}

@component('mail::panel')
@if($diff->days < 7)
*Please deposit your payment in full to the details below*
@else
*Please deposit at least 20% of your total bill*
@endif

East West Bank

Hotel Bellamonte Inc.

10802000974

After the deposit has been made, Upload the deposit slip in your portal.
@component('mail::button', ['url' =>  $url])
Login Here
@endcomponent
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
