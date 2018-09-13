@extends('layouts.cashier')

@section('content')
    <div class="view-content">
        <h1 class="mb-3">Reservation details</h1>
        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <div class="card w-100 mb-4">
            <div class="card-body">
                <h2 class="mb-4 font-weight-bold">{{ strtoupper($reservation->code) }}</h2>
                <h5 class="font-weight-bold mb-3">{{ $reservation->user->name }}</h5>
                <p class="mb-1">{{ $reservation->user->email }}</p>
                <p class="mb-1">
                    <span class="full-date mr-2">{{ $reservation->start_date }}</span>
                    <i class="fa fa-arrow-right"></i>
                    <span class="full-date ml-2">{{ $reservation->start_date }}</span>
                </p>
                <p class="mb-0">{{ $diff }} Night/s</p>

            </div>
        </div>
        <h1 class="mb-3">Rooms</h1>
        {{ Form::open(['url' => '/cashier/checkin']) }}
        @foreach($reservation->roomTypes()->withPivot('price')->get() as $room)
            <div class="card w-100 mb-0">
                <div class="card-body d-flex p-0">
                    <div class="w-25 p-3 border-right border-bottom">
                        <h5 class="mb-2 font-weight-bold">{{ $room->name }}</h5>
                        <p class="mb-0">PHP {{ number_format($room->pivot->price, 2) }} per night</p>
                    </div>
                    <div class="w-25 p-3 border-right border-bottom">
                        <p class="mb-2">Total</p>
                        <h5 class="mb-0 font-weight-bold">PHP {{ number_format($room->daily_rate * $diff, 2) }}</h5>
                    </div>
                    <div class="w-25 p-3 border-right border-bottom d-flex align-items-center">
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
                                //todo display stuff
                            }

                        @endphp
                        {{ Form::hidden('reservation_id', $reservation->id) }}
                    </div>
                    <div class="w-25 p-3 border-bottom d-flex align-items-center justify-content-end">
                        <div class="custom-form-input-check align-items-center justify-content-center">
                            <input type="checkbox" id="checkIn-1"><label for="checkIn-1">Toggle</label>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @if($reservation->status == "approved")
            <div class="text-right mt-4"><button class="btn btn-custom-default w-25 p-2"> Check In </button></div>
        @endif
        {{ Form::close() }}

        <h1 class="mb-3">Transactions</h1>
        @if(count($reservation->transactions()->get()) != 0)
            @foreach($reservation->transactions()->get() as $transaction)
                <div class="card w-100 mb-0">
                    <div class="card-body d-flex p-0">
                        <div class="w-25 p-3 border-right border-bottom">
                            <p class="mb-2">Item</p>
                            <p class="mb-0 font-weight-bold">{{ $transaction->item }}</p>
                        </div>
                        <div class="w-25 p-3 border-right border-bottom">
                            <p class="mb-2">Price</p>
                            <p class="mb-0 font-weight-bold">{{ number_format($transaction->price, 2) }}</p>
                        </div>
                        <div class="w-50 p-3 border-bottom">
                            <p class="mb-2">Date Paid</p>
                            <p class="mb-0 font-weight-bold">{{ date_format($transaction->created_at, "F d, Y h:iA") }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            No transactions yet!
        @endif
        <div class="text-right mt-3">
            <a href="/cashier/reservation/print/{{ $reservation->id }}" class="btn btn-custom-default p-2 w-25" target="_blank"> Print </a>
            @if($reservation->status == "checked_in")
                <a href="/cashier/reservation/checkout/{{ $reservation->id }}" class="btn btn-custom-primary p-2 mr-3 w-25"> Check Out </a>
            @endif
        </div>
    </div>
@endsection
