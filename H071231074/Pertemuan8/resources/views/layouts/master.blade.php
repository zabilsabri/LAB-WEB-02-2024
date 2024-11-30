<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Pertemuan 8</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <!-- Header -->
    <header class="bg-primary text-white p-3 text-center">
        <h1>Pertemuan 8 - Praktikum Web</h1>
        @include("partials.navbar")
    </header>

    <!-- Main Content -->
    <div class="container my-4">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center p-3">
        <p>&copy; 2024 Rinaldi Ruslan. All rights reserved.</p>
    </footer>

</body>
</html>
