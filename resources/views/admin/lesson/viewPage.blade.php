@extends('admin.layout.index')

@section('title')
    View Lesson
@endsection

@section('content')
    <div class="row py-3">
        <div class="">
            <h1 class="py-2"><a href="{{route('admin#viewCourseCategory',$lesson->course_category_id)}}">Lesson List</a> / View Lesson</h1>
            <div class="row">

                @if (session('updateSucc'))
                    <div class="alert alert-success alert-dismissible fade show col-md-4 offset-md-8" role="alert">
                        {{session('updateSucc')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="col-md-8 offset-md-2 p-3 border border-black shadow rounded">
                    <h3>{{$lesson->name}}</h3>
                    <p class="p-3">{{$lesson->description}}</p>
                    @if ($lesson->vd_link != null)
                        <div class="d-flex justify-content-center">
                            <iframe width="560" height="315" src="{{$lesson->vd_link}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        </div>
                    @endif
                    <div class="py-3 float-end">
                        <a href="{{route('admin#editLesson',$lesson->id)}}" class="btn btn-secondary"><i class="fa-solid fa-pen-to-square me-2"></i>Edit</a>
                        <a href="{{route('admin#deleteLesson',$lesson->id)}}" class="btn btn-danger"><i class="fa-solid fa-trash me-2"></i>Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
