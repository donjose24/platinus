@extends('layouts.customer')

@section('content')
    <h2 class="font-weight-bold">Reserve Now</h2>
    {{ Form::open(['url' => '/room/search', 'method' => 'get']) }}
    <div class="card">
        <div class="card-body">
            <div class="reservation-container reserve-now d-flex justify-content-between">
                <div class="w-25 d-flex flex-column justify-content-between"><label class="d-block" for="start_date">Start Date</label><input type="text" name="start_date" value="" placeholder="From" class="w-100 datetime-picker" /></div>
                <div class="w-25 d-flex flex-column justify-content-between"><label class="d-block" for="end_date">End Date</label><input type="text" name="end_date" placeholder="To" value="" class="w-100 datetime-picker" /></div>
            </div>
        </div>
    </div>
    <div class="text-right mt-3"><button class="btn btn-success w-25">Book Now</button></div>
    {{ Form::close() }}
@endsection
