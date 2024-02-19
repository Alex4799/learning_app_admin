@extends('admin.layout.index')

@section('title')
    Profile
@endsection

@section('content')
<div class="container">
    <h1 class="py-3">Profile</h1>
    <div class="">

        @if (session('updateSucc'))
            <div class="alert alert-success alert-dismissible fade show col-md-4 offset-md-8" role="alert">
                {{session('updateSucc')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('deleteSucc'))
            <div class="alert alert-danger alert-dismissible fade show col-md-4 offset-md-8" role="alert">
                {{session('deleteSucc')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class=" shadow rounded py-4">
            <div class="row container-fluid">
                <div class="col-md-3 offset-md-1 py-4" >
                    @if (Auth::user()->image==null)
                        @if (Auth::user()->gender=='male')
                            <img src="{{asset('image/default-male-image.png')}}" alt="Male Default Profile Image" class="w-100 rounded img-thumbnail">
                        @else
                            <img src="{{asset('image/default-female-image.webp')}}" alt="Female Default Profile Image" class="w-100 rounded img-thumbnail">
                        @endif
                    @else
                        <img src="{{asset('storage/profile/'.Auth::user()->image)}}" alt="User Profile" class="w-100 rounded img-thumbnail">
                    @endif
                </div>
                <div class="offset-md-2 col-md-6 py-4">
                    <h4 class="py-2"><i class="fa-solid fa-file-signature me-2"></i>Name - {{Auth::user()->name}}</h4>
                    <h4 class="py-2"><i class="fa-solid fa-envelope me-2"></i>Email - {{Auth::user()->email}}</h4>
                    <h4 class="py-2"><i class="fa-solid fa-phone me-2"></i>Phone - {{Auth::user()->phone}}</h4>
                    <h4 class="py-2"><i class="fa-solid fa-venus-mars me-2"></i>Gender - {{Auth::user()->gender}}</h4>
                    <h4 class="py-2"><i class="fa-solid fa-hammer me-2"></i>Position - {{Auth::user()->position}}</h4>
                    <div class="">
                        <a href="{{route('admin#editProfile')}}" class="btn btn-primary my-2"><i class="fa-solid fa-pen-to-square me-2"></i>Edit Profile</a>
                        <a href="{{route('admin#deleteProfilePhoto')}}" class="btn btn-danger my-2"><i class="fa-solid fa-trash me-2"></i>Delete Profile Photo</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
