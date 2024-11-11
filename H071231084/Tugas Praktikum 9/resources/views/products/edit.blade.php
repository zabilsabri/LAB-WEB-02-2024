@extends('layout.main')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Add a New product</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name</label>
            <input type="text" name="name" id="name" class="w-full p-2 border border-gray-300 rounded mt-1" value="{{ old('name', $product->name) }}" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700">Description</label>
            <input type="text" name="description" id="description" class="w-full p-2 border border-gray-300 rounded mt-1" value="{{ old('description', $product->description) }}" required>
        </div>

        <div class="mb-4">
            <label for="price" class="block text-gray-700">Price</label>
            <input type="number" name="price" id="price" class="w-full p-2 border border-gray-300 rounded mt-1" value="{{ old('price', $product->price) }}" required>
        </div>

        <div class="mb-4">
            <label for="category_id" class="block text-gray-700">Category</label>
            <select name="category_id" id="category_id" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == old('category_id', $product->category_id) ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Update Product
        </button>
    </form>
@endsection