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
    <div class="logo"><img class="logo-img" src="https://www.thebellamontehotel.com/images/logo.png" alt="bellamontehotel logo"></div>
    <h1>Bella Monte Hotel</h1>
    <span class="hit">#15 del Pilar St. Bo., Barretto Olongapo, Zambales, Philippines</span>
    <span class="hit">EMAIL: admin@bellamonte.com</span>
    <span class="hit">TEL : 123 456</span>
    <span class="hit">MOBILE: 0912 345 6789</span>
</div>
<br>
<br>
<span class="hit">Reservations: {{ $status }}</span>
<br>
<table>
    <thead>
    <tr>
        <th>Reservation Code</th>
        <th>Customer Name</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($reservations as $item)
        <tr>
            <td>{{ $item->code }}</td>
            <td>{{ $item->user->name }}</td>
            <td>{{ $item->start_date }}</td>
            <td>{{ $item->end_date }}</td>
            <td>{{ $item->status }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>