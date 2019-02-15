@extends('layouts.cashier')

@section('content')
    @php
        $total = 0;
        $totalAmountRoom = 0;
        $startDate = \Carbon\Carbon::createFromFormat('Y-m-d', $reservation->start_date);
    @endphp
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
                <p class="mb-0">Status: <b>{{ $reservation->status }}</b></p>
            </div>
        </div>
        <h1 class="mb-3">Rooms</h1>
        @foreach($reservation->roomTypes()->withPivot('price')->withPivot('id')->withPivot('room_number_id')->wherePivot('deleted_at', null)->get() as $room)
            <div class="card w-100 mb-0">
                <div class="card-body d-flex p-0">
                    <div class="w-25 p-3 border-right border-bottom">
                        <h5 class="mb-2 font-weight-bold">{{ $room->name }}</h5>
                        <p class="mb-0">PHP {{ number_format($room->pivot->price, 2) }} per night</p>
                    </div>
                    <div class="w-25 p-3 border-right border-bottom">
                        <p class="mb-2">Total</p>
                        <h5 class="mb-0 font-weight-bold">PHP {{ number_format($room->pivot->price * $diff, 2) }}</h5>
                    </div>
                    <div class="w-25 p-3 border-right border-bottom">
                        <div class="mb-2"> Room Number</div>
                        @php
                            if($room->pivot->room_number_id == 0) {
                                    $rooms = $room->rooms()->where('status', 'ready')->pluck('number', 'id');
                                    $rooms[-1] = "Please select a room";
                                    echo Form::open(['url' => '/cashier/reservation/reserve']);
                                    echo Form::select('room', $rooms, '-1', ['class' => 'form-control']);
                                    echo Form::hidden('room_type', $room->id);
                                    echo Form::hidden('id', $room->pivot->id);
                                    echo '<br><div class="form-check">';
                                    echo Form::checkbox('senior_discount', 'apply', false, ['class' => 'form-check-input']);
                                    echo Form::label('senior_discount', "Apply PWD/Senior discount? ", ['class' => 'form-check-label']);
                                    echo '</div>';
                                    echo '<button class="btn btn-primary mt-2 float-right">Reserve</button>';
                                    echo Form::close();
                            } else {
                                echo '<h5 class="mb-0 font-weight-bold">'. \App\Room::find($room->pivot->room_number_id)->number . ' </h5>';
                            }
                            $total += ($room->pivot->price * $diff);
                            $totalAmountRoom += ($room->pivot->price * $diff);
                        @endphp
                    </div>
                    <div class="w-25 p-3 border-bottom">
                        <p class="mb-2">Actions</p>
                        @if($reservation->status == "checked_in")
                            <button class="btn btn-success edit-button" data-id="{{ $room->id }}" data-reservation="{{ $room->pivot->id }}"> Edit </button>
                            <button class="btn btn-danger delete-button" data-reservation="{{ $room->pivot->id }}"> Delete </button>
                        @endif
                        <button class="btn btn-success upgrade-button" data-id="{{ $room->id }}" data-reservation="{{ $reservation->id }}" data-reservation-room="{{ $room->pivot->id }}"> Upgrade/Downgrade Room </button>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="text-right mt-3">
            @if($reservation->status != "checked_out")
                <a href="#" class="btn btn-success p-2 w-25 add-new-room mt-2"> Add Room </a>
            @endif
            @if($reservation->status == "approved" && $startDate->gte(\Carbon\Carbon::today()))
                {{ Form::open(['url' => '/cashier/checkin']) }}
                    <button class="btn btn-success w-25 p-2 mt-2"> Check In </button>
                    {{ Form::hidden('id', $reservation->id) }}
                {{ Form::close() }}
            @endif
        </div>

        @php
            $totalPaid = 0;
        @endphp
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
                        <div class="w-25 p-3 border-bottom border-right">
                            <p class="mb-2">Date Added</p>
                            <p class="mb-0 font-weight-bold">{{ date_format($transaction->created_at, "F d, Y h:iA") }}</p>
                        </div>
                        <div class="w-25 p-3 border-bottom">
                            @if($transaction->item != "Bank Deposit")
                                <p class="mb-2">Actions</p>
                                @if($transaction->status != "paid")
                                    <a href="/cashier/reservation/settle/{{ $transaction->id }}" class="btn btn-success">Settle</a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                @php
                    if($transaction->item != "Bank Deposit" && $transaction->item != "Balance Payment") {
                        $total += $transaction->price;
                    }
                    if ($transaction->status == "paid") {
                        $totalPaid += $transaction->price;
                    }
                @endphp
            @endforeach
        @else
            No transactions yet!
        @endif
        <div class="text-left mt-3">
            @php
                $taxAmount = $total * ($tax / 100);
                $total += $total * ($tax / 100);
            @endphp

            <h3> Total Paid: {{ number_format($totalPaid, 2) }}</h3>
            <h3> {{ $tax }}% VAT: {{ $taxAmount }} </h3>
            <h3> Total Bill: {{ number_format($total, 2) }}</h3>
            <br>
            @if($reservation->status == "checked_out")
                <a href="/cashier/reservation/print/{{ $reservation->id }}" class="btn btn-success p-2 w-25" target="_blank"> Print </a>
            @endif
            @if($reservation->status == "checked_in")
                <a href="#" class="btn btn-danger p-2 w-25 add-damages" style="color:white"> Damages / Adjustment </a>
                <a href="#" class="btn btn-info p-2 w-25 add-service" style="color:white"> Additional Services </a>
                <a href="#" class="btn btn-success p-2 mr-3 w-25 checkout"> Check Out </a>
            @endif
            @if($reservation->status != "checked_in" && $reservation->status != "checked_out" && $reservation->status != 'cancelled' && $expiration >= 15 && $reservation->status != 'refunded')
                <a href="#" class="btn btn-danger p-2 w-25 cancelReservation" style="color:white"> Cancel Reservation </a>
                <a href="#" class="btn btn-custom-default p-2 w-25 rebookBtn mt-2"> Rebook </a>
            @endif

            @if($reservation->status == "cancelled" && $totalPaid != 0)
                {{ Form::open(['url' => '/cashier/refund']) }}
                {{ Form::hidden('id', $reservation->id) }}
                {{ Form::submit('Refund ( ' . number_format($totalPaid / 2, 2)  . ' )', ['class' => 'btn btn-danger']) }}
                {{ Form::close() }}
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
                    @if($reservation->status != "cancelled" && $reservation->status != 'refunded')
                        <button class="btn btn-primary mt-2"> Add Room </button>
                    @endif
                    {{ Form::close() }}
                </div>
            </div>
        @endforeach
    </div>
    <div id="addServices" title="Add Services">
        Additional Services:
        @foreach ($services as $service)
            {{ Form::open(['url' => '/cashier/reservation/services']) }}
            <h3>{{ Form::label('name', $service->name ) }}</h3>
            <h5>{{ Form::label('price', number_format($service->price, 2)) }}</h5>
            Quantity
            <input class="spinner" readonly name="quantity" min="1" value="1" max="" type="number">
            {{ Form::hidden('name', $service->name) }}
            {{ Form::hidden('price', $service->price) }}
            {{ Form::hidden('reservation_id', $reservation->id) }}
            <button class="btn btn-primary mt-2"> Add </button>
            <hr>
            {{ Form::close() }}
        @endforeach
    </div>
    <div id="addDamages" title="Add Damages">
        Add Damages:
        {{ Form::open(['url' => '/cashier/reservation/services']) }}
        {{ Form::label('name', "Name") }}
        {{ Form::text('name', '', ['class' => 'form-control']) }}
        {{ Form::label('price', 'Amount') }}
        {{ Form::number('price', '', ['class' => 'form-control']) }}
        {{ Form::hidden('quantity', 1) }}
        {{ Form::hidden('reservation_id', $reservation->id) }}
        <button class="btn btn-primary mt-2"> Save </button>
        {{ Form::close() }}
    </div>
    <div id="checkoutModal" title="Checkout">
        @php
            $dt = new DateTime();
            $endDate = \DateTime::createFromFormat('Y-m-d', $reservation->end_date);
            $endDate->setTime(12, 0);
        @endphp
        {{ Form::open(['url' => '/cashier/reservation/checkout/']) }}
        <p>Customer's Remaining Balance: <b>{{ number_format($total - $totalPaid, 2) }}</b></p>
        <p>All unsettled transactions will be marked as settled. Are you sure you want to checkout?</p>

        {{ Form::hidden('id', $reservation->id) }}
        <br>
        <button href="/cashier/reservation/checkout/{{ $reservation->id }}" class="btn btn-primary"> Check Out </button>
        <button href="#" class="btn btn-secondary cancel">Cancel</button>
        {{ Form::close() }}


    </div>
    <div id="cancelDialog" title="Cancel Reservation">
        {{ Form::open(['url' => '/cashier/reservation/cancel']) }}
            {{ Form::label('confirmation', 'Are you sure you want to cancel this reservation?') }}
            {{ Form::hidden('id', $reservation->id) }}
            {{ Form::submit('Yes', ['class' => 'btn btn-danger mt-2']) }}
            {{ Form::submit('Back', ['class' => 'btn btn-primary mt-2 back-cancel']) }}
        {{ Form::close() }}
    </div>
    <div id="showUpgrade" title="Upgrade Room">
        {{ Form::open(['url' => '/cashier/upgrade-room/save']) }}
            {{ Form::label('room_type_id', 'Please select a room') }}
            {{ Form::select('room_type_id', [], null, ['id' => 'room_type_id', 'class' => 'form-control']) }}
            {{ Form::hidden('reservation_room_id', $reservation->id, ['id' => 'reservation_room_id']) }}
            <button class="btn btn-primary mt-2 float-right"> Upgrade </button>
        {{ Form::close() }}
    </div>
    <div id="showRebook" title="Rebooking">
        {{ Form::open(['url' => '/cashier/rebook', 'method' => 'get']) }}
            {{ Form::label('start_date', 'Start Date') }}
            {{ Form::date('start_date', '', ['class' => 'form-control', 'min'=>\Carbon\Carbon::now()->format("Y-m-d"), 'required' => 'true' ]) }}
            {{ Form::label('end_date', 'End Date') }}
            {{ Form::date('end_date', '', ['class' => 'form-control', 'min'=>\Carbon\Carbon::now()->format("Y-m-d"), 'required' => 'true' ]) }}
            {{ Form::hidden('reservation_id', $reservation->id) }}
            <button class="btn btn-primary mt-2 float-right"> Rebook </button>
         {{ Form::close() }}
    </div>
@endsection
