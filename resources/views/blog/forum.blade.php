@extends('mainapp')

@section('title', 'Forum')
@section('navtitle', 'Forum')

@section('body')

<div class="container mt-5 d-flex justify-content-center">
    <h3 class="card-title fw-bold" style="font-size: 60px;">
        <span style="color: #c51919; font-size: 80px; font-weight: bold;">F</span>orum
    </h3>
</div>

<div class="container mt-5 d-flex justify-content-center" style="font-size: 20px;">
    <p><b>Share your Experience, thoughts, and opinions with others.</b></p>
</div>

@if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif  

<div class="container mt-5">
    @include('layouts.post', ['post_comments' => $post_comments])  
</div>

<div class="text-center mt-4">
    <a href="{{ route('blog.allpost') }}" class="btn btn-primary">See More</a>
</div>

@if(!Auth::check())
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="text-center">
            <h2 class="mb-4">Want to share a story? Please login first</h2>
            <a href="{{ route('login') }}" class="btn btn-primary px-5 py-2">Login</a>
        </div>
    </div>
@else

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="mb-0">Add New Post</h2>
        {{-- <a href="{{ route('post-comment.index') }}" class="btn btn-outline-secondary">⬅ Back to Posts</a> --}}
    </div>

    

    <div class="card mt-3 shadow">
        <div class="card-body">
            <form action="{{ route('post-comment.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="type_id" class="form-label">Discrimination Type <span class="text-danger">*</span></label>
                    <select name="type_id" class="form-select" required>
                        <option value="">Select a type</option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}">{{ $type->type }}</option>
                        @endforeach
                    </select>
                    @error('type_id') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" required>
                    @error('title') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                    <textarea name="content" class="form-control" rows="4" required></textarea>
                    @error('content') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                {{-- <div class="mb-3">
                    <label for="author_name" class="form-label">Author Name <span class="text-danger">*</span></label>
                    <input type="text" name="author_name" class="form-control" required>
                    @error('author_name') <div class="text-danger">{{ $message }}</div> @enderror
                </div> --}}

                <div class="mb-3">
                    <label for="image" class="form-label">Upload Image (Optional)</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    @error('image') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">📩 Submit Post</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection
