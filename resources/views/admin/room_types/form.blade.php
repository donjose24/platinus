<div class="form-group{{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
    {!! Form::text('name', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('description') ? 'has-error' : ''}}">
    {!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
    {!! Form::text('description', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('image_url') ? 'has-error' : ''}}">
    {!! Form::label('image_url', 'Image Url', ['class' => 'control-label']) !!}
    {!! Form::text('image_url', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('image_url', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('daily_rate') ? 'has-error' : ''}}">
    {!! Form::label('daily_rate', 'Daily Rate', ['class' => 'control-label']) !!}
    {!! Form::number('daily_rate', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('daily_rate', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('weekly_rate') ? 'has-error' : ''}}">
    {!! Form::label('weekly_rate', 'Weekly Rate', ['class' => 'control-label']) !!}
    {!! Form::number('weekly_rate', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('weekly_rate', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('capacity') ? 'has-error' : ''}}">
    {!! Form::label('capacity', 'Capacity', ['class' => 'control-label']) !!}
    {!! Form::number('capacity', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('capacity', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
