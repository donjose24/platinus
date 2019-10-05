@extends('layouts.front')

@section('content')
<div class="home-content">
    <div class="reservation-container">
        @include('search-bar')
    </div>
</div>
<div class="page-content contact-content">
    <h1>Contact Us</h1>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 contact-form col-sm-12">
                <br>
                <br>
                <h2>Address: </h2>
                <h5>45-B, Regency Park Townhouse, Jose Abd Santos St., Cor E., Aguinaldo St., Clark Special Economy Zone
Mabalacat, Pampanga</h5>
                <br>
                <h2>Contact Number</h2>
                <h5>Call (045) 499 8017</h5>
                <br>
                <h2>Email Address</h2>
                <h5>hotelplatanusgmainc@gmail.com</h5>
                <br>
            </div>
            <div class="col-md-6 col-sm-12 mt-2">
                <div class="contact-instruction p-3">
                    <h4 class="mb-3">QUICK STEPS TO GETTING YOUR ROOM:</h4>
                    <ol>
                        <li>Select your choice of room from our available rooms!</li>
                        <li>Input your details and review the summary of your reservation!</li>
                        <li>Check your e-mail for your instant confirmation!</li>
                    </ol>

                    <button class="btn btn-success w-100 p-2">Reserve Now</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
