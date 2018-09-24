@extends('layouts.front')

@section('content')
<div class="home-content">
    <h1 class="welcome-text align-content-center">Experience leisure and recreation within the hustle of Barretto ,Olongapo City</h1>
    <div class="reservation-container">
        @include('search-bar')
    </div>
</div>
<div class="page-content contact-content">
    <h1>Contact Us</h1>
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 contact-form">
                <div class="contact-form-container">
                    <div class="form-group">
                        <label for="">Send To</label>
                        <select class="form-control">
                            <option>Information</option>
                            <option>Admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input class="form-control" type="text" />
                    </div>
                    <div class="form-group">
                        <label for="">E-mail</label>
                        <input class="form-control" type="text" />
                    </div>
                    <div class="form-group">
                        <label for="">Contact Number</label>
                        <input class="form-control" type="text" />
                    </div>
                    <div class="form-group">
                        <label for="">Preferred Contact</label>
                        <select class="form-control">
                            <option>By Phone</option>
                            <option>By Email</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Message</label>
                        <textarea class="form-control" rows="4"></textarea>
                    </div>
                    <div class="form-group mb-0">
                        <button class="btn btn-custom-default w-100 p-2">Submit</button>
                    </div>
                </div>
            </div>
            <div class="col-4 offset-2">
                <div class="contact-instruction p-3">
                    <h4 class="mb-3">QUICK STEPS TO GETTING YOUR ROOM:</h4>
                    <ol>
                        <li>Select your choice of room from our available rooms!</li>
                        <li>Input your details and review the summary of your reservation!</li>
                        <li>Check your e-mail for your instant confirmation!</li>
                    </ol>

                    <button class="btn btn-custom-default w-100 p-2">Reserve Now</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
