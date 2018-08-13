<div class="form-group{{ $errors->has('from_date') ? 'has-error' : ''}}">
    {!! Form::label('from_date', 'From Date', ['class' => 'control-label']) !!}
    {!! Form::date('from_date', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('from_date', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('reservation_id') ? 'has-error' : ''}}">
    {!! Form::label('reservation_id', 'Reservation Id', ['class' => 'control-label']) !!}
    {!! Form::number('reservation_id', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('reservation_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('user_id') ? 'has-error' : ''}}">
    {!! Form::label('user_id', 'User Id', ['class' => 'control-label']) !!}
    {!! Form::number('user_id', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('to_date') ? 'has-error' : ''}}">
    {!! Form::label('to_date', 'To Date', ['class' => 'control-label']) !!}
    {!! Form::date('to_date', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('to_date', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('is_paid') ? 'has-error' : ''}}">
    {!! Form::label('is_paid', 'Is Paid', ['class' => 'control-label']) !!}
    {!! Form::number('is_paid', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('is_paid', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('deposit_slip') ? 'has-error' : ''}}">
    {!! Form::label('deposit_slip', 'Deposit Slip', ['class' => 'control-label']) !!}
    {!! Form::text('deposit_slip', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('deposit_slip', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('expiration_date') ? 'has-error' : ''}}">
    {!! Form::label('expiration_date', 'Expiration Date', ['class' => 'control-label']) !!}
    {!! Form::input('datetime-local', 'expiration_date', null, ('required' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
    {!! $errors->first('expiration_date', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    {!! Form::submit($formMode === 'edit' ? 'Update' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>
