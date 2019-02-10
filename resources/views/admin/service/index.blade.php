@extends('layouts.backend')

@section('content')
<div class="card">
    <div class="card-header">Service</div>
    <div class="card-body">
        <a href="{{ url('/admin/service/create') }}" class="btn btn-success btn-sm" title="Add New User">
            <i class="fa fa-plus" aria-hidden="true"></i> Add New
        </a>
        <br/>
        <br/>
        <div class="table-responsive">
            <table class="table data-table">
                <thead>
                    <tr>
                        <th>#</th><th>Name</th><th>Price</th><th>Quantity</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($service as $item)
                    <tr>
                        <td>{{ $loop->iteration or $item->id }}</td>
                        <td>{{ $item->name }}</td><td>{{ $item->price }}</td><td>{{ $item->quantity }}</td>
                        <td>
                            <a href="{{ url('/admin/service/' . $item->id) }}" title="View Service"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                            <a href="{{ url('/admin/service/' . $item->id . '/edit') }}" title="Edit Service"><button class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></button></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pagination-wrapper"> {!! $service->appends(['search' => Request::get('search')])->render() !!} </div>
        </div>

    </div>
</div>
@endsection
