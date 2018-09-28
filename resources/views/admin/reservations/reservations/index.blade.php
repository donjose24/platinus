@extends('layouts.backend')

@section('content')
<div class="card">
    <div class="card-header">Reservations</div>
    <div class="card-body">
        <br/>
        <br/>
        <div class="table-responsive">
            <table class="table data-table">
                <thead>
                    <tr>
                        <th>#</th><th>Start Date</th><th>End Date</th><th>Status</th><th>Transaction Code</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($reservations as $item)
                    <tr>
                        <td>{{ $loop->iteration or $item->id }}</td>
                        <td>{{ $item->start_date }}</td><td>{{ $item->end_date }}</td><td>{{ $item->status }}</td><td>{{ $item->code }}</td>
                        <td>
                            <a href="{{ url('/admin/reservations/' . $item->id) }}" title="View reservation"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pagination-wrapper"> {!! $reservations->appends(['search' => Request::get('search')])->render() !!} </div>
        </div>
    </div>
</div>
@endsection
