@extends('layouts.app')
@include ('header')
@section('content')
<div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Profile</h1>
           
        </div>
<section class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-4 mb-sm-5">
                <div class="card card-style1 border-0">
                    <div class="card-body p-1-9 p-sm-2-3 p-md-6 p-lg-7">
                        <div class="row align-items-center">
                            <div class="col-lg-6 mb-4 mb-lg-0">
                                <img src="img/avatar.png" alt="..." style= "width: 400px">
                            </div>
                            <div class="col-lg-6 px-xl-10">
                                <div class="d-lg-inline-block py-1-9 px-1-9 px-sm-6 mb-1-9 rounded">
                                    <h3 class="h2 text-black mb-0">{{$user->name}}</h3>
                                    @if ($user->role == 1)
                                    <span class="text-primary">User</span>
                                    @else
                                    <span class="text-primary">Admin</span>
                                    @endif
                                </div>
                                <ul class="list-unstyled mb-1-9">
                                    
                                    <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">Referral Code:</span> {{$user->referral_code}}</li>
                                    <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">Referral Points:</span> {{$user->referral_points}}</li>
                                    <li class="mb-2 mb-xl-3 display-28"><span class="display-26 text-secondary me-2 font-weight-600">Member Since:</span> {{$user->created_at->format('d M Y, h:i A')}}</li>
                                    <li class="display-28"><span class="display-26 text-secondary me-2 font-weight-600">Phone:</span>+62 {{$user->phone_number}}</li>
                                </ul>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
</section>
@endsection