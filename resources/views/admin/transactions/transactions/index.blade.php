@extends('layouts.backend')

@section('content')
<div class="card">
    <div class="card-header">Transactions</div>
    <div class="card-body">
        <a href="{{ url('/admin/transactions/create') }}" class="btn btn-custom-primary btn-sm" title="Add New Transaction">
            <i class="fa fa-plus" aria-hidden="true"></i> Add New
        </a>
        <br/>
        <br/>
        <div class="table-responsive">
            <table class="table data-table">
                <thead>
                    <tr>
                        <th>#</th><th>Item</th><th>Price</th><th>Reservation</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($transactions as $item)
                    <tr>
                        <td>{{ $loop->iteration or $item->id }}</td>
                        <td>{{ $item->item }}</td><td>{{ $item->price }}</td><td>{{ $item->reservation->code }}</td>
                        <td>
                            <a href="{{ url('/admin/transactions/' . $item->id) }}" title="View Transaction"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                            <a href="{{ url('/admin/transactions/' . $item->id . '/edit') }}" title="Edit Transaction"><button class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></button></a>
                            
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-right mt-3">
                <a href="/admin/sales/print{{ !empty($keyword) ? "?search=" . $keyword : ""   }}" class="btn btn-custom-default p-2 w-25" target="_blank"> Print </a>
            </div>
            <div class="pagination-wrapper"> {!! $transactions->appends(['search' => Request::get('search')])->render() !!} </div>
        </div>
    </div>
</div>
@endsection
