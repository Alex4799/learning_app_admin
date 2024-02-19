@extends('admin.layout.index')

@section('title')
    Add Admin
@endsection

@section('content')
    <div class="row container-fluid py-3">
        <div class=" col-md-8 offset-md-2 border border-black shadow rounded p-3">
            <div>
                <h3 class="py-3 text-center">Admin List</h3>
            </div>
            <form action="{{route('admin#addAdmin')}}" method="post" class="row container-fluid">
                @csrf
                <div class="col-md-4">
                    <div>
                        <img src="{{asset('image/default.jpg')}}" alt="default Image" class="w-100 shadow rounded">
                    </div>
                    <div class="py-2">
                        <input type="file" name="image" class="form-control">
                        @error('image')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="py-2">
                        <label for="" class="py-2">Name</label>
                        <input type="text" name="name" class="form-control">
                        @error('name')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="py-2">
                        <label for="" class="py-2">Email</label>
                        <input type="email" name="email" class="form-control">
                        @error('email')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="py-2">
                        <label for="" class="py-2">Phone</label>
                        <input type="text" name="phone" class="form-control">
                        @error('phone')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="py-2">
                        <label for="" class="py-2">Position</label>
                        <input type="text" name="position" class="form-control">
                        @error('position')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="py-2">
                        <label for="" class="py-2">Gender</label>
                        <select name="gender" class="form-control">
                            <option value="">Choose Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        @error('gender')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="py-2">
                        <label for="" class="py-2">Password</label>
                        <input type="password" name="password" class="form-control">
                        @error('password')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="py-2">
                        <label for="" class="py-2">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control">
                    </div>



                </div>
                <div class="d-flex justify-content-end">
                    <input type="submit" value="Create" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
@endsection
