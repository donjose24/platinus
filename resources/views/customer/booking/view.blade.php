@extends('layouts.customer')
@section('content')
    <div class="view-content">
        <h1 class="mb-3">Reservation Details</h1>
        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <div class="panel">
            <fieldset>
                <h6> Customer: {{ $reservation->user->name }} </h6>
                <h6> Email: {{ $reservation->user->email }} </h6>
                <h6> Check In: {{ $reservation->start_date }} </h6>
                <h6> Check Out: {{ $reservation->end_date }} </h6>
                <h6> Number of Nights: {{ $diff }} </h6>
                <h6> Rooms: </h6>
                <table class="table">
                    <tr>
                        <td>Room Name</td>
                        <td>Unit Price</td>
                        <td>Price</td>
                    </tr>
                    @php
                        $total = 0
                    @endphp
                    @foreach($reservation->roomTypes()->get() as $room)
                        <tr>
                            <td> {{ $room->name }} </td>
                            <td>PHP {{ number_format($room->daily_rate, 2) }}</td>
                            <td>PHP {{ number_format($room->daily_rate * $diff, 2) }} </td>
                            @php
                                $total += ($room->daily_rate * $diff);
                            @endphp
                        </tr>
                    @endforeach
                </table>
                @php
                    $tax = setting('tax');
                    $taxAmount = $total * ($tax / 100);
                    $total += $total * ($tax / 100);
                @endphp
                <h4> VAT: PHP {{ number_format($taxAmount, 2) }}</h4>
                <h4>Grand Total: PHP {{ number_format($total, 2) }}</h4>
                @if($reservation->status != "checked_in" && $reservation->status != "checked_out" && $reservation->status != 'cancelled' && $diff >= 15)
                    <a href="#" class="btn btn-danger p-2 w-25 cancelReservation" style="color:white"> Cancel Reservation </a>
                @endif
            </fieldset>
            <br>
            <br>
        </div>
    </div>
    <div id="cancelDialog" title="Cancel Reservation">
        {{ Form::open(['url' => '/customer/reservation/cancel']) }}
        {{ Form::label('confirmation', 'Are you sure you want to cancel this reservation?') }}
        {{ Form::hidden('id', $reservation->id) }}
        {{ Form::submit('Yes', ['class' => 'btn btn-danger mt-2']) }}
        {{ Form::submit('Back', ['class' => 'btn btn-primary mt-2 back-cancel']) }}
        {{ Form::close() }}
    </div>
@endsection
