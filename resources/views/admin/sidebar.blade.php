<div class="sidebar-content">
    <div class="sidebar-profile">
        <div class="user-image"><img src="/images/user.jpg" alt="" /></div>
        <div class="user-desc">
            <p class="name">{{ Auth::user()->name }}</p>
            <p class="type">{{ Auth::user()->name }}</p>
        </div>
    </div>
    <div class="sidebar-nav">
        @foreach($laravelAdminMenus->menus as $section)
            @if($section->items)
                <ul class="flex-column">
                    @foreach($section->items as $menu)
                        <li>
                            <a  href="{{ url($menu->url) }}">
                                <span><i class="fa fa-{{$menu->icon}}"></i>{{ $menu->title }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        @endforeach
    </div>
</div>