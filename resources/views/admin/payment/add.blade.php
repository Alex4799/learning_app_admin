@extends('admin.layout.index')

@section('title')
    Add Payment Method
@endsection

@section('content')
    <div class="row py-3">
        <h1 class="py-2"><a href="{{route('admin#paymentList')}}">Payment Method</a> / Add Payment Method</h1>
        <div class="col-md-8 offset-md-2 border border-black p-5">
            <h2 class="py-2 text-center">Add Payment Method</h2>
            <hr>
            <form action="{{route('admin#paymentAdd')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-8 offset-md-2 py-2">
                        <div class="py-2">
                            <label for="" class="py-2">Payment Name</label>
                            <input type="text" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" name="name">
                            @error('name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="py-2">
                            <label for="" class="py-2">User Name</label>
                            <input type="text" value="{{old('username')}}" class="form-control @error('username') is-invalid @enderror" name="username">
                            @error('username')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="py-2">
                            <label for="" class="py-2">Payment ID (or) Number</label>
                            <input type="text" value="{{old('number')}}" class="form-control @error('number') is-invalid @enderror" name="number">
                            @error('number')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="py-2">
                            <label for="" class="py-2">Sample Video</label>
                            <input type="text" value="{{old('video')}}" class="form-control @error('video') is-invalid @enderror" name="video">
                            @error('video')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="py-2 d-flex justify-content-end">
                            <input type="submit" value="Create" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

