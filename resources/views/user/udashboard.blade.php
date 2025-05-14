@extends('mainapp')

@section('title', 'Dashboard')
@section('navtitle', 'Dashboard')

@section('body')
<div class="container-fluid p-0">
    <div class="shadow img-fluid" style="width: 100vw; height: 400px; position: relative; overflow: hidden; border-radius: 0;">
       
        <img src="{{ asset('images/blogbg.png') }}" alt="My Image" class="img-fluid w-100 h-100" style="object-fit: cover; position: absolute; top: 0; left: 0;">

      
        <div class="text-white d-flex align-items-center justify-content-between" style="position: absolute; bottom: 30px; left: 30px; width: 100%; padding: 20px;">
    
            <img src="{{ asset('images/lg_group.png') }}" alt="icon" class="img-fluid" style="max-width: 300px; height: auto; cursor: pointer;">

            <h1 class="m-0 text-end" style="line-height: 1; flex-grow: 1; padding-right: 40px; font-size: 2.5rem;">
           
            </h1>
        </div>
    </div>
</div>


@include('layouts.welcome')


    <div class="mt-5">
        <div class="container">
            <section class="row">
            
                <div class="col-lg-6 d-flex justify-content-center">
                    <video width="100%" height="auto" controls>
                        <source src="{{ asset('videos/intro-vid.mp4') }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>

                <div class="col-lg-6 d-flex align-items-center">
                    <div class="card p-4 shadow-lg border-0" style="background: #f8f9fa; border-radius: 12px;">
                        <div class="text-dark text-justify" style="font-size: 18px; line-height: 1.6;">
                            <p style="margin-bottom: 0;">
                                <span style="font-size: 50px; font-weight: bold; color: #333; float: left; line-height: 1;">D </span>iscrimination—whether based on skin color, gender, ethnicity, religion, or any other factor—continues to divide our society. Despite progress in laws and awareness, many still face unfair treatment simply because of who they are. The challenge of discrimination lies not only in overcoming these biases but in creating a society where every individual is valued and treated with respect, regardless of their background or beliefs. At Breaking Barriers, we are committed to bringing these issues to light, encouraging conversations, and inspiring change toward a world where equality is the standard, not the exception. Together, we can help break down the barriers that continue to separate us and build a future grounded in acceptance and unity.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>


<hr class="mt-5" style="border: 2px solid #9e9a9a; margin: 20px 10%;">

<div class="mt-5">
    @include('layouts.question')
</div>  


<hr class="mt-5" style="border: 2px solid #9e9a9a; margin: 20px 10%;">



<div class="mt-5">
    @include('layouts.find')
</div>

<hr class="mt-5" style="border: 2px solid #9e9a9a; margin: 20px 10%;">

<div class="mt-5">
    @include('layouts.socials')
</div>  

<hr class="mt-5" style="border: 2px solid #9e9a9a; margin: 20px 10%;">


<div class="mt-5">
    @include('layouts.discuss')
</div>



@endsection


