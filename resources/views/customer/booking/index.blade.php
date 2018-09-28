@extends('layouts.customer')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Reservations</div>
                    <div class="card-body">
                        {!! Form::open(['method' => 'GET', 'url' => '/customer/booking', 'class' => 'form-inline my-2 my-lg-0 float-right', 'role' => 'search'])  !!}
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
                                    <th>Booking Code</th><th>Start Date</th><th>End Date</th><th>Status</th><th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($reservations as $item)
                                    <tr>
                                        <td>{{ $item->code }}</td>
                                        <td>{{ $item->start_date }}</td><td>{{ $item->end_date }}</td><td>{{ $item->status }}</td>
                                        <td>
                                            <a href="{{ url('/customer/booking/' . $item->id) }}" title="View reservation"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'url' => ['/customer/booking/', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                            {!! Form::close() !!}
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
