<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Registration Page</title>

    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <style>
        .gradient-custom-2 {
            background: linear-gradient(to right, #248cee, #2750e5, #5d36dd);
        }
        @media (min-width: 768px) {
            .gradient-form {
                height: 100vh !important;
            }
        }
        @media (min-width: 769px) {
            .gradient-custom-2 {
                border-top-right-radius: .3rem;
                border-bottom-right-radius: .3rem;
            }
        }
    </style>
</head>

<body>
    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                           
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">
                                    <div class="text-center">
                                        <img src="{{ asset('images/logo.png') }}" style="width: 185px;" alt="logo">
                                        <h4 class="mt-1 mb-5 pb-1">Registration</h4>
                                    </div>

                                    <form action="{{ route('register') }}" method="POST" novalidate enctype="multipart/form-data">

                                        @csrf
                                        <p>Register an Account</p>
                                        

                                        <div class="mb-3">
                                            <label for="profile_image" class="form-label">Profile Image</label>
                                            <input type="file" class="form-control" id="profile_image" name="profile_image">
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="name" class="form-control" placeholder="Enter your name" value="{{ old('name') }}" required />
                                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label">Age</label>
                                            <input type="number" name="age" class="form-control" placeholder="Enter your Age" value="{{ old('age') }}" required />
                                            @error('age') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="email">Email</label>
                                            <input 
                                                type="email" 
                                                name="email" 
                                                class="form-control" 
                                                placeholder="Enter your email" 
                                                value="{{ old('email') }}" 
                                                required
                                                id="emailInput"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="top"
                                                title="Please type a valid email address"
                                            />
                                            @error('email') 
                                                <span class="text-danger">{{ $message }}</span> 
                                            @enderror
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" placeholder="Enter your password(min 6 characters)" required />
                                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label">Confirm Password</label>
                                            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm your password" required />
                                        </div>

                                        {{-- <div class="form-outline mb-4">
                                            <label class="form-label">User Type</label>
                                            <select name="user_type" class="form-control">
                                                <option value="user" {{ old('user_type') == 'user' ? 'selected' : '' }}>User</option>
                                                <option value="admin" {{ old('user_type') == 'admin' ? 'selected' : '' }}>Admin</option>
                                            </select>
                                            @error('user_type') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div> --}}
                                        
                                        
                                        <div class="text-center pt-2 mb-3 pb-2">
                                            <button type="submit" class="btn btn-primary btn-block gradient-custom-2" id="registerButton">Register</button>
                                        </div>

                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <a href="{{ route('login') }}" class="btn btn-outline-success">Back to Login Page</a>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h2 class="mb-4"><b>Registration</b></h2>
                                    <p class="small mb-0">Create your own account to explore the site and its features.</p>
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
