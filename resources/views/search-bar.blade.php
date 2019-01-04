<div class="row">
    <div class="col-md-5">
        <h1 class="welcome-text align-content-center">Experience Platanus</h1>
        {{Form::open(['url' => '/room/search', 'method' => 'get'])}}
        <label class="d-block" for="start_date">Check In</label><input readonly type="text" name="start_date"  value="{{ app('request')->input('start_date') }}" placeholder="From" class="datetime-picker form-control" />
        <label class="d-block" for="end_date">Check Out</label><input readonly type="text" name="end_date" value="{{ app('request')->input('end_date') }}"placeholder="To" class="datetime-picker form-control" />
        <button class="btn btn-success mt-2">Book Now</button>
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        {{ Form::close() }}
    </div>
</div>

