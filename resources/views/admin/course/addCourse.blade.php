@extends('admin.layout.index')

@section('title')
    Add Course
@endsection

@section('content')
    <div class="row py-3">
        <h1 class="py-2"><a href="{{route('admin#courseList')}}">Course</a> / Add Course</h1>
        <div class="col-md-8 offset-md-2 border border-black p-5">
            <h2 class="py-2 text-center">Add Course</h2>
            <hr>
            <form action="{{route('admin#addCourse')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4 py-2">
                        <div class="py-2">
                            <img src="{{asset('image/default.jpg')}}" alt="default image" class="w-100 img-thumbnail rounded">
                        </div>
                        <input type="file" name="image" class="form-control @error('name') is-invalid @enderror">
                        @error('image')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="col-md-8 py-2">
                        <div class="py-2">
                            <label for="" class="py-2">Course Name</label>
                            <input type="text" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" name="name">
                            @error('name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="py-2">
                            <label for="" class="py-2">Description</label>
                            <textarea name="description" id="" cols="30" rows="10" class="form-control @error('description') is-invalid @enderror">{{old('description')}}</textarea>
                            @error('description')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="py-2">
                            <label for="" class="py-2">Course Fee</label>
                            <input type="text"  value="{{old('course_fee')}}" class="form-control @error('course_fee') is-invalid @enderror" name="course_fee">
                            @error('course_fee')
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
