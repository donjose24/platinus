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
        h1 {
            margin-bottom: 15px;
        }
        .logo {
            margin: 0 auto 5px;
            width: 200px;
            text-align: center;
        }
        .logo-img {
            width: 100%;
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
        th:last-child{
          width: 30%
        }
        td {
          font-size: 12px;
          text-align: center;
        }

    </style>
</head>
<body>
    <div class="header">
      <div class="logo"><img class="logo-img" src="https://platanus.herokuapp.com/images/logo.jpg" alt="platanushotel logo"></div>
      <h1>Platanus Hotel</h1>
        <span class="hit">Clark Freeport, Mabalacat, Pampanga</span>
      <span class="hit">EMAIL: admin@platanus.com</span>
      <span class="hit">TEL : 123 456</span>
      <span class="hit">MOBILE: 0912 345 6789</span>
    </div>
    <br>
    <br>
    <span class="hit">Transactions</span>
    <br>
    <table>
        <thead>
            <tr>
                <th>Reservation Number</th>
                <th>Item</th>
                <th>Price</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
        @php
            $total = 0;
        @endphp
        @foreach($transactions as $item)
            <tr>
                <td>{{ $item->reservation->code }}</td>
                <td>{{ $item->item }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->created_at }}</td>
            </tr>
            @php
                $total += $item->price
            @endphp
        @endforeach
        </tbody>
    </table>
    <span class="hit">Date: {{ \Carbon\Carbon::now()->toDateTimeString() }}</span>
    <h3>Total: {{ number_format($total,2) }}</h3>
    <h5> Printed By: {{ \Illuminate\Support\Facades\Auth::user() }}</h5>
</body>
</html>
