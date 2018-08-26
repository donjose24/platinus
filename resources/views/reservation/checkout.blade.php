@extends('layouts.front')

@section('content')
    <div class="welcome-content">
        <div class="page-content reservation-content">
            <div class="row">
                <div class="col-md-6">
                    <h1>Rules and Regulation</h1>
                    <p> CHECK-IN and CHECK-OUT are subject to the following conditions:</p>
                    <ol type="A">
                        <li>Check-in time is 2:00pm and check-out time is 12 noon the following day. Late check out will of an hour or more have an additional charge of Php100/hour.</li>
                        <li>For Daily and Monthly Occupancy the Management requires FULL PAYMENT for the entire stay.</li>
                        <li>For confirmed reservation, please present the original copy of your reservation slip upon check-in together with one valid ID.</li>
                        <li>Visitors are allowed up to 10:00pm only. No ID, No Entry policy for visitors.</li>
                        <li>As a courtesy, please avoid unnecessary noise that may disturb other tenants. The management reserves the right to refuse any noisy and unruly guests in order to protect the interests of other tenants.</li>
                        <li>For security measures, keep your unit doors locked especially when going out. The Management is not liable for lost valuables. We have a safety deposit box at the Front Desk should you want us to keep your valuables.</li>
                        <li>For Long Term stay who are about to check out, please inform the Front Desk At least a day before to prepare electricity and other unsettled payments.</li>
                        <li>Smoking is prohibited in hotel rooms. However, smokers may do so at the balcony or in any common areas outside the unit.</li>
                        <li>Pets are not allowed inside the Premises of the Hotel.</li>
                        <li>Furniture, fixtures, and other amenities are properties of the hotel. Guests are liable for loss or damage of room/unit's properties.</li>
                        <li>Lost Keys shall be charged to the guest for Php100/each. Should the keys be left inside the room, kindly inform the Front Desk for assistance.</li>
                        <li>Switch off all lights and close all water taps when going out.</li>
                        <li>Firearms, explosives, and harmful chemicals are not allowed inside the premises.</li>
                        <li>Use of prohibited drugs and other illegal activities are prohibited.</li>
                        <li>Our personnel will collect your garbage everyday between 7AM to 8AM only; you may leave your garbage in plastic bags in front of your room. Do leave your garbage outside of the door after collection time.</li>
                        <li>Please report to the Front Desk any personnel soliciting cash or tip for basic services rendered.</li>
                        <li>To avoid delay, please call the attention of the Front Desk one hour before checking out to allow our personnel to check your room amenities in accordance with our standard operating procedures.</li>
                        <li>In case of emergency, please call the attention of the Front Desk. The fire escape is located at the 'exit' areas and fire extinguishers are strategically located at every floor.</li>
                    </ol>
                </div>
                <div class="col-md-6">
                    <h1> Reservation Details </h1>
                    <h5>Check In Date: {{ $details['start_date'] }}</h5>
                    <h5>Check Out Date: {{ $details['end_date'] }}</h5>
                    <h5># of Guests: {{ $details['guests'] }} pax</h5>
                    <h5>Total Nights: {{ $diff }} </h5>
                    <br>
                    <h5>Particulars: </h5>
                    <table class="table">
                        <tr>
                            <th>Room</th>
                            <th>Quantity Requested</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                        </tr>
                        @php
                            $total = 0;
                        @endphp

                        @foreach($rooms as $room)
                            <tr>
                                <td> {{ $room->name }} </td>
                                <td> {{ $items[$room->id] }} </td>
                                <td> {{ number_format($room->daily_rate, 2) }} </td>
                                <td> {{ number_format(($room->daily_rate * $diff), 2) }} </td>
                            </tr>
                            @php
                                $total = $total + ($room->daily_rate * $diff);
                            @endphp
                        @endforeach
                    </table>
                    <h5>Total Bill: {{ number_format($total, 2) }}</h5>
                    <a href="{{ $backUrl }}" class="btn btn-primary btn-block"> Back </a>
                    {{ Form::open(['url' => '/reservation', 'method' => 'POST']) }}
                        {{Form::hidden('start_date', $details['start_date'])}}
                        {{Form::hidden('end_date', $details['end_date'])}}
                        <button class="btn btn-success btn-block">Reserve</button>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
