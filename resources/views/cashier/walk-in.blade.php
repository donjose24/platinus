@extends('layouts.cashier')

@section('content')
    <div class="view-content">
        <h1 class="mb-3">Select Rooms</h1>
        <div class="d-flex justify-content-between flex-wrap">
            {{ Form::open(['url' => '/cashier/walk-in/reservation', 'method' => 'get']) }}
                {{ Form::label('check_out_date', 'Check Out Date') }}
                {{ Form::date('check_out_date', '', ['class' => 'form-control', 'min'=>\Carbon\Carbon::now()->format("Y-m-d"), 'required' => 'true' ]) }}

                {{ Form::label('persons', 'Number of persons') }}
                <br>
                {{ Form::number('persons', 1, ['class' => 'form-control spinner d-block', 'min' => "1", 'required' => 'true']) }}

                <button class="btn btn-custom-primary mt-3 d-block">Show Rooms</button>
            {{ Form::close() }}
        </div>
    </div>
@endsection
