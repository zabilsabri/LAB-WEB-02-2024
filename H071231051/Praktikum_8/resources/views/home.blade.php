@extends('master')

@section('title', 'home')

@section('content')
    <section class="hero">
        <div class="container h-100 d-flex justify-content-center align-items-center">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6 text-justify text-light fs-5">
                    <h1 class="fw-5">Divergent</h1>
                    <p>
                    2014 | Maturity Rating:13+ | 2h 19m | Sci-Fi
                    <br>
                    In a divided, war-torn world, Tris discovers her special abilities and bands with Four to resist a sinister plot against those like them.
                    <br>
                    Starring : Shailene Woodley, Miles Teller, Ashley Judd.
                    </p>
                    <a class="btn btn-light" href="https://www.netflix.com/id/title/70293461"> Watch Now</a>
                </div>
                <div class="col-md-6 text-center">
                    <img src="{{ asset('img/figur.png') }}" alt="" class="img-fluid mt-1" width="295px">
                </div>
            </div>
        </div>
    </section>
@endsection

@section('style')
    <style>
        body {
            background-image: url('https://i.pinimg.com/1200x/40/9c/4d/409c4d11ca7aa57127fe13482b7bdeaf.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            background-color: rgba(50, 70, 80, 0.7);
            background-blend-mode: soft-light;
        }
    </style>
@endsection