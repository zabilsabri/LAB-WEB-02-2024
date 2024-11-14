@props(['route', 'text'])
<a href="{{ route($route) }}" class="nav-link {{ request()->routeIs($route) ? 'active' : '' }}">
    {{ $text }}
</a>