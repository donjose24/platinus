<div class="form-group{{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="control-label">{{ 'Title' }}</label>
    <input class="form-control" name="title" type="text" id="title" value="{{ $amenity->title or ''}}" >
    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('sub_title') ? 'has-error' : ''}}">
    <label for="sub_title" class="control-label">{{ 'Sub Title' }}</label>
    <input class="form-control" name="sub_title" type="text" id="sub_title" value="{{ $amenity->sub_title or ''}}" >
    {!! $errors->first('sub_title', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="control-label">{{ 'Description' }}</label>
    <input class="form-control" name="description" type="text" id="description" value="{{ $amenity->description or ''}}" >
    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group{{ $errors->has('image') ? 'has-error' : ''}}">
    <label for="image" class="control-label">{{ 'Image' }}</label>
    <input class="form-control" name="image" type="file" id="image" value="{{ $amenity->image or ''}}" >
    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
</div>
