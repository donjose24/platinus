<div class="sidebar-content">
    <div class="sidebar-profile">
        <div class="user-image"><img src="/images/user.jpg" alt="" /></div>
        <div class="user-desc">
            <p class="name">{{ Auth::user()->name }}</p>
            <p class="type">
                <a
                        href="{{ url('/logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout
                </a>
            </p>
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
    <div class="sidebar-nav">
        <ul class="flex-column">
            <li>
                <a href="/customer">
                    <span><i class="fa fa-home"></i>Home</span>
                </a>
            </li>
            <li>
                <a href="/customer/reservation">
                    <span><i class="fa fa-address-book"></i>Reserve Now</span>
                </a>
            </li>
            <li>
                <a href="/customer/booking">
                    <span><i class="fa fa-archive"></i>My Bookings</span>
                </a>
            </li>
            <li>
                <a href="/auth/change-password">
                    <span><i class="fa fa-lock"></i>Change Password</span>
                </a>
            </li>
        </ul>
    </div>
</div>
