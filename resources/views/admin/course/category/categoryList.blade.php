@extends('admin.layout.index')

@section('title')
    Course Category List
@endsection

@section('content')
    <div>
        <h1 class="py-2"><a href="{{route('admin#courseList')}}">Course</a> / <a href="{{route('admin#viewCourse',$course->id)}}">View Course</a> / Course Category List</h1>
        <h1 class="py-3"></h1>
        <div class="d-flex justify-content-end py-3">
            <a href="{{route('admin#addCourseCategoryPage',$course->id)}}" class="btn btn-primary"><i class="fa-solid fa-plus me-2"></i>Add Course</a>
        </div>
        @if (session('createSucc'))
            <div class="alert alert-success alert-dismissible fade show col-md-4 offset-md-8" role="alert">
                {{session('createSucc')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('UpdateSucc'))
            <div class="alert alert-success alert-dismissible fade show col-md-4 offset-md-8" role="alert">
                {{session('UpdateSucc')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('deleteFail'))
            <div class="alert alert-danger alert-dismissible fade show col-md-4 offset-md-8" role="alert">
                {{session('deleteFail')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('DeleteSucc'))
            <div class="alert alert-danger alert-dismissible fade show col-md-4 offset-md-8" role="alert">
                {{session('DeleteSucc')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="py-2">
            <h2 class="py-2 text-center">{{$course->name}}</h2>
            <div class="row">
                @if (count($courseCategory)==0)
                    <h2 class="text-center py-2 text-primary">There is no category</h2>
                @endif
                @foreach ($courseCategory as $item)
                    <div class="col-md-3 p-3">
                        <div class="bag-white shadow rounded p-2 text-center">
                            <h6 class="py-2">ID - {{$item->id}}</h6>
                            <h6 class="py-2">Name - {{$item->name}}</h6>
                            <h6 class="py-2">Lesson - {{$item->lesson_count}}</h6>
                            <div  class="py-2 d-flex justify-content-around">
                                <a href="{{route('admin#viewCourseCategory',$item->id)}}" class="btn btn-secondary"><i class="fa-solid fa-eye"></i></a>
                                <a href="{{route('admin#editCourseCategory',$item->id)}}" class="btn btn-secondary"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="{{route('admin#deleteCourseCategory',$item->id)}}" class="btn btn-secondary"><i class="fa-solid fa-trash"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
