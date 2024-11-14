@extends('layouts.master')

@section('title', 'About')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="text-center mb-4"><b>About Me</b></h2>
                <div class="row">
                    <div class="col-md-4 text-center mb-4">
                        <img src="{{ asset('img\AipunGanteng.jpg') }}" alt="Profile" class="rounded-circle img-fluid mb-3">
                        <h4>Muh. Aipun Pratama</h4>
                        <p class="text-muted">Web Developer</p>
                    </div>
                    <div class="col-md-8">
                        <h5>Professional Background</h5>
                        <p>
                            I am a Software Developer at Google, specializing in creating efficient 
                            software solutions that support and streamline operations across diverse projects. 
                            My role involves coding, testing, and optimizing systems to ensure they meet organizational 
                            needs and drive innovation. With a strong focus on best practices and scalable code, I 
                            contribute to Google’s digital evolution and continually seek to expand my skills to deliver 
                            greater impact.
                        </p>
                        
                        <h5 class="mt-4">Skills</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-check-circle text-success me-2"></i>HTML & CSS</li>
                                    <li><i class="fas fa-check-circle text-success me-2"></i>Laravel & PHP</li>
                                    <li><i class="fas fa-check-circle text-success me-2"></i>Java & JavaScript</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-check-circle text-success me-2"></i>Python & C++</li>
                                    <li><i class="fas fa-check-circle text-success me-2"></i>Figma & Adobe APP</li>
                                    <li><i class="fas fa-check-circle text-success me-2"></i>Word & Excel</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
