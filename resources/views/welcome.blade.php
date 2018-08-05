<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <link href="{{URL::asset('/css/app.css')}}" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="navbar navbar-expand-lg navbar-light align-content-center">
            <a class="navbar-brand" href="#">
                <img src="/images/logo.png" alt="bellamonte logo" class="icon">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ url('/home') }}"> <i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/register')  }}">  <i class="fas fa-procedures"></i> Room Rates </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/register')  }}">  <i class="fas fa-map-marker-alt"></i> Location </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/register')  }}">  <i class="fas fa-phone-square"></i> Contact Us </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/login')  }}"> <i class="fas fa-sign-in-alt"></i> Login </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/register')  }}"> Register </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-6 banner col-xs-5">
                    <h1 class="display-3">Welcome to Hotel Bella Monte</h1>
                    <p>Hotel Bella Monte is an established hotel in Barrio Barretto that offers leisure and recreation within the hustle of Barretto, Olongapo City. Only 10 minutes away from the bars and restaurants that offer a broad selection of diverse cuisines from all over the world.</p>
                    <a href="#" class="btn btn-primary btn-success"><i class="fa fa-bed"></i> View Rooms</a>
                </div>
                <div class="col-md-3 col-xs-3"></div>
                <div class="col-md-3 banner col-xs-3">
                    <h1 class="display-6">Reserve Now!</h1>
                    {{Form::open(['url' => 'test'])}}
                        {{Form::label('from', 'From')}}
                        {{Form::text('from', '', ['class' => 'form-control'])}}
                        {{Form::label('to', 'To')}}
                        {{Form::text('to', '', ['class' => 'form-control'])}}
                        <br>
                        <button class="btn btn-primary btn-success float-right" href="{{ url('/register')  }}"> <i class="fas fa-book-open"></i> Book Now </button>
                    {{Form::close() }}
                </div>
            </div>
        </div>
        <div class="row location">
            <div class="col-md-4 col-xs-4">
                <h1 class="display-4">How to get here?</h1>
                <p>From Manila, there are Victory Liner Terminals that can take you to Olongapo City. The estimated travel time is 3-4 hours. Once you arrive at the Victory Liner Terminal in Olongapo, there will be a Blue Jeepney Terminal that you need to take just ask the driver to drop you off at Del Pilar St. (landmark will be Rico's Restaurant). You may ride a tricycle or walk going to the hotel.
                </p>
                <p>From Subic Bay Freeport Zone, via private car. Proceed to the Kalaklan Gate, make a left turn and ride through the National Highway until you reach The Baretto Area, the best landmark is Rico's Restaurant on your right side.</p>
            </div>
            <div class="col-lg-5 col-md-5 col-xs-5">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12817.970583060149!2d120.25368560239816!3d14.849272983474288!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x339670cf9b029c9d%3A0x898878ac2f214293!2sHOTEL+BELLA+MONTE!5e0!3m2!1sen!2sph!4v1533372113450" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
            <div class="col-lg-3 col-md-3 col-xs-3">
                <h1 class="display-4">Area Information</h1>
                <p>For a quick fun and relaxing vacation away from the hustle and bustle of the city, Bella Monte Hotel Subic is perfectly situated at #15 Del Pilar Street Baloy Baretto. Nestled near the beaches, restaurants and bars, your stay at our resort will absolutely satisfy your awaited vacation. </p>
                <p>For a perfect night out with friends even with your family, our resort is very accessible to some of the nightlife bars such as: Midnight Ranbler Bar and Angel Witch. Baretto Mini Mart and Savers Appliance Depot are located just few minutes away from our property.</p>
            </div>
        </div>
    </body>
</html>
