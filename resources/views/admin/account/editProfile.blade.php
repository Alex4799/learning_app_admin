@extends('admin.layout.index')

@section('title')
    Profile
@endsection

@section('content')
<div class="container">
    <h1 class="py-3"><a href="{{route('admin#profile')}}">Profile</a> / Edit Profile</h1>
    <div class="">

        <div class=" shadow rounded py-4">
            <form action="{{route('admin#updateProfile')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row container-fluid">
                    <div class="col-md-3 offset-md-1" >
                        <div>
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
                        <div class="py-2">
                            <input type="file" name="image" id="" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 offset-md-2">

                        <div class="py-2">
                            <label class="py-2" for=""><i class="fa-solid fa-file-signature me-2"></i>Name</label>
                            <input type="text" name="name" class="form-control py-2" value="{{Auth::user()->name}}">
                            @error('name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="py-2">
                            <label class="py-2" for=""><i class="fa-solid fa-envelope me-2"></i>Email</label>
                            <input type="email" name="email" class="form-control py-2" value="{{Auth::user()->email}}">
                            @error('email')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="py-2">
                            <label class="py-2" for=""><i class="fa-solid fa-phone me-2"></i>Phone</label>
                            <input type="text" name="phone" class="form-control py-2" value="{{Auth::user()->phone}}">
                            @error('phone')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="py-2">
                            <label class="py-2" for=""><i class="fa-solid fa-venus-mars me-2"></i>Gender</label>
                            <select name="gender" id="" class="form-control">
                                <option value="" class="text-dark">Choose Gender</option>
                                <option value="male" class="text-dark" @if (Auth::user()->gender=='male') selected @endif>Male</option>
                                <option value="female" class="text-dark" @if (Auth::user()->gender=='female') selected @endif>Female</option>
                            </select>
                            @error('gender')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="py-2 float-end">
                            <input type="submit" value="Update" class="btn btn-primary">
                        </div>

                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
