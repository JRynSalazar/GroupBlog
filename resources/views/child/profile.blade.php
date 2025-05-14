@extends('mainapp')

@section('title', 'Profile')
@section('navtitle', 'Profile')

@section('body')

@if(!Auth::check())
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="text-center">
            <h2 class="mb-4">Login First to Access This Page</h2>
            <a href="{{ route('login') }}" class="btn btn-primary px-5 py-2">Login</a>
        </div>
    </div>
@else

<div class="mt-5">
    <div class="container mt-5">
        <section class="row justify-content-center">
        
            <div class="col-lg-4 d-flex flex-column align-items-center">
                <div class="mb-4">
                    
                    <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image" class="img-fluid rounded-circle" style="width: 180px; height: 180px; object-fit: cover; border: 5px solid #fff; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                </div>

                <div class="card shadow-lg border-0 mb-4" style="border-radius: 12px;">
                    <div class="card-body text-center">
                        <h5 class="card-title" style="font-size: 1.25rem; font-weight: bold;">Total Posts</h5>
                        <p class="card-text" style="font-size: 2rem; font-weight: bold; color: #007bff;">{{ $postCount }}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 d-flex align-items-center">
                <div class="card shadow-lg border-0 p-4" style="background: #f8f9fa; border-radius: 12px; width: 100%;">
                    <div class="text-dark" style="font-size: 1.1rem; line-height: 1.8;">
               
                        <p><strong>Name:</strong> {{ $user->name }}</p>
                        <p><strong>Age:</strong> {{ $user->age }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>Bio:</strong> {{ $user->bio }}</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                            Edit Profile
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label"><strong>Name:</strong></label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="age" class="form-label"><strong>Age:</strong></label>
                        <input type="number" class="form-control" id="age" name="age" value="{{ old('age', $user->age) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label"><strong>Email:</strong></label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="bio" class="form-label"><strong>Bio:</strong></label>
                        <textarea class="form-control" id="bio" name="bio" rows="4">{{ old('bio', $user->bio) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="profile_image" class="form-label"><strong>Profile Image:</strong></label>
                        <input type="file" class="form-control" id="profile_image" name="profile_image">
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
