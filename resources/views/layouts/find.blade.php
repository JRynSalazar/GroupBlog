<div class="mb-5">  
    <h3 class="text-center" style=" color: rgb(0, 0, 0);">
        <span style="color: #c51919; font-size: 50px; font-weight: bold;">W</span>hat You’ll Find Here?
    </h3>
</div>

<div class="container">
    <section class="row g-4">
        <div class="col-12 col-md-6">
            <div class="card h-100">
                <img src="{{ asset('images/under.png') }}" class="card-img-top fixed-img" alt="Understanding Discrimination">
                <div class="card-body">
                    <h5 class="card-title"><b>Understanding Discrimination</b></h5>
                    <p class="card-text">Learn about different types of discrimination and their effects.</p>
                    {{-- <a href="#" class="btn btn-primary">Learn More</a> --}}
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="card h-100">
                <img src="{{ asset('images/stories.png') }}" class="card-img-top fixed-img" alt="Stories & Experiences">
                <div class="card-body">
                    <h5 class="card-title"><b>Stories & Experiences</b></h5>
                    <p class="card-text">Read real stories from people who have faced discrimination.</p>
                    {{-- <a href="#" class="btn btn-primary">Read More</a> --}}
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="card h-100">
                <img src="{{ asset('images/how.png') }}" class="card-img-top fixed-img" alt="How You Can Help">
                <div class="card-body">
                    <h5 class="card-title"><b>How You Can Help</b></h5>
                    <p class="card-text">Practical steps to challenge bias and promote inclusion.</p>
                    {{-- <a href="#" class="btn btn-primary">Get Involved</a> --}}
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="card h-100">
                <img src="{{ asset('images/news.png') }}" class="card-img-top fixed-img" alt="Latest News & Resources">
                <div class="card-body">
                    <h5 class="card-title"><b>Latest News & Resources</b></h5>
                    <p class="card-text">Stay updated on equality movements and policies.</p>
                    {{-- <a href="#" class="btn btn-primary">Stay Updated</a> --}}
                </div>
            </div>
        </div>
    </section>

    
</div>


<style>
    .fixed-img {
        width: 100%;
        max-height: 250px;
        object-fit: cover;
    }
</style>
