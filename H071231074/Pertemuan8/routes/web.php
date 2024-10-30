<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::post('/submit-contact', function (Request $request) {
    // Mengambil data dari formulir
    $name = $request->input('name');
    $email = $request->input('email');
    $subject = $request->input('subject');
    $message = $request->input('message');

    // Proses data, seperti menyimpan ke database atau mengirim email, dapat dilakukan di sini.
    // Untuk saat ini, kita akan hanya menampilkan pesan sukses.

    return back()->with('success', 'Pesan Anda berhasil dikirim! Terima kasih telah menghubungi kami.');
});
