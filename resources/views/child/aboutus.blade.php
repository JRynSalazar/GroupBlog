@extends('mainapp')
@section('title', 'About Us')
@section('navtitle', 'About Us')


@section('body')

<section>
    <div class="card p-4 shadow-lg border-0" style="background: #f8f9fa; border-radius: 12px; position: relative; overflow: hidden;">
        <div class="d-flex justify-content-center">
            <h3 class="card-title fw-bold " style="font-size: 60px;">
                <span style="color: #c51919; font-size: 80px; font-weight: bold;">A</span>bout Us
            </h3>
        </div>

        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('images/lg_group.png') }}" class="img-fluid" style="max-width: 100%;" alt="Breaking Barriers">
                </div>
                
                
            <div class="col-md-6">
                    <p style="font-size: 18px; text-align: justify;">
                        At Breaking Barriers, we are dedicated to raising awareness about discrimination and promoting equality for all. Whether based on race, gender, ethnicity, religion, or any other factor, discrimination continues to affect individuals and communities	 worldwide. Our mission is to educate, inspire, and empower people to stand against injustice and create a more inclusive society.
                    </p>
                </div>
            </div>
            
        </div>

        <div class="d-flex justify-content-center mt-5">
            <h3 class="card-title fw-bold " style="font-size: 60px;">
                <span style="color: #c51919; font-size: 80px; font-weight: bold;">O</span>ur Mission
            </h3>
        </div>

            <div class="container mt-5 d-flex justify-content-center">
                <p style="font-size: 20px; text-align: center;">We believe in a world where everyone is treated with dignity and respect, regardless of their background. Our goal is to:</p>
            </div>

        
            <div class="container d-flex justify-content-center mt-5">
                <ul class="list-unstyled" style="font-size: 20px">
                    <li class="d-flex align-items-center mb-3">
                        <i class="fas fa-lightbulb text-primary me-3" style="font-size: 24px;"></i>
                        <span>Educate people about different forms of discrimination and their impact.</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="fas fa-users text-danger me-3" style="font-size: 24px;"></i>
                        <span>Share real-life stories to foster understanding and empathy.</span>
                    </li>
                    <li class="d-flex align-items-center mb-3">
                        <i class="fas fa-hands-helping text-success me-3" style="font-size: 24px;"></i>
                        <span>Provide resources and actionable steps to combat bias and inequality.</span>
                    </li>
                </ul>
            </div>

            <div class="d-flex justify-content-center mt-5">
                <h3 class="card-title fw-bold " style="font-size: 60px;">
                    <span style="color: #c51919; font-size: 80px; font-weight: bold;">W</span>hy it Matters
                </h3>
            </div>

            
            <div class="container mt-5 d-flex justify-content-center">
                <p style="font-size: 20px; text-align: center;">Discrimination affects mental health, limits opportunities, and creates social divides. But by working together, we can break these barriers and build a society based on fairness, acceptance, and unity. Every small action counts, and change starts with awareness.</p>
            </div>

            <div class="d-flex justify-content-center mt-5">
                <h3 class="card-title fw-bold " style="font-size: 60px;">
                    <span style="color: #c51919; font-size: 80px; font-weight: bold;">J</span>oin Us in Making a Difference
                </h3>
            </div>

            
            <div class="container mt-5 d-flex justify-content-center">
                <p style="font-size: 20px; text-align: center;">Whether you want to learn more, share your experiences, or take action, Breaking Barriers is here to support you. Together, we can challenge discrimination and create a world where everyone belongs.</p>
            </div>
            
            <div class="mt-5"></div>
    </div>
    
</section>


@endsection