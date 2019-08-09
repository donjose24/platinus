<div class="form-group{{ $errors->has('event_name') ? 'has-error' : ''}}">
    <label for="event_name" class="control-label">{{ 'Event Name' }}</label>
    <input class="form-control" name="event_name" type="text" id="event_name" value="{{ $event->event_name or ''}}" >
    {!! $errors->first('event_name', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="control-label">{{ 'Description' }}</label>
    <input class="form-control" name="description" type="text" id="description" value="{{ $event->description or ''}}" >
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('image_url') ? 'has-error' : ''}}">
    <label for="image_url" class="control-label">{{ 'Image Url' }}</label>
    <input class="form-control" name="image_url" type="file" id="image_url" value="{{ $event->image_url or ''}}" >
    {!! $errors->first('image_url', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
