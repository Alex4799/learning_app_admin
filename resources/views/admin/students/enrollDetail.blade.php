@extends('admin.layout.index')

@section('title')
    Enroll Detail
@endsection

@section('content')
<div class="container">
    <h1 class="py-3"><a href="{{route('admin#studentsList')}}">Students List</a> / <a href="{{route('admin#studentsViewCourse',$CourseDetail->course_id)}}">{{$CourseDetail->course_name}}</a> / Detail</h1>
    <div class="">

        <div class=" shadow rounded py-4">
            <div class="row container-fluid">
                <div class="offset-md-2 col-md-6 py-4">
                    <h4 class="py-2"><i class="fa-solid fa-file-signature me-2"></i>Name - {{$CourseDetail->user_name}}</h4>
                    <h4 class="py-2"><i class="fa-solid fa-file-signature me-2"></i>Course - {{$CourseDetail->course_name}}</h4>

                    <div class="dropdown py-2">
                        <button class="text-center btn @if ($CourseDetail->fee_status=='pending') btn-warning @elseif ($CourseDetail->fee_status=='100%') btn-success @else btn-secondary @endif dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @if ($CourseDetail->fee_status=='pending')
                                Pending
                            @elseif ($CourseDetail->fee_status=='25')
                                25%
                            @elseif ($CourseDetail->fee_status=='50')
                                50%
                            @elseif ($CourseDetail->fee_status=='75')
                                75%
                            @else
                                Complete
                            @endif
                        </button>
                        <ul class="dropdown-menu text-center">
                            <li><a class="dropdown-item" href="{{route('admin#changeStatus',[$CourseDetail->id,'pending'])}}">Pending</a></li>
                            <li><a class="dropdown-item" href="{{route('admin#changeStatus',[$CourseDetail->id,'25'])}}">25%</a></li>
                            <li><a class="dropdown-item" href="{{route('admin#changeStatus',[$CourseDetail->id,'50'])}}">50%</a></li>
                            <li><a class="dropdown-item" href="{{route('admin#changeStatus',[$CourseDetail->id,'75'])}}">75%</a></li>
                            <li><a class="dropdown-item" href="{{route('admin#changeStatus',[$CourseDetail->id,'100'])}}">Complete</a></li>
                        </ul>
                    </div>

                    <div class="py-2">
                        <h4>25% transation Screenshort</h4>
                        <div class="w-50">
                            @if ($CourseDetail->image25 != null)
                                <img class=" img-thumbnail shadow rounded w-100" src="{{asset('storage/transationImage/'.$CourseDetail->image25)}}" alt="Transation Screenshort">
                            @else
                            <img class=" img-thumbnail shadow rounded w-100" src="{{asset('image/default.jpg')}}" alt="Transation Screenshort">
                            @endif
                        </div>
                    </div>
                    <div class="py-2">
                        <h4>50% transation Screenshort</h4>
                        <div class="w-50">
                            @if ($CourseDetail->image50 != null)
                                <img class=" img-thumbnail shadow rounded w-100" src="{{asset('storage/transationImage/'.$CourseDetail->image50)}}" alt="Transation Screenshort">
                            @else
                            <img class=" img-thumbnail shadow rounded w-100" src="{{asset('image/default.jpg')}}" alt="Transation Screenshort">
                            @endif
                        </div>
                    </div>
                    <div class="py-2">
                        <h4>75% transation Screenshort</h4>
                        <div class="w-50">
                            @if ($CourseDetail->image75 != null)
                                <img class=" img-thumbnail shadow rounded w-100" src="{{asset('storage/transationImage/'.$CourseDetail->image75)}}" alt="Transation Screenshort">
                            @else
                            <img class=" img-thumbnail shadow rounded w-100" src="{{asset('image/default.jpg')}}" alt="Transation Screenshort">
                            @endif
                        </div>
                    </div>
                    <div class="py-2">
                        <h4>100% transation Screenshort</h4>
                        <div class="w-50">
                            @if ($CourseDetail->image100 != null)
                                <img class=" img-thumbnail shadow rounded w-100" src="{{asset('storage/transationImage/'.$CourseDetail->image100)}}" alt="Transation Screenshort">
                            @else
                            <img class=" img-thumbnail shadow rounded w-100" src="{{asset('image/default.jpg')}}" alt="Transation Screenshort">
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
