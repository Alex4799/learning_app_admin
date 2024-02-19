@extends('admin.layout.index')

@section('title')
    Edit Course Category
@endsection

@section('content')
    <div class="row py-3">
        <h1 class="py-2"><a href="{{route('admin#viewCourse',$courseCategory->course_id)}}">View Course</a> / <a href="{{route('admin#courseCategoryList',$courseCategory->course_id)}}">Course Category List</a> / Edit Course Category</h1>
        <div class="col-md-8 offset-md-2 border border-black p-5">
            <h2 class="py-2 text-center">Edit Course Category</h2>
            <hr>
            <form action="{{route('admin#updateCourseCategory')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="">
                    <div class="">
                        <div class="py-2">
                            <label for="" class="py-2">Course Category Name</label>
                            <input type="text" value="{{old('name',$courseCategory->name)}}" class="form-control @error('name') is-invalid @enderror" name="name">
                            @error('name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <input type="hidden" name="id" value="{{$courseCategory->id}}">
                        <div class="py-2 d-flex justify-content-end">
                            <input type="submit" value="Update" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
