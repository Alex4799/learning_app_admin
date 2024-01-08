@extends('admin.layout.index')

@section('title')
    Add Course Category
@endsection

@section('content')
    <div class="row py-3">
        <h1 class="py-2"><a href="{{route('admin#viewCourse',$course_id)}}">View Course</a> / <a href="{{route('admin#courseCategoryList',$course_id)}}">Course Category List</a> / Add Course Category</h1>
        <div class="col-md-8 offset-md-2 border border-black p-5">
            <h2 class="py-2 text-center">Add Course Category</h2>
            <hr>
            <form action="{{route('admin#addCourseCategory')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="">
                    <div class="">
                        <div class="py-2">
                            <label for="" class="py-2">Course Category Name</label>
                            <input type="text" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" name="name">
                            @error('name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <input type="hidden" value="{{$course_id}}" name="course_id">
                        <div class="py-2 d-flex justify-content-end">
                            <input type="submit" value="Create" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
