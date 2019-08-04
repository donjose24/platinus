<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="logo"><img src="/images/logo.jpg" alt="platanus logo" class="icon"></div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto my-2 my-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="/"> <i class="fa fa-home"> </i> Home </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/roomrates"><i class="fa fa-bed"></i> Rooms </a>
            </li>
            <li class="nav-item">
                </i><a class="nav-link" href="/facilities"> <i class="fa fa-book-open"></i> Facilities </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/contact"><i class="fa fa-phone"></i> Contact Us </a>
            </li>
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}"><i class="fa fa-sign-in-alt"></i> {{ __('Login') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}"><i class="fa fa-user-plus"></i> {{ __('Register') }}</a>
                </li>
            @else
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link"><i class="fa fa-chart-line"></i> My Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        {{ Auth::user()->name ." (" .  __('Logout') . ")" }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endguest
        </ul>
    </div>
</nav>
