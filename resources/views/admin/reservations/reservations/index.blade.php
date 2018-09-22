@extends('layouts.backend')

@section('content')
<div class="card">
    <div class="card-header">Reservations</div>
    <div class="card-body">
        <a href="{{ url('/admin/reservations/create') }}" class="btn btn-custom-primary btn-sm" title="Add New reservation">
            <i class="fa fa-plus" aria-hidden="true"></i> Add New
        </a>
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
                            <a href="{{ url('/admin/reservations/' . $item->id . '/edit') }}" title="Edit reservation"><button class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></button></a>
                            {!! Form::open([
                                'method' => 'DELETE',
                                'url' => ['/admin/reservations', $item->id],
                                'style' => 'display:inline'
                            ]) !!}
                                {!! Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-sm',
                                        'title' => 'Delete reservation',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                )) !!}
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
@endsection
