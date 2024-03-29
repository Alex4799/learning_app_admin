@extends('admin.layout.index')

@section('title')
    Student Profile
@endsection

@section('content')
<div class="container">
    <h1 class="py-3"><a href="{{route('admin#studentsList')}}">Students List</a> / Profile</h1>
    <div class="">

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

        <div class=" shadow rounded py-4">
            <div class="row container-fluid">
                <div class="col-md-3 offset-md-1 py-4" >
                    @if ($user->image==null)
                        @if ($user->gender=='male')
                            <img src="{{asset('image/default-male-image.png')}}" alt="Male Default Profile Image" class="w-100 rounded img-thumbnail">
                        @else
                            <img src="{{asset('image/default-female-image.webp')}}" alt="Female Default Profile Image" class="w-100 rounded img-thumbnail">
                        @endif
                    @else
                        <img src="{{asset('storage/profile/'.$user->image)}}" alt="User Profile" class="w-100 rounded img-thumbnail">
                    @endif
                </div>
                <div class="offset-md-2 col-md-6 py-4">
                    <h4 class="py-2"><i class="fa-solid fa-file-signature me-2"></i>Name - {{$user->name}}</h4>
                    <h4 class="py-2"><i class="fa-solid fa-envelope me-2"></i>Email - {{$user->email}}</h4>
                    <h4 class="py-2"><i class="fa-solid fa-phone me-2"></i>Phone - {{$user->phone}}</h4>
                    <h4 class="py-2"><i class="fa-solid fa-venus-mars me-2"></i>Gender - {{$user->gender}}</h4>
                    <div>
                        <h4 class="py-2">Courses</h4>
                        <div>
                            @foreach ($courses as $course)
                                <div class="d-flex justify-content-around bg-secondary p-2 my-2 rounded">
                                    <h5 class="pt-1">{{$course->course_name}}</h5>
                                    @if ($course->done_lesson==0)
                                        <div class="btn btn-primary">0%</div>
                                    @else
                                        <div class="btn btn-primary">{{($course->done_lesson/$course->lesson_count)*100}}%</div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
