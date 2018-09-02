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
            <fieldset>
                <legend>Reservation Details</legend>
                <h6> Customer: {{ $reservation->user->name }} </h6>
                <h6> Email: {{ $reservation->user->email }} </h6>
                <h6> Check In: {{ $reservation->start_date }} </h6>
                <h6> Check Out: {{ $reservation->end_date }} </h6>
                <h6> Number of Nights: {{ $diff }} </h6>
            </fieldset>
            <fieldset class="mt-5">
                <legend> Rooms: </legend>
                <table class="table table-bordered">
                    <tr>
                        <td>Room Name</td>
                        <td>Unit price per night</td>
                        <td>Price</td>
                    </tr>
                    @php
                        $total = 0
                    @endphp
                    @foreach($reservation->roomTypes()->get() as $room)
                        <tr>
                            <td> {{ $room->name }} </td>
                            <td> {{ number_format($room->daily_rate, 2) }} </td>
                            <td> {{ number_format($room->daily_rate * $diff, 2) }} </td>
                            @php
                                $total += ($room->daily_rate * $diff)
                            @endphp
                        </tr>
                    @endforeach
                </table>
                <h5 class="float-right">Grand Total: {{ number_format($total, 2) }}</h5>
            </fieldset>
            <fieldset class="mt-5">
                <legend>Transactions</legend>
                @if(count($reservation->transactions()->get()) != 0)
                    <table class="table table-bordered">
                        <tr>
                            <td>Item</td>
                            <td>Price</td>
                            <td>Date Paid</td>
                        </tr>
                        @foreach($reservation->transactions()->get() as $transaction)
                            <tr>
                                <td> {{ $transaction->item }} </td>
                                <td> {{ number_format($transaction->price, 2) }} </td>
                                <td> {{ $transaction->created_at }} </td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    No transactions yet!
                @endif

            </fieldset>
            <fieldset class="mt-5">
                <legend> Actions </legend>
                <h6>Deposit Slip:</h6>
                <img class="image" src="{{ $reservation->deposit_slip }}">
                <div class="row">
                    <div class="col-md-12">
                        {{ Form::label('Amount Deposited') }}
                        {{ Form::open(['url' => '/cashier/deposit/approve']) }}
                        {{ Form::number('amount', '', ['class' => 'form-control']) }}
                        {{ Form::hidden('id', $reservation->id) }}
                        <button class="btn btn-success mt-2 float-md-right"> Check In </button>
                        {{ Form::close() }}
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
@endsection
