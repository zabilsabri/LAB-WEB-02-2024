@extends('layout.main')

@section('content')
<div class="flex justify-between mb-4">
    <h1 class="text-3xl font-bold">Categories</h1>
    <a href="{{ route('categories.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        <i class="fas fa-plus mr-2"></i>Add Category
    </a>
</div>

    <table class="min-w-full bg-white shadow rounded-lg">
        <thead>
            <tr>
                <th class="px-5 py-2 border text-left">No.</th>
                <th class="px-5 py-2 border text-left">Name</th>
                <th class="px-5 py-2 border text-left">Description</th>
                <th class="px-5 py-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td class="py-2 px-5 border">{{ $loop->iteration }}</td>
                <td class="border px-5 py-2">{{ $category->name }}</td>
                <td class="border px-5 py-2">{{ $category->description }}</td>
                <td class="border px-5 py-2 text-center">
                    <a href="{{ route('categories.edit', $category) }}" class="text-yellow-500 hover:underline mr-4">Edit</a>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
