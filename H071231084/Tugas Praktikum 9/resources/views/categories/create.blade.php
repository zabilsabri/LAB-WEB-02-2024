@extends('layout.main')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Add Category</h1>
    <form action="{{ route('categories.store') }}" class="bg-white p-6 rounded-lg shadow-md" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" />
        </div>
        <div class="mb-4">
            <label for="description" class="block text-gray-700">Category Description</label>
            <input type="text" name="description" id="desciption" value="{{ old('description') }}" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" />
        </div>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded">Add Category</button>
    </form>
@endsection