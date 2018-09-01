@component('mail::message')
# Hello!

Your reservation has been approved.

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
# Rules and Regulations
* Check-in time is 2:00pm and check-out time is 12 noon the following day. Late check out will of an hour or more have an additional charge of Php100/hour.
* For Daily and Monthly Occupancy the Management requires FULL PAYMENT for the entire stay.
* For confirmed reservation, please present the original copy of your reservation slip upon check-in together with one valid ID.
* Visitors are allowed up to 10:00pm only. No ID, No Entry policy for visitors.
* As a courtesy, please avoid unnecessary noise that may disturb other tenants. The management reserves the right to refuse any noisy and unruly guests in order to protect the interests of other tenants.
* For security measures, keep your unit doors locked especially when going out. The Management is not liable for lost valuables. We have a safety deposit box at the Front Desk should you want us to keep your valuables.
* For Long Term stay who are about to check out, please inform the Front Desk At least a day before to prepare electricity and other unsettled payments.
* Smoking is prohibited in hotel rooms. However, smokers may do so at the balcony or in any common areas outside the unit.
* Pets are not allowed inside the Premises of the Hotel.
* Furniture, fixtures, and other amenities are properties of the hotel. Guests are liable for loss or damage of room/unit's properties.
* Lost Keys shall be charged to the guest for Php100/each. Should the keys be left inside the room, kindly inform the Front Desk for assistance.
* Switch off all lights and close all water taps when going out.
* Firearms, explosives, and harmful chemicals are not allowed inside the premises.
* Use of prohibited drugs and other illegal activities are prohibited.
* Our personnel will collect your garbage everyday between 7AM to 8AM only; you may leave your garbage in plastic bags in front of your room. Do leave your garbage outside of the door after collection time.
* Please report to the Front Desk any personnel soliciting cash or tip for basic services rendered.
* To avoid delay, please call the attention of the Front Desk one hour before checking out to allow our personnel to check your room amenities in accordance with our standard operating procedures.
* In case of emergency, please call the attention of the Front Desk. The fire escape is located at the 'exit' areas and fire extinguishers are strategically located at every floor.
@endcomponent


See you! <br>
{{ config('app.name') }}
@endcomponent