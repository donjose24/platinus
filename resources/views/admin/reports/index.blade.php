@extends('layouts.backend')

@section('content')
    <div class="card">
        <div class="card-header">Reports</div>
        <div class="card-body">
            <h3> Sales Reports </h3>
            <div class="row">
                <div class="col-md-4">
                    {{ Form::open(['url' => '/admin/reports/sales', 'method' => 'GET']) }}
                    {{ Form::label('start_date', 'From') }}
                    {{ Form::text('start_date', '', ['class' => 'form-control datetime-picker-admin']) }}
                    {{ Form::label('end_date', 'To') }}
                    {{ Form::text('end_date', '', ['class' => 'form-control datetime-picker-admin']) }}
                    {{ Form::label('field', 'Filter By:') }}
                    {{ Form::select('field', $salesField, 'all', ['class' => 'form-control']) }}
                    <br>
                    <button class="btn btn-custom-primary"> Print </button>
                    {{ Form::close() }}
                </div>
            </div>
            <hr>
            <h3> Reservations </h3>
            <div class="row">
                <div class="col-md-4">
                    {{ Form::open(['url' => '/admin/reports/reservation', 'method' => 'GET']) }}
                    {{ Form::label('status', 'Status') }}
                    {{ Form::select('status', ['all' => 'All', 'approved' => 'Approved', 'checked_in' => 'Checked In', 'checked_out' => 'Checked Out', 'cancelled' => 'Cancelled', 'rebooked' => 'Rebooked'], '', ['class' => 'form-control']) }}
                    {{ Form::label('start_date', 'From') }}
                    {{ Form::text('start_date', '', ['class' => 'form-control datetime-picker-admin']) }}
                    {{ Form::label('end_date', 'To') }}
                    {{ Form::text('end_date', '', ['class' => 'form-control datetime-picker-admin']) }}
                    <br>
                    <button class="btn btn-custom-primary"> Print </button>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
