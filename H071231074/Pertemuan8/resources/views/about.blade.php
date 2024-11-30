@extends('layouts.master')

@section('title', 'Tentang Kami')

@section('content')
    <div class="card text-center p-4">
        <h2 class="card-title mb-3">Tentang Kami</h2>
        <img src="/images/profile.jpg" alt="Foto Profil" class="card-img-top rounded mb-3 mx-auto" style="width: 150px; height: 150px; object-fit: cover;">
        <p class="card-text lead">
            Saya adalah mahasiswa semester 3 program studi Sistem Informasi di Universitas Hasanuddin. Memiliki ketertarikan besar pada teknologi informasi, terutama di bidang pengembangan web, saya terus bersemangat untuk mengeksplorasi dan memperdalam pemahaman saya tentang teknologi modern. Selain mengembangkan keterampilan teknis, saya juga terbuka terhadap inovasi baru yang dapat mendukung perkembangan karir saya di bidang IT.
        </p>
    </div>

    <div class="card mt-4 p-3">
        <div class="card-body">
            <h3>Keahlian Teknis</h3>
            <ul>
                <li><strong>Bahasa Pemrograman:</strong> Python, Java, JavaScript, C++</li>
                <li><strong>Pengembangan Web:</strong> Mampu membangun website sederhana dengan HTML, CSS, dan JavaScript</li>
                <li><strong>Database:</strong> Dasar dalam MySQL untuk membuat dan menjalankan query data</li>
            </ul>

            <h4>Media Sosial</h4>
            <div class="social-icons d-flex justify-content-center">
                <a href="https://www.instagram.com/rinaldiruslan/" target="_blank" class="me-3">
                    <i class="fab fa-instagram fa-2x"></i>
                </a>
                <a href="https://linkedin.com/in/rinaldiruslan" target="_blank" class="me-3">
                    <i class="fab fa-linkedin fa-2x"></i>
                </a>
                <a href="https://www.facebook.com/rinaldi.naldi.5220" target="_blank" class="me-3">
                    <i class="fab fa-facebook fa-2x"></i>
                </a>
                <a href="https://github.com/xebec51" target="_blank">
                    <i class="fab fa-github fa-2x"></i>
                </a>
            </div>
        </div>
    </div>
@endsection
