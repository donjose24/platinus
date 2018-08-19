<div class="form-group{{ $errors->has('reservation_id') ? 'has-error' : ''}}">
    {!! Form::label('reservation_id', 'Reservation Id', ['class' => 'control-label']) !!}
    {!! Form::number('reservation_id', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('reservation_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('room_id') ? 'has-error' : ''}}">
    {!! Form::label('room_id', 'Room Id', ['class' => 'control-label']) !!}
    {!! Form::number('room_id', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('room_id', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
