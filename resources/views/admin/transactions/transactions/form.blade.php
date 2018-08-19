<div class="form-group{{ $errors->has('check_in') ? 'has-error' : ''}}">
    {!! Form::label('check_in', 'Check In', ['class' => 'control-label']) !!}
    {!! Form::input('datetime-local', 'check_in', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('check_in', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('check_out') ? 'has-error' : ''}}">
    {!! Form::label('check_out', 'Check Out', ['class' => 'control-label']) !!}
    {!! Form::input('datetime-local', 'check_out', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('check_out', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('reservation_id') ? 'has-error' : ''}}">
    {!! Form::label('reservation_id', 'Reservation Id', ['class' => 'control-label']) !!}
    {!! Form::text('reservation_id', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('reservation_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
