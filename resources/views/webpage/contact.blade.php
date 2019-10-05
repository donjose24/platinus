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
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3850.671678370386!2d120.51420381538117!3d15.176365166774335!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33968d5827f57a21%3A0xe0155f15c9a813c8!2sPlatanus%20Hotel!5e0!3m2!1sen!2sph!4v1570271636662!5m2!1sen!2sph" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
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
