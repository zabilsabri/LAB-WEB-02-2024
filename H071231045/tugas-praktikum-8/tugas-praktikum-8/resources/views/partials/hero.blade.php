@if(request()->routeIs('home'))
<section class="hero-section text-center">
    <div class="container">
        <h1 class="display-4">Hello im Muh. Aipun Pratama</h1>
        <h1 class="display-4">Welcome to My Portfolio</h1>
        <p class="lead">Web Developer | Designer | Creative Thinker</p>
        <div class="mt-4">
            <a href="{{ route('about') }}" class="btn btn-light btn-lg me-3">Learn More</a>
            <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">Contact Me</a>
        </div>
    </div>
</section>
@endif