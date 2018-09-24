{{Form::open(['url' => '/room/search', 'method' => 'get'])}}
<ul>
    <li><label class="d-block" for="start_date">Start Date</label><input readonly type="text" name="start_date"  placeholder="From" class="datetime-picker" /></li>
    <li><label class="d-block" for="end_date">End Date</label><input readonly type="text" name="end_date" placeholder="To" class="datetime-picker" /></li>
    <li><button class="btn btn-custom-default w-100">Book Now</button></li>
</ul>
@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
{{ Form::close() }}