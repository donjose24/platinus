@extends('layouts.front')

@section('content')
    <div class="home-content">
        <h1 class="welcome-text">Experience leisure and recreation within the hustle of Barretto ,Olongapo City</h1>
        <div class="reservation-container">
            {{Form::open(['url' => '/room/search', 'method' => 'get'])}}
            <ul>
                <li><input type="text" name="start_date" value="{{$from}}" placeholder="From" class="datetime-picker" /></li>
                <li><input type="text" name="end_date" placeholder="To" value="{{$to}}" class="datetime-picker" /></li>
                <li><input type="text" name="guests" placeholder="No. of guests" value="{{$guests}}" class="no-guest" /></li>
                <li><button class="btn-book-now">Book Now</button></li>
            </ul>
            {{Form::close()}}
        </div>
    </div>
    <div class="welcome-content">
        <h1>Search Results</h1>
        <div class="welcome-description">
            @if(count($roomTypes) == 0)
                No Rooms Available!
            @else
                <div class="row">
                    @foreach($roomTypes as $type)
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="{{ $type->image_url }}" width="200px">
                                </div>
                                <div class="col-md-3">
                                    <small>{{ $type->name }}</small>
                                </div>
                                <div class="col-md-3">
                                    <small>{{ $type->description }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
