@extends('layouts.master')

@section('title', 'Home')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="text-center mb-4">What I Do</h2>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="text-center">
                            <i class="fas fa-laptop-code fa-3x mb-3 text-primary"></i>
                            <h4>Web Development</h4>
                            <p>Creating responsive and dynamic websites using modern technologies.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <i class="fas fa-mobile-alt fa-3x mb-3 text-primary"></i>
                            <h4>Mobile Design</h4>
                            <p>Designing user-friendly interfaces for mobile applications.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <i class="fas fa-database fa-3x mb-3 text-primary"></i>
                            <h4>Database Design</h4>
                            <p>Structuring efficient and scalable database solutions.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection