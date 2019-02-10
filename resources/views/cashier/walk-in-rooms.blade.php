@extends('layouts.cashier')

@section('content')
    <div class="view-content">
        <h1 class="mb-3">Create new reservation</h1>
        <div class="d-flex justify-content-between flex-wrap">
            @if(Session::has('items') )
                <a href="/cashier/walk-in/reservation/preview" class="btn d-block w-100 p-2 btn-success">Reserve</a>
            @endif
            @foreach($roomTypes as $type)
                <div class="card reservation-room">
                    <div class="position-relative card-img-top-container">
                        <img class="card-img-top w-100" src="{{ $type->image_url }}">
                    </div>

                    <div class="card-body">
                        @if(Session::has('items'))
                            @if(array_key_exists($type->id, Session::get('items')))
                                {{ Form::open(['url' => '/cashier/walk-in/remove-reservation', 'method' => 'POST']) }}
                            @else
                                {{ Form::open(['url' => '/cashier/walk-in/reservation/add', 'method' => 'POST']) }}
                            @endif
                        @else
                            {{ Form::open(['url' => '/cashier/walk-in/reservation/add', 'method' => 'POST']) }}
                        @endif
                        <h4 class="font-weight-bold card-title">{{ $type->name }}</h4>
                        <h5 class="font-weight-bold sub-card-title">{{ $type->capacity }} persons</h5>
                        <h6 class="font-weight-bold card-text">{{ $type->validRooms()->count() - (array_key_exists($type->id, $rooms) ? $rooms[$type->id] : 0) }} room(s) remaining</h6>
                        <p class="card-text room-desc">{{ $type->description }}</p>
                        <h5 class="font-weight-bold mb-3 room-price">PHP {{ number_format($type->daily_rate) }} per night</h5>
                        @if(Session::has('items'))
                            @if(array_key_exists($type->id, Session::get('items')))
                                <button class="btn w-100 p-2 btn-danger">Remove Room</button>
                            @else
                                <div class="d-flex justify-content-between align-items-center">
                                    <input class="spinner" name="value" min="0" value="0" max="{{ $type->validRooms()->count() - (array_key_exists($type->id, $rooms) ? $rooms[$type->id] : 0) }}" type="number">
                                    <button class="btn ml-2 w-75 p-2 btn-success add-room">Add Room</button>
                                </div>
                            @endif
                        @else
                            <div class="d-flex justify-content-between align-items-center">
                                <button class="btn mr-2 w-75 p-2 btn-success add-room">Add Room</button>
                                <input class="spinner" readonly name="value" min="0" value="0" max="{{ $type->validRooms()->count() - (array_key_exists($type->id, $rooms) ? $rooms[$type->id] : 0) }}" type="number">
                            </div>
                        @endif
                        <input class="room-id" type="hidden" name="id" value="{{ $type->id }}">
                        {{ Form::hidden('check_out_date', $checkOutDate) }}
                        {{ Form::close() }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
