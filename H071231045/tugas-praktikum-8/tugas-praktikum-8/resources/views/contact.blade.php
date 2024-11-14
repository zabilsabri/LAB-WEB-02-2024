@extends('layouts.master')

@section('title', 'Contact')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="text-center mb-4">Get In Touch</h2>
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="text-center">
                            <i class="fas fa-envelope fa-2x mb-3 text-primary"></i>
                            <h5>Email</h5>
                            <p class="text-muted">aipunpratama@gmail.com</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <i class="fas fa-phone fa-2x mb-3 text-primary"></i>
                            <h5>Phone</h5>
                            <p class="text-muted">+62 813 412 933 88</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="text-center">
                            <i class="fas fa-map-marker-alt fa-2x mb-3 text-primary"></i>
                            <h5>Location</h5>
                            <p class="text-muted">Makassar, Indonesia</p>
                        </div>
                    </div>
                </div>
                
                <form>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" rows="5" required></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary px-4">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection