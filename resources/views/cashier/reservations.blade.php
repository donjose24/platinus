@extends('layouts.cashier')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Reservations</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless data-table">
                                <thead>
                                <tr>
                                    <th>Reservation Code</th>
                                    <th>Customer Name</th>
                                    <th>Customer Email</th>
                                    <th>Check In Date</th>
                                    <th>Check Out Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($reservations as $item)
                                    <tr>
                                        <td>{{ $item->code }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->user->email }}</td>
                                        <td>{{ $item->start_date }}</td>
                                        <td>{{ $item->end_date }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>
                                            <a href="{{ url('/cashier/reservation/' . $item->id) }}" title="View Reservation Room Details"><button class="btn btn-info btn-sm">View</button></a>
                                            @if($item->status == "cancelled")
                                                {{ Form::open(['url' => '/cashier/refund']) }}
                                                    {{ Form::hidden('id', $item->id) }}
                                                    {{ Form::submit('Refund', ['class' => 'btn btn-primary mt-2']) }}
                                                {{ Form::close() }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $reservations->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
