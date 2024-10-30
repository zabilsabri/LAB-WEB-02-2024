@extends('layouts.master')

@section('title', 'Kontak')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body text-center">
            <h2 class="card-title mb-3">Hubungi Kami</h2>
            <p class="card-text lead">Jika Anda memiliki pertanyaan, jangan ragu untuk menghubungi kami melalui formulir di bawah ini!</p>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <form action="/submit-contact" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="subject" class="form-label">Subjek</label>
                    <input type="text" class="form-control" id="subject" name="subject">
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Pesan</label>
                    <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Kirim Pesan</button>
            </form>
        </div>
    </div>
@endsection
