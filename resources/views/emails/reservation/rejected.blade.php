@component('mail::message')
# Hello!

Your reservation with ID {{ $reservation->code }} has been rejected.

Check In Date: {{ $reservation->start_date }}

Check Out Date: {{ $reservation->end_date }}
Duration of Stay: {{ $diff . " Nights" }}

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

@component('mail::panel')
Please upload a valid deposit slip to:

East West Bank

Hotel platanus Inc.

10802000974

@endcomponent

Thank you! <br>
{{ config('app.name') }}
@endcomponent
