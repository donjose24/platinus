<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Document</title>
    <style>
        body{
            font-family: "Helvetica", Georgia, Serif;
            color:black;
        }
        .header {
          text-align: center;
        }
        .hit{
            display:block;
            font-size:12px;
            margin-bottom: 5px;
        }
        table{
            width:100%;
            font-size:10px;
        }
        th{
            background-color:gray;
            color:white;
            text-align:center;
            font-size:15px;
            font-weight:bold;
        }
        td {
          font-size: 12px;
        }

    </style>
</head>
<body>
    <div class="header">
      <h1>Bella Monte Hotel</h1>
      <span class="hit">#15 del Pilar St. Bo., Barretto Olongapo, Zambales, Philippines</span>
      <span class="hit">EMAIL: admin@bellamonte.com</span>
      <span class="hit">TEL : 123 456</span>
      <span class="hit">MOBILE: 0912 345 6789</span>
    </div>
    <br>
    <br>
    <span class="hit">Date: {{ \Carbon\Carbon::now()->toDateTimeString() }}</span>
    <span class="hit">Reservation Code: {{ strtoupper($reservation->code) }}</span>
    <span class="hit">Customer: {{ $reservation->user->name }}</span>
    <h3 style="text-align: center">Reservation Details</h3>
    <table class="table">
    <thead>
    <tr>
        <th>Item</th>
        <th>Unit Price</th>
        <th>Total Price</th>
    </tr>
    </thead>
    <tbody>
    @php
        $total = 0;
    @endphp
    @foreach($reservation->roomTypes()->withPivot('price')->wherePivot('deleted_at', null)->get() as $room)
        <tr>
            <td>{{ $room->name }}</td>
            <td>{{ number_format($room->pivot->price, 2) }}</td>
            <td>{{ number_format(($room->pivot->price * $diff), 2) }}</td>
        </tr>
        @php
            {{ $total += ($room->pivot->price * $diff); }}
        @endphp
    @endforeach
    @foreach($transactions as $transaction)
        <tr>
           <td> {{ $transaction->item }}</td>
            <td> {{ number_format($transaction->price, 2) }}</td>
            <td> {{ number_format($transaction->price, 2) }}</td>
        </tr>
        @php
            {{ $total += ($transaction->price); }}
        @endphp
    @endforeach
    </tbody>
</table>
<hr>
<h3 style="text-align:right">Total Amount: {{ number_format($total, 2) }}</h3>
</body>
</html>