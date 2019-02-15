@extends('layouts.backend')
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
                        <td>Unit Price</td>
                        <td>Price</td>
                    </tr>
                    @php
                        $total = 0
                    @endphp
                    @foreach($reservation->roomTypes()->get() as $room)
                        <tr>
                            <td> {{ $room->name }} </td>
                            <td>PHP {{ number_format($room->daily_rate, 2) }}</td>
                            <td>PHP {{ number_format($room->daily_rate * $diff, 2) }} </td>
                            @php
                                $total += ($room->daily_rate * $diff);
                            @endphp
                        </tr>
                    @endforeach
                </table>
                @php
                    $totalPaid = 0;
                @endphp
                <h1 class="mb-3">Transactions</h1>
                @if(count($reservation->transactions()->get()) != 0)
                    @foreach($reservation->transactions()->get() as $transaction)
                        <div class="card w-100 mb-0">
                            <div class="card-body d-flex p-0">
                                <div class="w-25 p-3 border-right border-bottom">
                                    <p class="mb-2">Item</p>
                                    <p class="mb-0 font-weight-bold">{{ $transaction->item }}</p>
                                </div>
                                <div class="w-25 p-3 border-right border-bottom">
                                    <p class="mb-2">Price</p>
                                    <p class="mb-0 font-weight-bold">{{ number_format($transaction->price, 2) }}</p>
                                </div>
                                <div class="w-25 p-3 border-bottom border-right">
                                    <p class="mb-2">Date Added</p>
                                    <p class="mb-0 font-weight-bold">{{ date_format($transaction->created_at, "F d, Y h:iA") }}</p>
                                </div>
                                <div class="w-25 p-3 border-bottom">
                                    @if($transaction->item != "Bank Deposit")
                                        <p class="mb-2">Actions</p>
                                        @if($transaction->status != "paid")
                                            <a href="/cashier/reservation/settle/{{ $transaction->id }}" class="btn btn-success">Settle</a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                        @php
                            if($transaction->item != "Bank Deposit" && $transaction->item != "Balance Payment") {
                                $total += $transaction->price;
                            }
                            if ($transaction->status == "paid") {
                                $totalPaid += $transaction->price;
                            }
                        @endphp
                    @endforeach
                @else
                    No transactions yet!
                @endif

                @php
                    $tax = setting('tax');
                    $taxAmount = $total * ($tax / 100);
                    $total += $total * ($tax / 100);
                @endphp
                <h4> VAT: PHP {{ $taxAmount }}</h4>
                <h4>Grand Total: PHP {{ number_format($total, 2) }}</h4>
                <h4> Total Paid {{ number_format($totalPaid, 2) }}</h4>
            </fieldset>
            <br>
            <br>
        </div>
    </div>
@endsection
