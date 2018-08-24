<div class="form-group{{ $errors->has('number') ? 'has-error' : ''}}">
    {!! Form::label('number', 'Number', ['class' => 'control-label']) !!}
    {!! Form::text('number', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('number', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('room_type_id') ? 'has-error' : ''}}">
    {!! Form::label('room_type_id', 'Room Type Id', ['class' => 'control-label']) !!}
    {!! Form::select('room_type_id', $roomTypes, null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('room_type_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('status') ? 'has-error' : ''}}">
    {!! Form::label('status', 'Status', ['class' => 'control-label']) !!}
    {!! Form::select('status', ['active' => 'Active', 'inactive' => 'Inactive'], null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('note') ? 'has-error' : ''}}">
    {!! Form::label('note', 'Note', ['class' => 'control-label']) !!}
    {!! Form::text('note', null, ('required' == 'required') ? ['class' => 'form-control', 'step' => '.01'] : ['class' => 'form-control']) !!}
    {!! $errors->first('number', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
