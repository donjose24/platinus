@extends('layouts.cashier')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Reservations</div>
                    <div class="card-body">
                        {!! Form::open(['method' => 'GET', 'url' => '/cashier/reservation', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                            <span class="input-group-append">
                                <button class="btn btn-secondary" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        {!! Form::close() !!}

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
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
                                            <a href="{{ url('/cashier/reservation/' . $item->id) }}" title="View ReservationRoomDetail"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                            <a href="{{ url('/cashier/reservation/' . $item->id . '/edit') }}" title="Edit ReservationRoomDetail"><button class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></button></a>
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
