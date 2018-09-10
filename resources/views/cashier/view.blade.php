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
                <h6> Rooms: </h6>
                <table class="table">
                    <tr>
                        <td>Room Name</td>
                        <td>Price</td>
                    </tr>
                    @php
                        $total = 0
                    @endphp
                    @foreach($reservation->roomTypes()->get() as $room)
                        <tr>
                            <td> {{ $room->name }} </td>
                            <td> {{ number_format($room->daily_rate * $diff, 2) }} </td>
                            @php
                                $total += ($room->daily_rate * $diff)
                            @endphp
                        </tr>
                    @endforeach
                </table>
                <h4>Grand Total: {{ number_format($total, 2) }}</h4>
            </fieldset>
            <br>
            <br>
            <fieldset>
                <legend> Actions </legend>
                <h6>Deposit Slip:</h6>
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ $reservation->deposit_slip }}">
                    </div>
                    <div class="col-md-6">
                        <div>
                            {{ Form::open(['url' => '/cashier/deposit/approve']) }}
                                {{ Form::label('Amount Deposited') }}
                                {{ Form::number('amount', '', ['class' => 'form-control']) }}
                                {{ Form::hidden('id', $reservation->id) }}
                                <div class="d-flex justify-content-end"><button class="btn btn-custom-primary mt-2 mb-3"> Approve </button></div>
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
