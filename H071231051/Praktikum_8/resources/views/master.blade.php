<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @yield('title') | Divergent</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @yield('style')
    <style>
        .navbar, .footer-section{
            box-shadow: 0px 4px 8px rgba(255, 255, 255, 0.5); /* White shadow */
        }
    </style>
</head>
<body>
    <header>
            <nav class="navbar navbar-black navbar-expand-lg bg-black">
                <div class="container-fluid">
                    <a class="navbar-brand">
                        <img src="{{ asset('img/logo.png') }}" alt="logo" width="100px">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav ms-auto ">
                            <a class="nav-link text-light fs-5" aria-current="page" href="{{route('home')}}">Home</a>
                            <a class="nav-link text-light fs-5" href="{{route('about')}}">About</a>
                            <a class="nav-link text-light fs-5" href="{{route('contact')}}">Contact us</a>
                        </div>
                    </div>
                </div>
            </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="footer-section text-white text-center" style="background-color: black;  height:50px;">
        <p class="mb-1">&copy; {{ date('Y') }} Divergent. nora.</p>
    </footer>

</body>
</html>