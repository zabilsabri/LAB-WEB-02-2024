<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
</head>
<body class="d-flex flex-column min-vh-100">
    @include('partials.navbar')
    
    <main class="flex-grow-1">
        @include('partials.hero')
        <div class="container my-5">
            @yield('content')
        </div>
    </main>

    @include('partials.footer')
    @include('partials.scripts')
</body>
</html>