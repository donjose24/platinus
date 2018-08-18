@extends('layouts.backend')

@section('content')
<div class="card">
    <div class="card-header">Transaction {{ $transaction->id }}</div>
    <div class="card-body">

        <a href="{{ url('/admin/transactions') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
        <a href="{{ url('/admin/transactions/' . $transaction->id . '/edit') }}" title="Edit Transaction"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['admin/transactions', $transaction->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-sm',
                    'title' => 'Delete Transaction',
                    'onclick'=>'return confirm("Confirm delete?")'
            ))!!}
        {!! Form::close() !!}
        <br/>
        <br/>

        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr>
                        <th>ID</th><td>{{ $transaction->id }}</td>
                    </tr>
                    <tr><th> From Date </th><td> {{ $transaction->from_date }} </td></tr><tr><th> Reservation Id </th><td> {{ $transaction->reservation_id }} </td></tr><tr><th> User Id </th><td> {{ $transaction->user_id }} </td></tr>
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
