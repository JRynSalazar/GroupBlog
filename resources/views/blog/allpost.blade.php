@extends('mainapp')

@section('title', 'All Posts')
@section('navtitle', 'All Posts')

@section('body')
<section>
    <div class="container mt-5 d-flex justify-content-start">
        <button class="btn mt-5 position-absolute top-0 start-0 m-3 border-0 d-flex align-items-center" 
            style="background: transparent; color: #070202; font-size: 1.5rem; font-weight: bold;" 
            onclick="history.back()">
            <i class="bi bi-chevron-left"></i>
        </button>
    </div>

<div class="container mt-5 d-flex justify-content-center">
    <h3 class="card-title fw-bold" style="font-size: 60px;">
        <span style="color: #c51919; font-size: 80px; font-weight: bold;">A</span>ll post
    </h3>
</div>


</section>
<div class="container mt-4">
    <form method="GET" action="{{ route('blog.allpost') }}">
        <div class="input-group">
            <input type="text" class="form-control" name="search" placeholder="Search posts..." value="{{ request()->get('search') }}">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>
</div>

@include('layouts.post', ['post_comments' => $post_comments, 'types' => $types])
@endsection
