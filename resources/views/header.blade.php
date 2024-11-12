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
    <body>
     <!-- Spinner Start -->
        <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar start -->
        <div class="container-fluid fixed-top">
            <div class="container topbar bg-primary d-none d-lg-block">
                <div class="d-flex justify-content-between">
                    <div class="top-info ps-2">
                        <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="https://maps.app.goo.gl/j9R9KGDyaAAWfA5s9" class="text-white">Jl. Raya Kledokan No.11 Kledokan,  Kabupaten Sleman, Yogyakarta 55281</a></small>
                        <small class="me-3"><i class="fas fa-phone me-2 text-secondary"></i><a href="https://api.whatsapp.com/send?phone=6285213283833" class="text-white">+6285213283833</a></small>
                    </div>
                    
                </div>
            </div>
            <div class="container px-0">
                <nav class="navbar navbar-light bg-white navbar-expand-xl">
                    <a href="{{ route('dashboard') }}" class="navbar-brand">
                    <img src="{{ asset('img/logo.jpeg') }}" alt="Hofu Coffee Logo" class="img-fluid rounded-1 ms-4 mt-4" style="max-height: 90px;">
                    </a>
                    <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse bg-white mt-3" id="navbarCollapse">
                        <div class="navbar-nav mx-auto">
                            <a href="{{route('dashboard')}}" class="nav-item nav-link">Home</a>
                            <a href="" class="nav-item nav-link">Cart</a>
                            <a href="" class="nav-item nav-link">Orders</a>
                            

                            {{-- <a href="shop-detail.html" class="nav-item nav-link">Shop Detail</a> --}}
                            @auth
                            @if (auth()->user()->role == 2)
                           <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Admin Pages</a>
                                <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                <a href="{{route('user.index')}}" class=" dropdown-item">Search User</a>
                                    
                                    <a href="{{route('items.index')}}" class="dropdown-item">Manage Items</a>
                                </div>
                            </div> 
                            @endif
                            @endauth
                            
                        </div>
                         <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search text-primary"></i></button>
                       <div class="dropdown">
                           @auth
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="accountDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }} 
                                {{-- Profile --}}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.show') }}">
                                        {{ __('Profile') }}
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-secondary">
                                {{ __('Login') }}
                            </a>
                            <a href="{{ route('register') }}" class="btn btn-secondary">
                                {{ __('Register') }} 
                                </a>
                        @endauth
                        </div>
                  </div>
             </nav>
        </div>
    </div>
                                <!-- Navbar End -->


        <!-- Modal Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                     <form action="{{ route('dashboard') }}" method="GET">
                    <div class="modal-body d-flex align-items-center">
                        <div class="input-group w-75 mx-auto d-flex">
                            <input type="text" class="form-control p-3" name ="query" placeholder="keywords" aria-describedby="search-icon-1">
                            {{-- <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span> --}}
                             <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Search End -->

    

 <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('lib/waypoints/waypoints.min.jss')}}"></script>
    <script src="{{asset('lib/lightbox/js/lightbox.min.js')}}"></script>
    <script src="{{asset('lib/owlcarousel/owl.carousel.min.js')}}"></script>
    
    
   
 
    <!-- Template Javascript -->
    <script src=" {{asset('js/main.js')}}"></script>
    </body> 