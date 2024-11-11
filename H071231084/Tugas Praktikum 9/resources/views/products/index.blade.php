@extends('layout.main')

@section('content')

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between mb-4">
        <h1 class="text-3xl font-bold">Products</h1>
        <a href="{{ route('products.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-plus mr-1"></i> Add New Product
        </a>
    </div>

    <table class="min-w-full bg-white shadow rounded-lg">
        <thead>
            <tr>
                <th class="py-2 px-5 border text-left">No.</th>
                <th class="py-2 px-5 border text-left">Name</th>
                <th class="py-2 px-5 border text-left">Description</th>
                <th class="py-2 px-5 border text-left">Category</th>
                <th class="py-2 px-5 border text-left">Price</th>
                <th class="py-2 px-5 border text-left">Stock</th>
                <th class="py-2 px-5 border text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr class="hover:bg-gray-100">
                    <td class="py-2 px-5 border">{{ $loop->iteration }}</td>
                    <td class="py-2 px-5 border">{{ $product->name }}</a></td>
                    <td class="py-2 px-5 border">{{ $product->description }}</td>
                    <td class="py-2 px-5 border">{{ $product->category->name }}</td>
                    <td class="py-2 px-5 border">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                    <td class="py-2 px-5 border">{{ $product->stock }}</td>
                    <td class="py-2 px-5 border text-center">
                        <a href="{{ route('products.show', $product->id) }}" class="text-blue-500 hover:underline">Manage Stock</a>
                        <a href="{{ route('products.edit', $product->id) }}" class="text-yellow-500 hover:underline ml-4">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline ml-4">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
