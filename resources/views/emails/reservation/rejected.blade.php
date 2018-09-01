@component('mail::message')
# Hello!

Your reservation with ID {{ $reservation->id  }} has been rejected.

Check In Date: {{ $reservation->start_date }}

Check Out Date: {{ $reservation->end_date }}
Duration of Stay: {{ $diff->days . " Nights" }}

Reserved Rooms:
@foreach($reservation->roomTypes()->get() as $room)
@component('mail::panel')
Room Type: {{ $room->name }}
@endcomponent
@endforeach

@component('mail::panel')
## Reason:
{{ $reason }}
@endcomponent


See you! <br>
{{ config('app.name') }}
@endcomponent