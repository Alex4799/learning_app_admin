@extends('admin.layout.index')

@section('title')
    Edit Course
@endsection

@section('content')
    <div class="row py-3">
        <h1 class="py-2"><a href="{{route('admin#courseList')}}">Course</a> / Edit Course</h1>
        <div class="col-md-8 offset-md-2 border border-black p-5">
            <h2 class="py-2 text-center">Edit Course</h2>
            <hr>
            <form action="{{route('admin#updateCourse')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4 py-2">
                        <div class="py-2">
                            @if ($course->image!=null)
                                <img src="{{asset('storage/courseImage/'.$course->image)}}" class="w-100 img-thumbnail" alt="course image">
                            @else
                                <img src="{{asset('image/default.jpg')}}" class="w-100 img-thumbnail" alt="course image">
                            @endif
                        </div>
                        <input type="file" name="image" class="form-control @error('name') is-invalid @enderror">
                        @error('image')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="col-md-8 py-2">
                        <div class="py-2">
                            <label for="" class="py-2">Course Name</label>
                            <input type="text" value="{{old('name',$course->name)}}" class="form-control @error('name') is-invalid @enderror" name="name">
                            @error('name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="py-2">
                            <label for="" class="py-2">Description</label>
                            <textarea name="description" id="" cols="30" rows="10" class="form-control @error('description') is-invalid @enderror">{{old('description',$course->description)}}</textarea>
                            @error('description')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="py-2">
                            <label for="" class="py-2">Course Fee (MMK)</label>
                            <input type="text"  value="{{old('course_fee',$course->course_fee)}}" class="form-control @error('course_fee') is-invalid @enderror" name="course_fee">
                            @error('course_fee')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <input type="hidden" name="id" id="" value="{{$course->id}}">
                        <div class="py-2 d-flex justify-content-end">
                            <input type="submit" value="Update" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
