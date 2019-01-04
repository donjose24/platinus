@extends('layouts.cashier')

@section('content')
    <div class="view-content">
        <br>
        <div class="d-flex justify-content-between flex-wrap">
            {{ Form::open(['url' => '/cashier/walk-in/reservation/checkout', 'method' => 'POST']) }}
            <div class="row">
                <div class="col-md-6">
                    <h1 class="mb-2">Reservation Details</h1>
                    <div class="checkout-container">
                        <h5 class="d-flex justify-content-between"><span>Check In Date:</span><span class="full-date">{{ $details['start_date'] }}</span></h5>
                        <h5 class="d-flex justify-content-between"><span>Check Out Date:</span><span class="full-date">{{ $details['end_date'] }}</span></h5>
                        <h5 class="d-flex justify-content-between"><span>No. of Nights:</span><span>x{{ $diff }} </span></h5>
                        <br>
                        <h5>Particulars: </h5>
                        <table class="table">
                            <tr>
                                <th>Room</th>
                                <th>Quantity Requested</th>
                                <th>Unit Price</th>
                                <th>Total Price</th>
                            </tr>
                            @php
                                $total = 0;
                            @endphp

                            @foreach($rooms as $room)
                                <tr>
                                    <td> {{ $room->name }} </td>
                                    <td> {{ $items[$room->id] }} </td>
                                    <td>PHP {{ number_format($room->daily_rate, 2) }} </td>
                                    <td>PHP {{ number_format((($room->daily_rate * $items[$room->id]) * $diff), 2) }} </td>
                                </tr>
                                @php
                                    $total = $total + ($room->daily_rate * $diff);
                                    $taxAmount = $total * ($tax / 100);
                                @endphp
                            @endforeach
                        </table>
                        <h5> {{$tax}}% VAT: PHP {{ $taxAmount }} </h5>
                        <h5>Total Bill: PHP {{ number_format($total + $taxAmount, 2) }}</h5>

                    </div>
                </div>
                <div class="col-md-5 offset-1">
                    <h1 class="mb-2">User Details</h1>
                    <div class="form-group">
                        <input
                                id="name"
                                type="text"
                                class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                autofocus
                                placeholder="Name"
                        >

                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <input
                                id="email"
                                type="email"
                                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                placeholder="Email"
                        >

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                        @endif
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ $backUrl }}" class="btn btn-secondary font-weight-normal"><i class="fa fa-arrow-left mr-2" aria-hidden="true"></i>Back </a>
                        <button class="btn btn-success">Confirm</button>
                    </div>
                   {{ Form::close() }}
                </div>
            </div>
        </div>
@endsection
