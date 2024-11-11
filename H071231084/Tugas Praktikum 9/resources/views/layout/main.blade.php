<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Product Management</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body style="font-family: 'Figtree', sans-serif;" class="bg-gray-100 leading-normal tracking-normal">

    <!-- Navbar -->
    <nav class="bg-gray-800 py-4 px-10 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <a href="" class="text-white text-lg font-semibold">
                <i class="fas fa-box mr-2"></i>Product Management
            </a>
            <div class="space-x-4">
                <a href="{{ route('products.index') }}" class="text-gray-300 hover:text-white">Products</a>
                <a href="{{ route('inventorylogs.index') }}" class="text-gray-300 hover:text-white">Inventory Logs</a>
                <a href="{{ route('categories.index') }}" class="text-gray-300 hover:text-white">Categories</a>
            </div>
        </div>
    </nav>

    <div class="container px-20 my-10">
        @yield('content')
    </div>

</body>
</html>
