@extends('layouts.cashier')

@section('content')
    <div class="view-content">
        <h1 class="mb-3">Reservation Details of: {{ strtoupper($reservation->code) }}</h1>
        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <div class="panel">
            <fieldset>
                <legend>Reservation Details</legend>
                <h6> Customer: {{ $reservation->user->name }} </h6>
                <h6> Email: {{ $reservation->user->email }} </h6>
                <h6> Check In: {{ $reservation->start_date }} </h6>
                <h6> Check Out: {{ $reservation->end_date }} </h6>
                <h6> Number of Nights: {{ $diff }} </h6>
            </fieldset>
            <fieldset class="mt-5">
                <legend> Rooms: </legend>
                {{ Form::open(['url' => '/cashier/checkin']) }}
                <table class="table table-bordered">
                    <tr>
                        <td>Room Name</td>
                        <td>Unit price per night</td>
                        <td>Price</td>
                        <td>Room Number</td>
                    </tr>
                    @php
                        $total = 0
                    @endphp
                    @foreach($reservation->roomTypes()->get() as $room)
                        <tr>
                            <td class="p-3"> {{ $room->name }} </td>
                            <td class="p-3"> {{ number_format($room->daily_rate, 2) }} </td>
                            <td class="p-3"> {{ number_format($room->daily_rate * $diff, 2) }} </td>
                            <td>
                                @php
                                    $ids = $room->rooms()->where('status', 'active')->pluck('id');
                                    $details = \App\ReservationRoomDetail::where('reservation_id', $reservation->id)->whereIn('id', $ids)->get();
                                    if (count($details) == 0) {
                                        $reservations = \App\Reservation::where('start_date', \Carbon\Carbon::today())->where('status', 'checked_in')->pluck('id');
                                        $details = \App\ReservationRoomDetail::whereIn('reservation_id', $reservations)->pluck('room_id');
                                        $rooms = [];
                                        $rooms = $room->rooms()->where('status', 'active')->whereNotIn('id', $details)->pluck('number','id');
                                        $rooms[-1] = "Please select a room";
                                        echo Form::select('rooms[]', $rooms, '-1', ['class' => 'form-control']);
                                    } else {

                                    }

                                @endphp
                                {{ Form::hidden('reservation_id', $reservation->id) }}
                            </td>
                            @php
                                $total += ($room->daily_rate * $diff)
                            @endphp
                        </tr>
                    @endforeach
                </table>
                <h5 class="float-right">Grand Total: {{ number_format($total, 2) }}</h5>
                <br>
                <br>
                @if($reservation->status == "approved")
                    <button class="btn btn-custom-default float-right"> Check In </button>
                @endif
                {{ Form::close() }}
            </fieldset>
            <fieldset class="mt-5">
                <legend>Transactions</legend>
                @if(count($reservation->transactions()->get()) != 0)
                    <table class="table table-bordered">
                        <tr>
                            <td>Item</td>
                            <td>Price</td>
                            <td>Date Paid</td>
                        </tr>
                        @foreach($reservation->transactions()->get() as $transaction)
                            <tr>
                                <td> {{ $transaction->item }} </td>
                                <td> {{ number_format($transaction->price, 2) }} </td>
                                <td> {{ $transaction->created_at }} </td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    No transactions yet!
                @endif
            </fieldset>
        </div>
    </div>
@endsection
