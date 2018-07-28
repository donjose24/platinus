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
                    <li class="nav-item">
                        <a class="btn btn-success" href="{{ url('/register')  }}"> <i class="fas fa-book-open"></i> Book Now </a>
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
    </body>
</html>
