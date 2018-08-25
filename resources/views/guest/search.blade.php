@extends('layouts.front')

@section('content')
    <div class="home-content">
        <h1 class="welcome-text">Experience leisure and recreation within the hustle of Barretto ,Olongapo City</h1>
        <div class="reservation-container">
            {{Form::open(['url' => '/room/search', 'method' => 'get'])}}
            <ul>
                <li><input type="text" name="start_date" value="{{$startDate}}" placeholder="From" class="datetime-picker" /></li>
                <li><input type="text" name="end_date" placeholder="To" value="{{$endDate}}" class="datetime-picker" /></li>
                <li><input type="text" name="guests" placeholder="No. of guests" value="{{$guests}}" class="no-guest" /></li>
                <li><button class="btn-book-now">Book Now</button></li>
            </ul>
            {{Form::close()}}
        </div>
    </div>
    <div class="welcome-content">
        <div class="page-content reservation-content">
            <h1>Available Rooms</h1>
            <div class="d-flex justify-content-around flex-wrap">
                @foreach($roomTypes as $type)
                    <div class="card reservation-room">
                        <div class="position-relative card-img-top-container">
                            <img class="card-img-top w-100" src="{{ $type->image_url }}">
                        </div>
                        <div class="card-body">
                            <h5 class="font-weight-bold card-title">{{ $type->name }}</h5>
                            <h6 class="font-weight-bold sub-card-title">{{ $type->capacity }} persons</h6>
                            <h6 class="card-text">{{ $type->validRooms()->count() - (array_key_exists($type->id, $rooms) ? $rooms[$type->id] : 0) }} room(s) remaining</h6>
                            <p class="card-text">{{ $type->description}} </p>
                            <h4 class="font-weight-bold mb-3 room-price">PHP {{ number_format($type->daily_rate) }} per night</h4>
                            <a href="#" class="btn w-100 p-2 btn-custom-primary">Book Now</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
