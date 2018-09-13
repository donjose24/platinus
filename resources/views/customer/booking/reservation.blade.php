@extends('layouts.customer')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Reservation Now</div>
                    <div class="card-body">
                        <div class="reservation-container">
                            {{ Form::open(['url' => '/room/search', 'method' => 'get']) }}
                            <li><label class="d-block" for="start_date">Start Date</label><input type="text" name="start_date" value="" placeholder="From" class="datetime-picker" /></li>
                            <li><label class="d-block" for="end_date">End Date</label><input type="text" name="end_date" placeholder="To" value="" class="datetime-picker" /></li>
                            <li><label class="d-block" for="adults">Number of Persons</label><input readonly type="number" name="adults" value="" class="no-guest spinner" /></li>
                            <li><button class="btn btn-custom-default w-100">Book Now</button></li>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
