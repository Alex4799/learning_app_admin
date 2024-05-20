@extends('admin.layout.index')

@section('title')
    Admin Dashboard
@endsection

@section('content')
<div class="container">
    <h1 class="py-3">Admin Dashboard</h1>
    <div class="row container-fluid">

        <a href="{{route('admin#studentsList')}}" class=" col-12 col-md-6 col-lg-4 p-3">
             <div class="row shadow bag-white rounded-4  py-3">
                <div class="col">
                    <div class="w-100 h-100 rounded-4 bg-skyblue d-flex justify-content-center align-items-center"><i class="fa-solid fa-user-graduate fs-1"></i></div>
                </div>
                <div class="col text-center">
                    <h5>{{$data['students']}}</h5>
                    <h6>Students</h6>
                </div>
             </div>
        </a>
        <a href="{{route('admin#userList')}}" class=" col-12 col-md-6 col-lg-4 p-3">
            <div class="row shadow bng-white rounded-4  py-3">
               <div class="col">
                   <div class="w-100 h-100 rounded-4 bg-warning d-flex justify-content-center align-items-center"><i class="fa-solid fa-users fs-1"></i></div>
               </div>
               <div class="col text-center">
                   <h5>{{$data['user']}}</h5>
                   <h6>Users</h6>
               </div>
            </div>
       </a>
       <a href="{{route('admin#courseList')}}" class=" col-12 col-md-6 col-lg-4 p-3">
            <div class="row shadow bng-white rounded-4  py-3">
                <div class="col">
                    <div class="w-100 h-100 rounded-4 bg-primary d-flex justify-content-center align-items-center"><i class="fa-solid fa-list fs-1"></i></div>
                </div>
                <div class="col text-center">
                    <h5>{{$data['course']}}</h5>
                    <h6>Courses</h6>
                </div>
            </div>
        </a>
        <a href="{{route('admin#list')}}" class=" col-12 col-md-6 col-lg-4 p-3">
            <div class="row shadow bng-white rounded-4  py-3">
                <div class="col">
                    <div class="w-100 h-100 rounded-4 bg-red d-flex justify-content-center align-items-center"><i class="fa-solid fa-users fs-1"></i></div>
                </div>
                <div class="col text-center">
                    <h5>{{$data['member']}}</h5>
                    <h6>Member</h6>
                </div>
            </div>
        </a>
        <div class=" col-12 col-md-6 col-lg-4 p-3">
            <div class="row shadow bng-white rounded-4  py-3">
                <div class="col">
                    <div class="w-100 h-100 rounded-4 bg-pink d-flex justify-content-center align-items-center"><i class="fa-solid fa-book fs-1"></i></div>
                </div>
                <div class="col text-center">
                    <h5>{{$data['lesson']}}</h5>
                    <h6>Lesson</h6>
                </div>
            </div>
        </div>
        <a href="{{route('admin#editUserInterface')}}" class=" col-12 col-md-6 col-lg-4 p-3">
            <div class="row shadow bng-white rounded-4  py-3">
                <div class="col">
                    <div class="w-100 h-100 rounded-4 bg-pink d-flex justify-content-center align-items-center"><i class="fa-solid fa-gear fs-1"></i></div>
                </div>
                <div class="col text-center">
                    <h5>Change</h5>
                    <h5>User Interface</h5>
                </div>
            </div>
        </a>
        <a href="{{route('admin#paymentList')}}" class=" col-12 col-md-6 col-lg-4 p-3">
            <div class="row shadow bng-white rounded-4  py-3">
                <div class="col">
                    <div class="w-100 h-100 rounded-4 bg-primary d-flex justify-content-center align-items-center"><i class="fa-solid fa-list fs-1"></i></div>
                </div>
                <div class="col text-center">
                    <h5>Payment Method</h5>
                </div>
            </div>
        </a>

    </div>
</div>
@endsection
