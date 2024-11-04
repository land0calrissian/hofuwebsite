
<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="utf-8">
        <title>Hofu Coffee</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="{{asset('css/style.css')}}" rel="stylesheet">
      
</head>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5 d-flex justify-content-center align-items-center">
                    <img src="img/logo.jpeg"
                        class="img-fluid rounded-1 w-50" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    {{-- Judul --}}
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                            <p class="lead  mb-0 me-3 fs-2 fw-bold">Welcome To Hofu Coffee!</p>
                           
                        </div>

                   

                        <!-- Phone Number input -->
                        <div class="form-outline mb-4 mt-5">
                            <label class="form-label" for="phone_number">Phone Number</label>
                            <input type="number" id="phone_number" name="phone_number" class="form-control form-control-lg"
                                placeholder="Contoh: 891372673" />
                            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control form-control-lg"
                                placeholder="Enter password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                       

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg"
                            {{-- tombol login --}}
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">{{ __('Log in') }}</button>
                            <p class="small fw-bold mt-5 mb-0">Don't have an account? <a href="{{ route('register') }}"
                                    class="link-danger">Register</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div
            class=" footer fixed-bottom d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
            <!-- Copyright -->
            <div class="text-white mb-3 mb-md-0">
                Copyright © 2024. All rights reserved.
            </div>
            <!-- Copyright -->

            <!-- logo bawah kanan -->
            <div>
                <a href="https://maps.app.goo.gl/j9R9KGDyaAAWfA5s9" class="text-white me-4">
                    <i class="fas fa-map-marker-alt"></i>
                </a>
                <a href="https://www.instagram.com/hofu.coffee" class="text-white me-4">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://www.google.com/search?q=hofu+coffee&sca_esv=492959cb0fa9f70d&rlz=1C1GCEA_enID1097ID1097&sxsrf=ADLYWILPtpJZhBz4t_Tj7TRQm_wqcuKRBQ%3A1730213308039&ei=vPUgZ-uFAoahnesP9a3asQc&oq=hofu+cof&gs_lp=Egxnd3Mtd2l6LXNlcnAiCGhvZnUgY29mKgIIADIKECMYgAQYJxiKBTIREC4YgAQYxwEYywEYjgUYrwEyCBAAGIAEGMsBMggQABiABBjLATIIEAAYgAQYywEyBhAAGBYYHjIIEAAYgAQYogQyCBAAGIAEGKIEMggQABiABBiiBDIIEAAYgAQYogRIkCZQnQJYxw9wAXgBkAEAmAHQAaABkgiqAQU0LjQuMbgBAcgBAPgBAZgCC6ACyxPCAgoQABiwAxjWBBhHwgINEAAYgAQYsAMYQxiKBcICCxAAGIAEGLEDGIMBwgIIEAAYgAQYsQPCAgUQABiABMICBBAjGCfCAgsQLhiABBixAxiDAcICChAAGIAEGEMYigXCAhAQLhiABBjRAxhDGMcBGIoFwgIIEC4YgAQY1ALCAggQLhiABBixA8ICBRAuGIAEwgILEC4YgAQYxwEYrwHCAgcQABiABBgKwgIOEC4YgAQYxwEYywEYrwHCAggQLhiABBjLAcICIBAuGIAEGMcBGMsBGI4FGK8BGJcFGNwEGN4EGOAE2AEBwgIIEAAYFhgKGB7CAggQABgWGB4YD5gDAIgGAZAGCroGBggBEAEYFJIHCTQuNS4xLjctMaAHt2k&sclient=gws-wiz-serp" class="text-white me-4">
                    <i class="fab fa-google"></i>
                </a>
                <a href="https://api.whatsapp.com/send?phone=6285213283833" class="text-white">
                    <i class="fab fa-whatsapp"></i>
                </a>
            </div>
            <!-- logo bawah kanan -->
        </div>
    </section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('lib/waypoints/waypoints.min.jss')}}"></script>
    <script src="{{asset('lib/lightbox/js/lightbox.min.js')}}"></script>
    <script src="{{asset('lib/owlcarousel/owl.carousel.min.js')}}"></script>
    
    
   
 
    <!-- Template Javascript -->
    <script src=" {{asset('js/main.js')}}"></script>