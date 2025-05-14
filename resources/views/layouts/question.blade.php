<div class="container mt-5">
    <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center">
            <div class="card p-5 shadow-lg border-0" style="background: #ffffff; border-radius: 16px; position: relative; overflow: hidden;">
                <div class="card-body">
                  
                    <h3 class="card-title fw-bold" style="font-size: 48px;">
                        <span style="color: #c51919; font-size: 50px; font-weight: bold;">Q</span>uestions
                    </h3>
        
                    <div style="width: 50px; height: 4px; background-color: #c51919; margin: 10px 0;"></div>

                    <p class="card-text mt-3" style="font-size: 18px; text-align: justify; color: #555;">
                        <span style="font-size: 42px; font-weight: bold; color: #333; float: left; line-height: 1;">D</span>
                        iscrimination can have severe negative consequences, including limiting opportunities, 
                        impacting mental health and well-being, and perpetuating inequality.
                    </p>
        
                    <h5 class="mt-4 fw-bold text-primary">Here, you will know:</h5>
        
                    <ul class="list-unstyled mt-3">
                        <li class="d-flex align-items-center">
                            <i class="bi bi-check-circle text-success me-2"></i> Why does discrimination still exist?
                        </li>
                        <li class="d-flex align-items-center">
                            <i class="bi bi-check-circle text-success me-2"></i> How does it impact individuals and communities?
                        </li>
                        <li class="d-flex align-items-center">
                            <i class="bi bi-check-circle text-success me-2"></i> What can we do to create a more inclusive world?
                        </li>
                    </ul>
        
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('blog.article') }}" class="btn text-primary fw-bold mt-3 px-4 py-2 explore-btn">
                            Explore..
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
         
        <div class="col-lg-6 d-flex align-items-center">
            <div class="container">
                <div class="row">
            
                    <div class="col-md-6 d-flex flex-column">
                        <div class="mb-2">
                            <img src="{{ asset('images/5.jpg') }}" class="img-fluid w-100 rounded shadow-sm" style="height: 300px; object-fit: cover;" alt="Big Left">
                        </div>
                        <div>
                            <img src="{{ asset('images/4.jpg') }}" class="img-fluid w-100 rounded shadow-sm" style="height: 150px; object-fit: cover;" alt="Small Left">
                        </div>
                    </div>
            
                    <div class="col-md-6 d-flex flex-column">
                        <div class="mb-2">
                            <img src="{{ asset('images/2.jpg') }}" class="img-fluid w-100 rounded shadow-sm" style="height: 150px; object-fit: cover;" alt="Small Right">
                        </div>
                        <div>
                            <img src="{{ asset('images/1.jpg') }}" class="img-fluid w-100 rounded shadow-sm" style="height: 300px; object-fit: cover;" alt="Big Right">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>


<style>
    
    .explore-btn {
        font-size: 1.1rem;
        transition: transform 0.2s ease-in-out; 
    }
    
    .explore-btn:hover {
        transform: scale(1.1);
        color: #c51919 !important;
    }

    .explore-btn {
            font-size: 1.2rem;
            transition: transform 0.2s ease-in-out, color 0.2s;
        }
        
        .explore-btn:hover {
            transform: scale(1.1);
            color: #c51919 !important;
        }
    
        .list-unstyled li {
            font-size: 18px;
            color: #444;
            margin-bottom: 8px;
        }
</style>

   