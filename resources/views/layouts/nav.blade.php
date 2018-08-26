<header>
  <div class="header-nav">
    <div class="logo"><img src="/images/logo.png" alt="bellamonte logo" class="icon"></div>
    <div class="navigation">
      <ul>
        <li><a href="/"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#"><i class="fa fa-bed"></i> Room &amp; Rates</a></li>
        <li><a href="#"><i class="fa fa-book-open"></i> Facilities &amp; Services</a></li>
        <li><a href="#"><i class="fa fa-map-marker"></i> Location</a></li>
        <li><a href="#"><i class="fa fa-phone"></i> Contact Us</a></li>
        @guest
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}"><i class="fa fa-sign-in-alt"></i> {{ __('Login') }}</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}"><i class="fa fa-user-plus"></i> {{ __('Register') }}</a>
          </li>
        @else
          <li class="nav-item dropdown">
            <a href="/customer"><i class="fa fa-chart-line"></i> My Dashboard</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
              {{Auth::user()->name ." (" .  __('Logout') . ")" }}
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
