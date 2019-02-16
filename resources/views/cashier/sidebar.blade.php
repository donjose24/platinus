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
                <a href="/cashier">
                    <span><i class="fa fa-home"></i>Home</span>
                </a>
            </li>
            <li>
                <a href="/cashier/reservation">
                    <span><i class="fa fa-address-book"></i>Reservations</span>
                </a>
            </li>
            <li>
                <a href="/cashier/deposit">
                    <span><i class="fa fa-money-bill"></i>Deposit Uploads</span>
                </a>
            </li>
            <li>
                <a href="/cashier/rooms">
                    <span><i class="fa fa-door-open"></i>Room Maintenance</span>
                </a>
            </li>
            <li>
                <a href="/cashier/walk-in">
                    <span><i class="fa fa-address-book"></i>New reservation</span>
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
