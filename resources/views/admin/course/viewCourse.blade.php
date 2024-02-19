@extends('admin.layout.index')

@section('title')
    View Course
@endsection

@section('content')
    <div>
        <h1 class="py-2"><a href="{{route('admin#courseList')}}">Course</a> / View Course</h1>
        @if (session('deleteFail'))
            <div class="alert alert-danger alert-dismissible fade show col-md-4 offset-md-8" role="alert">
                {{session('deleteFail')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="row">
            <div class="col-md-8 offset-md-2 border border-black rounded p-3">
                <div class="row">
                    <div class="col-md-4 py-2">
                        @if ($course->image==null)
                            <img src="{{asset('image/default.jpg')}}" class="w-100 img-thumbnail" alt="course image">
                        @else
                            <img src="{{asset('storage/courseImage/'.$course->image)}}" class="w-100 img-thumbnail" alt="course image">
                        @endif
                    </div>
                    <div class="col-md-8 py-2">
                            <h3 class="py-2">{{$course->name}}</h3>
                            <div class="d-flex gap-2 flex-wrap">
                                <a href="{{route('admin#courseCategoryList',$course->id)}}" class="my-2 btn btn-secondary">{{$course->course_category_count}} Course Category</a>
                                <a href="#" class="my-2 btn btn-secondary">{{$course->lesson_count}} Lesson Count</a>
                                <a href="#" class="my-2 btn btn-secondary">{{$course->course_fee}} MMK</a>
                            </div>
                            <p class="p-3 text-justify">{{$course->description}}</p>
                            <div class="py-2">
                                @foreach ($courseCategory as $item)
                                    <div class="py-2">
                                        <a href="{{route('admin#viewCourseCategory',$item->id)}}" class="w-100">
                                            <div class="py-2 bg-secondary rounded shadow d-flex justify-content-around">
                                                <h6>{{$item->name}}</h6>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                            <div>
                                <a href="{{route('admin#editCourse',$course->id)}}" class="py-2 btn btn-secondary"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="{{route('admin#deleteCourse',$course->id)}}" class="py-2 btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
