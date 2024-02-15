@extends('admin.layout.index')

@section('title')
    Lesson List
@endsection

@section('content')
    <div>
        <h1 class="py-2"><a href="{{route('admin#courseCategoryList',$courseCategory->course_id)}}">Course Category</a> / Lesson List</h1>
        <h1 class="py-3">Lesson List</h1>
        <div class="d-flex justify-content-around py-3">
            <h2>Total - {{count($lesson)}}</h2>
            <a href="{{route('admin#addLessonPage',$courseCategory->id)}}" class="btn btn-primary"><i class="fa-solid fa-plus me-2"></i>Add Lesson</a>
        </div>

        @if (session('createSucc'))
            <div class="alert alert-success alert-dismissible fade show col-md-4 offset-md-8" role="alert">
                {{session('createSucc')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('updateSucc'))
            <div class="alert alert-success alert-dismissible fade show col-md-4 offset-md-8" role="alert">
                {{session('updateSucc')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('deleteSucc'))
            <div class="alert alert-danger alert-dismissible fade show col-md-4 offset-md-8" role="alert">
                {{session('deleteSucc')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="p-2 ">
            @if (count($lesson)==0)
                <h2 class="text-center py-2 text-primary">There is no lesson</h2>
            @endif
            @foreach ($lesson as $item)
                <a href="{{route('admin#viewLesson',$item->id)}}">
                    <div class="bag-white p-3 border border-black rounded shadow">
                        {{$item->name}}
                    </div>
                </a>
            @endforeach
            <div class="my-3">
                {{-- {{$lesson->appends(request()->query())->links()}} --}}
            </div>
        </div>
    </div>
@endsection
