@extends('layouts.front')

@section('content')
    <div class="home-content">
        <h1 class="welcome-text">Experience leisure and recreation within the hustle of Barretto ,Olongapo City</h1>
        <div class="reservation-container">
            {{Form::open(['url' => '/room/search', 'method' => 'get'])}}
            <ul>
                <li><label for="start_date">Start Date</label><input type="text" name="start_date" value="{{$startDate}}" placeholder="From" class="datetime-picker form-control" /></li>
                <li><label for="end_date">End Date</label><input type="text" name="end_date" placeholder="To" value="{{$endDate}}" class="datetime-picker form-control" /></li>
                <li><label for="guests"># of Guests</label><input type="text" name="guests" placeholder="No. of guests" value="{{$guests}}" class="no-guest form-control" /></li>
                <li><button class="btn btn-success">Book Now</button></li>
            </ul>
            {{Form::close()}}
        </div>
    </div>
    <div class="welcome-content">
        <div class="page-content reservation-content">
            <h1>Available Rooms</h1>
            <div class="d-flex justify-content-around flex-wrap">
                @if (Session::has('flash_message'))
                    <div class="container-fluid">
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ Session::get('flash_message') }}
                        </div>
                    </div>
                @endif
                @if (Session::has('error_message'))
                    <div class="container-fluid">
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ Session::get('error_message') }}
                        </div>
                    </div>
                @endif
                @foreach($roomTypes as $type)
                    <div class="card reservation-room">
                        <div class="position-relative card-img-top-container">
                            <img class="card-img-top w-100" src="{{ $type->image_url }}">
                        </div>
                        <div class="card-body">
                            @if(Session::has('items'))
                                @if(array_key_exists($type->id, Session::get('items')))
                                    {{ Form::open(['url' => '/remove-reservation', 'method' => 'POST']) }}
                                @else
                                    {{ Form::open(['url' => '/reservation/preview', 'method' => 'POST']) }}
                                @endif
                            @else
                                {{ Form::open(['url' => '/reservation/preview', 'method' => 'POST']) }}
                            @endif

                            <h5 class="font-weight-bold card-title">{{ $type->name }}</h5>
                            <h6 class="font-weight-bold sub-card-title">{{ $type->capacity }} persons</h6>
                            <h6 class="card-text">{{ $type->validRooms()->count() - (array_key_exists($type->id, $rooms) ? $rooms[$type->id] : 0) }} room(s) remaining</h6>
                            <p class="card-text">{{ $type->description }} </p>
                            <h4 class="font-weight-bold mb-3 room-price">PHP {{ number_format($type->daily_rate) }} per night</h4>
                            @if(Session::has('items'))
                                @if(array_key_exists($type->id, Session::get('items')))
                                    <button class="btn w-100 p-2 btn-danger">Remove Room</button>
                                @else
                                    <input class="spinner" readonly name="value" min="0" value="0" max="{{ $type->validRooms()->count() - (array_key_exists($type->id, $rooms) ? $rooms[$type->id] : 0) }}" type="number">
                                    <button class="btn w-75 p-2 btn-custom-primary add-room">Add Room</button>
                                @endif
                            @else
                                <input class="spinner" readonly name="value" min="0" value="0" max="{{ $type->validRooms()->count() - (array_key_exists($type->id, $rooms) ? $rooms[$type->id] : 0) }}" type="number">
                                <button class="btn w-75 p-2 btn-custom-primary add-room">Add Room</button>
                            @endif
                            <input class="room-id" type="hidden" name="id" value="{{ $type->id }}">
                            {{ Form::close() }}
                        </div>
                    </div>
                @endforeach
                @if(Session::has('items') )
                    <a href="/reservation/clear" class="btn w-75 p-2 btn-danger">Clear your selection</a>
                    <a href="/reservation/checkout" class="btn w-75 p-2 btn-success">Checkout</a>
                @endif
            </div>
        </div>
    </div>
@endsection