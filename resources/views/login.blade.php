<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>Login Page</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap">
  {{-- <link rel="stylesheet" href="css/bootstrap-login-form.min.css"> --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">


</head>

<body>
  <button class="btn position-absolute top-0 start-0 m-3 border-0 d-flex align-items-center" 
        style="background: transparent; color: #070202; font-size: 1.5rem; font-weight: bold;" 
        onclick="history.back()">
      <i class="bi bi-chevron-left"></i>
  </button>

  <style>
    .gradient-custom-2 {
      background: linear-gradient(to right, #248cee, #2750e5, #5d36dd);
    }
  </style>

  <section class="h-100 gradient-form" style="background-color: #eee;">
    
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-xl-10">
          <div class="card rounded-3 text-black">
            <div class="row g-0">
              <div class="col-lg-6">
                <div class="card-body p-md-5 mx-md-4">

                  <div class="text-center">
                    <h4 class="mt-1 mb-5 pb-1">Please Login</h4>
                  </div>

                  
                  @if(session('success'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  @endif

                  @if($errors->any())
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  @endif

                 
                  <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <p>Please login to your account</p>

                    <div class="form-outline mb-4">
                      <label class="form-label" for="email">Email</label>
                      <input type="email" id="email" name="email" class="form-control" placeholder="Enter your Email Address" required>
                    </div>

                    <div class="form-outline mb-4">
                      <label class="form-label" for="password">Password</label>
                      <input type="password" id="password" name="password" class="form-control" placeholder="Enter your Password" required>
                    </div>

                    <div class="text-center pt-2 mb-3 pb-2">
                      <button class="btn btn-primary btn-block gradient-custom-2" type="submit">Log in</button>
                    </div>
                    <div class="d-flex align-items-center justify-content-center pb-4">
                        <p class="mb-0 me-2">Don't have an account?</p>
                        <a href="{{ route('register') }}" class="btn btn-outline-success">Create New</a>
                      </div>
                  </form>
                </div>
              </div>

              <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                  <h2 class="mb-4"><b>WELCOME!</b></h2>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="{{asset('bootstrap/js/bootstrap.bundle.min.js')}}" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
