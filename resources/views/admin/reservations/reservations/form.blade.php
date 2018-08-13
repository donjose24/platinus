<div class="form-group{{ $errors->has('room_id') ? 'has-error' : ''}}">
    {!! Form::label('room_id', 'Room Id', ['class' => 'control-label']) !!}
    {!! Form::number('room_id', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('room_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('transaction_id') ? 'has-error' : ''}}">
    {!! Form::label('transaction_id', 'Transaction Id', ['class' => 'control-label']) !!}
    {!! Form::number('transaction_id', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('transaction_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
