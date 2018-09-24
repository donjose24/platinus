@extends('layouts.front')

@section('content')
    <div class="home-content">
        <h1 class="welcome-text">Experience leisure and recreation within the hustle of Barretto ,Olongapo City</h1>
        <div class="reservation-container">
            @include('search-bar')
        </div>
    </div>
    <div class="welcome-content">
        <div class="page-content reservation-content">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1>Available Rooms</h1>
                @if(Session::has('items') )
                    <div class="d-flex justify-content-between">
                        <a href="/reservation/clear" class="btn d-block mr-2 w-100 p-2 btn-danger">Clear your selection</a>
                        <a href="/reservation/checkout" class="btn d-block w-100 p-2 btn-custom-default">Reserve</a>
                    </div>
                @endif
            </div>
            <div class="d-flex justify-content-between flex-wrap">
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

                            <h4 class="font-weight-bold card-title">{{ $type->name }}</h4>
                            <h5 class="font-weight-bold sub-card-title">{{ $type->capacity }} persons</h5>
                            <h6 class="font-weight-bold card-text">{{ $type->validRooms()->count() - (array_key_exists($type->id, $rooms) ? $rooms[$type->id] : 0) }} room(s) remaining</h6>
                            <p class="card-text room-desc">{{ $type->description }}</p>
                            <h5 class="font-weight-bold mb-3 room-price">PHP {{ number_format($type->daily_rate) }} per night</h5>
                            @if(Session::has('items'))
                                @if(array_key_exists($type->id, Session::get('items')))
                                    <button class="btn w-100 p-2 btn-danger">Remove Room</button>
                                @else
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="font-weight-bold room-price mr-2"> Number of persons </h5>
                                        <input class="spinner" readonly name="pax" min="0" value="0" max="{{ $type->capacity }}" type="number">
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <input class="spinner" name="value" min="0" value="0" max="{{ $type->validRooms()->count() - (array_key_exists($type->id, $rooms) ? $rooms[$type->id] : 0) }}" type="number">
                                        <button class="btn ml-2 w-75 p-2 btn-custom-primary add-room">Add Room</button>
                                    </div>
                                @endif
                            @else
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="font-weight-bold room-price mr-2"> Number of persons </h5>
                                    <input class="spinner" readonly name="pax" min="0" value="0" max="{{ $type->capacity }}" type="number">
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <button class="btn mr-2 w-75 p-2 btn-custom-primary add-room">Add Room</button>
                                    <input class="spinner" readonly name="value" min="0" value="0" max="{{ $type->validRooms()->count() - (array_key_exists($type->id, $rooms) ? $rooms[$type->id] : 0) }}" type="number">
                                </div>
                            @endif
                            <input class="room-id" type="hidden" name="id" value="{{ $type->id }}">
                            {{ Form::close() }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection