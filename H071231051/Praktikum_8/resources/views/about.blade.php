@extends('master')

@section('title', 'about')

@section('content')
<section class="about mt-2">
    <div class="container h-100 d-flex justify-content-center align-items-center">
        <div class="row justify-content-center align-items-center text-light">
            <h1 class="text-center fw-5">About</h1>
            <div class="col-md-6 text-justify mt-1">
                <p>
                    Divergent is a dystopian novel by Veronica Roth, set in a future society divided into five factions based on core values: Abnegation, Dauntless, Amity, Candor, and Erudite. The story follows Beatrice "Tris" Prior, a young girl on the verge of choosing her faction, who discovers she is "Divergent," meaning she doesn’t fit neatly into any one faction. This status puts her life at risk, as the system is intolerant of individuals with mixed traits. The novel explores themes of identity, choice, and resistance against an oppressive system, with a backdrop full of action and suspense.
                </p>
            </div>
            <div class="col-md-6 text-justify mt-1">
                <p>
                    Each faction in Divergent represents a distinct value. Abnegation values selflessness and serving others, making its members ideal for governing roles. Dauntless prizes bravery and physical strength, so they protect society. Amity promotes peace and harmony, making its members well-suited for agriculture and social work. Candor values honesty and openness, so they specialize in law and conflict resolution. Finally, Erudite is dedicated to intelligence and knowledge, encouraging members to become innovators and researchers.
                </p>
            </div>
            <div class="col-12 mt-4 mb-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-6 col-md-4 col-lg-2">
                        <img src="{{ asset('img/factions1.jpg') }}" class="img-fluid rounded " alt="Image 1">
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <img src="{{ asset('img/factions2.jpg') }}" class="img-fluid rounded" alt="Image 2">
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <img src="{{ asset('img/factions3.jpg') }}" class="img-fluid rounded" alt="Image 3">
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <img src="{{ asset('img/factions4.jpg') }}" class="img-fluid rounded" alt="Image 4">
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <img src="{{ asset('img/factions5.jpg') }}" class="img-fluid rounded" alt="Image 5">
                    </div>
                </div>
            </div>

            <div class="container text-center mt-5">
            <h1>Other Series</h1>
            <div class="row row-cols-auto justify-content-space-between mt-5 mb-5">
                <div class="col-12 col-md-6 col-lg-4 d-flex justify-content-center">
                    <div class="card">
                        <img src="https://i.pinimg.com/564x/59/cc/21/59cc2123d71f313a47d38de6b8833d84.jpg" class="card-img-top mx-auto" alt="divergent" height="500px">
                        <div class="card-body">
                            <h5 class="card-title text-dark">Divergent(2014)</h5>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-dark" href="https://www.netflix.com/id/title/70293461">Watch Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 d-flex justify-content-center">
                    <div class="card">
                        <img src="https://i.pinimg.com/564x/13/b5/46/13b546f6139f6a5f5dccf05e96285af5.jpg" class="card-img-top mx-auto" alt="insuregent" height="500px">
                        <div class="card-body">
                            <h5 class="card-title text-dark">The Divergent Series: Insurgent(2015)</h5> 
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-dark" href="https://www.netflix.com/gb/title/80018211">Watch Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 d-flex justify-content-center">
                    <div class="card">
                        <img src="https://i.pinimg.com/564x/42/b6/86/42b6860b32bd3936f3439af5bb87df87.jpg"class="card-img-top mx-auto" alt=" Allegiant" height="500px">
                        <div class="card-body">
                            <h5 class="card-title text-dark">The Divergent Series: Allegiant(2016)</h5>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-dark" href="https://www.netflix.com/gb/title/80081226">Watch Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</section>
@endsection

@section('style')
    <style>
        body {
            background-image: url('{{ asset('img/bg2.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            background-color: rgba(50, 70, 80, 0.7);
            background-blend-mode: soft-light;
        }

        .img-fluid, .card {
            box-shadow: 0px 4px 8px rgba(255, 255, 255, 0.5);
            border-radius: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .img-fluid:hover,    {
            transform: scale(1.05);
            box-shadow: 0px 8px 16px rgba(255, 255, 255, 0.7);
        }
    </style>
@endsection