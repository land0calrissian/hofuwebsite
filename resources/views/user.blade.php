@include('header')
@extends('layouts.app')

@section('content')
<div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Search User</h1>
           
        </div>
<div class="container-lg">
    {{-- <h1 class = "display-6 mt-3 mb-2">Search the User</h1> --}}

    <!-- Search Form Start -->
    <form action="{{ route('user.index') }}" method="GET" class="mb-4 mt-3">
    
    <h2 class="text-primary fs-4 mb-3">Search the user by Name, Phone, or ID</h2>
        <div class="row">
            <div class="col-md-12">
                <input type="text" class="form-control" name="search" placeholder="Search by Name, Phone, or ID" value="{{ request('search') }}">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>
    <!-- Search Form End -->

    @if (count($users) > 0)
        <table class="table table-bordered border-primary table-sm">
            <thead  >
                <tr class = "text-black">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Referral Code</th>
                    <th>Referral Points</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class = "text-black">
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>+62{{ $user->phone_number }}</td>
                        <td>
                         
                          {{ $user->referral_code }}
                        </td>
                        <td>
                            {{ $user->referral_points }}
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No users found.</p>
    @endif
</div>
@endsection