@extends('mainapp')
@section('title', 'Article')

@section('navtitle', 'Article')

@section('body')

<div class="container-fluid">
    <div class="content full-width" id="content">

        <h3 class="article-title">
            <span class="highlight">A</span><b>rticle</b>
        </h3>

        @include('admin.addarticle', ['media' => $media, 'latestMedia' => $latestMedia, 'moreMedia' => $moreMedia])

        <hr class="section-divider">

        <div class="container text-center mt-5">
            <h3 class="section-title" id="page2">
                <span class="highlight">T</span>ypes of Discrimination
            </h3>
        </div>

        @include('blog.types')

        <hr class="section-divider">

        <h3 class="questions-title" id="page3">
            <span class="highlight">Q</span><b>uestions</b>
        </h3>

        @include('blog.questions')

        <div class="sidebar hidden" id="sidebar">
            @include('layouts.sidemenu')
        </div>

        <button class="toggle-btn mt-5" id="toggle-btn">
            ☰
        </button>
    </div>
</div>

<style>
   
    .article-title, .section-title, .questions-title {
        font-size: 5vw; 
        text-align: center;
        margin-top: 20px;
    }

    .highlight {
        color: #c51919;
        font-weight: bold;
        font-size: 6vw;
    }

    .section-divider {
        border: 2px solid #9e9a9a;
        margin: 20px auto;
        width: 80%;
    }

    .sidebar {
        width: 250px;
        height: 100vh;
        position: fixed;
        top: 0;
        right: 0;
        background-color: #343a40;
        color: white;
        padding: 20px;
        transition: transform 0.3s ease-in-out;
        overflow: auto;
        z-index: 1000;
    }

    .sidebar.hidden {
        transform: translateX(100%);
    }

    .content {
        padding: 20px;
        transition: margin-right 0.3s ease-in-out, width 0.3s ease-in-out;
    }

    .content.full-width {
        margin-right: 20px;
        width: calc(100% - 20px);
    }

    .content.shifted {
        margin-right: 270px;
        width: calc(100% - 270px);
    }

    .toggle-btn {
        position: fixed;
        top: 20px;
        right: 20px;
        background-color: red;
        color: white;
        border: none;
        padding: 10px 15px;
        font-size: 20px;
        cursor: pointer;
        border-radius: 5px;
        transition: background 0.3s ease-in-out;
        z-index: 1100;
    }

    .toggle-btn:hover {
        background-color: darkred;
    }

    @media (max-width: 768px) {
        .article-title, .section-title, .questions-title {
            font-size: 7vw;
        }

        .highlight {
            font-size: 8vw;
        }

        .content {
            padding: 10px;
        }

        .toggle-btn {
            top: 10px;
            right: 10px;
            font-size: 16px;
            padding: 8px 12px;
        }

        .section-divider {
            width: 90%;
        }
    }
</style>

<script>
    document.getElementById("toggle-btn").addEventListener("click", function() {
        var sidebar = document.getElementById("sidebar");
        var content = document.getElementById("content");

        if (sidebar.classList.contains("hidden")) {
            sidebar.classList.remove("hidden");
            content.classList.remove("full-width");
            content.classList.add("shifted");
        } else {
            sidebar.classList.add("hidden");
            content.classList.remove("shifted");
            content.classList.add("full-width");
        }
    });
</script>

@endsection
