@extends('layouts.cashier')

@section('content')
    <div class="view-content">
        <h1 class="mb-3">Viewing Details Slip of: {{ $reservation->user->name }}</h1>
        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <div class="panel">
            <legend>Reservation Details</legend>
            <fieldset>
                <h6> Customer: {{ $reservation->user->name }} </h6>
                <h6> Email: {{ $reservation->user->email }} </h6>
                <h6> Check In: {{ $reservation->start_date }} </h6>
                <h6> Check Out: {{ $reservation->end_date }} </h6>
                <h6> Number of Nights: {{ $diff }} </h6>
                <h6> Deposit Requirement: PHP {{ number_format($toBeDeposited, 2) }}</h6>
            </fieldset>
            @include("table")
            <br>
            <br>
            <fieldset>
                <legend> Actions </legend>
                <h6>Deposit Slip:</h6>
                <div class="row">
                    <div class="col-md-6">
                        <img class="w-75" src="{{ $reservation->deposit_slip }}">
                    </div>
                    <div class="col-md-6">
                        <div>
                            {{ Form::open(['url' => '/cashier/deposit/approve']) }}
                                {{ Form::label('Amount Deposited') }}
                                {{ Form::number('amount', '', ['class' => 'form-control']) }}
                                {{ Form::hidden('id', $reservation->id) }}
                                <div class="d-flex justify-content-end"><button class="btn btn-success mt-2 mb-3"> Approve </button></div>
                            {{ Form::close() }}
                        </div>
                        <div>
                            {{ Form::open(['url' => '/cashier/deposit/reject']) }}
                                {{ Form::label('Reason for rejection') }}
                                {{ Form::text('reason', '', ['class' => 'form-control']) }}
                                {{ Form::hidden('id', $reservation->id) }}
                                <div class="d-flex justify-content-end"><button class="btn btn-danger mt-2"> Reject </button></div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
@endsection
