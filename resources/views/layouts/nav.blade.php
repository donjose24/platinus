<header>
  <div class="header-nav">
    <div class="logo"><img src="/images/logo.png" alt="bellamonte logo" class="icon"></div>
    <div class="navigation">
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Room &amp; Rates</a></li>
        <li><a href="#">Facilities &amp; Services</a></li>
        <li><a href="#">Location</a></li>
        <li><a href="#">Contact Us</a></li>
        @guest
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
          </li>
        @else
          <li class="nav-item dropdown">
              <a class="nav-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
              {{Auth::user()->name ."(" .  __('Logout') . ")" }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</header>
