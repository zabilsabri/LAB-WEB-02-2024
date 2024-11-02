<nav>
    <div class="navbar">
        <ul>
            <li><a class="{{ request()->routeIs('home') ? 'active' : ''}}" href="{{ route('home') }}">Home</a></li>
            <li><a class="{{ request()->routeIs('about') ? 'active' : ''}}" href="{{ route('about') }}">About</a></li>
            <li><a class="{{ request()->routeIs('gallery') ? 'active' : ''}}" href="{{ route('gallery') }}">Gallery</a></li>
        </ul>
    </div>
</nav>
