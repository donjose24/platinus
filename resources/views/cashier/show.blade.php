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
                    <span class="full-date ml-2">{{ $reservation->end_date }}</span>
                </p>
                <p class="mb-0">{{ $diff }} Night/s</p>

            </div>
        </div>
        <h1 class="mb-3">Rooms</h1>
        {{ Form::open(['url' => '/cashier/checkin']) }}
        @foreach($reservation->roomTypes()->withPivot('price')->withPivot('id')->withPivot('room_number_id')->wherePivot('deleted_at', null)->get() as $room)
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
                    <div class="w-25 p-3 border-right border-bottom">
                        <div class="mb-2"> Room Number</div>
                        @php
                            if($reservation->status == "approved") {
                                $rooms = $room->rooms()->where('status', 'ready')->pluck('number', 'id');
                                $rooms[-1] = "Please select a room";
                                echo Form::select('rooms[]', $rooms, '-1', ['class' => 'form-control']);
                            } else {
                                echo '<h5 class="mb-0 font-weight-bold">'. \App\Room::find($room->pivot->room_number_id)->number . ' </h5>';
                            }
                        @endphp
                        {{ Form::hidden('ids[]', $room->pivot->id) }}
                    </div>
                    <div class="w-25 p-3 border-bottom">
                        @if($reservation->status == "checked_in")
                            <p class="mb-2">Actions</p>
                            <button class="btn btn-custom-default edit-button" data-id="{{ $room->id }}" data-reservation="{{ $room->pivot->id }}"> Edit </button>
                            <button class="btn btn-danger delete-button" data-reservation="{{ $room->pivot->id }}"> Delete </button>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
        @if($reservation->status == "approved")
            <div class="text-right mt-4"><button class="btn btn-custom-default w-25 p-2"> Check In </button></div>
        @endif
        {{ Form::hidden('reservation_id', $reservation->id) }}
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
            <a href="#" class="btn btn-success p-2 w-25 add-room"> Add Room </a>
            <a href="/cashier/reservation/print/{{ $reservation->id }}" class="btn btn-custom-default p-2 w-25" target="_blank"> Print </a>
            @if($reservation->status == "checked_in")
                <a href="/cashier/reservation/checkout/{{ $reservation->id }}" class="btn btn-custom-primary p-2 mr-3 w-25"> Check Out </a>
            @endif
        </div>
    </div>
    <div id="editDialog" title="Edit Room">
        {{ Form::open(['url' => '/cashier/reservation/room/edit']) }}
        {{ Form::label('label', 'Room Number') }}
        {{ Form::select('number', [], '', ['class' => 'form-control', 'id' => 'editRoom']) }}
        {{ Form::hidden('room_id', '', ['id' => 'editRoomID']) }}
        {{ Form::hidden('reservation_id', '', ['id' => 'editReservationID']) }}
        {{ Form::submit('Save', ['class' => 'btn btn-primary mt-2', 'disabled' => 'true','id' => 'editSubmitButton']) }}
        {{ Form::close() }}
    </div>
    <div id="deleteDialog" title="Delete Room">
        {{ Form::open(['url' => '/cashier/reservation/room/delete']) }}
        {{ Form::label('confirmation', 'Are you sure you want to delete this room?') }}
        {{ Form::hidden('reservation_id', '', ['id' => 'deleteReservationID']) }}
        {{ Form::submit('Yes', ['class' => 'btn btn-danger mt-2']) }}
        {{ Form::submit('Back', ['class' => 'btn btn-primary mt-2 back']) }}
        {{ Form::close() }}
    </div>
    <div id="addDialog" title="Add Room">
        @foreach($roomTypes as $type)
            <div class="card reservation-room">
                <div class="card-body">
                    {{ Form::open(['url' => '/cashier/reservation/room']) }}
                    <h4 class="font-weight-bold card-title">{{ $type->name }}</h4>
                    <h5 class="font-weight-bold sub-card-title">{{ $type->capacity }} persons</h5>
                    <p class="card-text room-desc">{{ $type->description }}</p>
                    <h5 class="font-weight-bold mb-3 room-price">PHP {{ number_format($type->daily_rate) }} per night</h5>
                    <input class="room-id" type="hidden" name="id" value="{{ $type->id }}">
                    @php
                        $rooms = $type->rooms()->where('status', 'ready')->pluck('number', 'id');
                    @endphp
                    {{ Form::select('room_id', $rooms, '', ['class' => 'form-control']) }}
                    {{ Form::hidden('reservation_id', $reservation->id) }}
                    {{ Form::hidden('room_type_id', $type->id) }}
                    <button class="btn btn-primary mt-2"> Add Room</button>
                    {{ Form::close() }}
                </div>
            </div>
        @endforeach
    </div>
@endsection
