@extends('master')

@section('title', 'contact')

@section('content')
<div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-10 col-lg-8 col-xl-9">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row">
                        <div class="col-6">
                            <img class="rounded-4" src="https://i.pinimg.com/474x/39/37/47/393747d57d29232eaa98b9ecba7c4dca.jpg" alt="image" width="420px">
                        </div>
                        <div class="col-6 d-flex align-items-center">
                            <div class="card-body p-4 text-center login-form">
                                <h2 class="fw-bold mb-2 text-uppercase">Login for join Netflix </h2>
                                <p class="mb-5">Please enter your login and password!</p>
                                <form action="" method="">
                                    <div class="form-label-group outline">
                                        <span><label>Username or Email</label></span>
                                        <input type="text" name="email" class="form-control" placeholder="Username or Email" required>
                                    </div>
                                    <div class="form-label-group outline">
                                        <span><label>Password</label></span>
                                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                                    </div>
                                    <button class="btn btn-outline-primary btn-md px-4 m-3" type="submit">
                                        <i class="fa fa-sign-in" aria-hidden="true"></i> Login
                                    </button>
                                </form>
                                <p class="mb-0">Don't have an account? 
                                    <a href="registration.php" class="fw-bold">Register</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

        .card {
            box-shadow: 0px 4px 8px rgba(255, 255, 255, 0.5);
            border-radius: 10px;
        }
    </style>
@endsection