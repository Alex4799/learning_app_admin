@extends('admin.layout.index')

@section('title')
    Students List
@endsection

@section('content')
    <div>
        <h1 class="py-3"><a href="{{route('admin#studentsList')}}">Students List</a> / {{$course->name}}</h1>
        <h3 class="text-center py-3">{{$course->name}}</h3>

        <div class="d-block d-lg-flex justify-content-around">
            <div class="py-2">
                <h4>Search Key - {{request('search_key')}}</h4>
            </div>
            <div class="py-2">
                <h4>Total - {{$students->total()}}</h4>
            </div>
            <div class="py-2">
                <form action="#" method="get">
                    <div class="d-flex gap-1">
                        <input type="text" name="search_key" value='{{request('search_key')}}' class=" form-control">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>

            </div>
        </div>
        @if (session('updateSucc'))
            <div class="alert alert-success alert-dismissible fade show col-md-4 offset-md-8" role="alert">
                {{session('updateSucc')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('deleteSucc'))
            <div class="alert alert-success alert-dismissible fade show col-md-4 offset-md-8" role="alert">
                {{session('deleteSucc')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('WrongPassword'))
            <div class="alert alert-danger alert-dismissible fade show col-md-4 offset-md-8" role="alert">
                {{session('WrongPassword')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="m-3 row" id="list">
            <table class="table table-dark table-striped text-center">
                <thead>
                  <tr class="row">
                    <th class="col-1"></th>
                    <th class="col">Name</th>
                    <th class="col">Done Lesson</th>
                    <th class="col">Fee Status</th>
                    <th class="col"></th>
                  </tr>
                </thead>
                <tbody class="">
                  @foreach ($students as $item)
                      <tr class="row tr">
                        <td class="col-1">
                            <div>
                                @if ($item->user_image==null)
                                    <img src="{{asset('image/default-male-image.png')}}" class="w-100 img-thumbnail" alt="course image">
                                @else
                                    <img src="{{asset('storage/profile/'.$item->user_image)}}" class="w-100 img-thumbnail" alt="course image">
                                @endif
                            </div>
                        </td>
                        <td class="col">{{$item->user_name}}</td>
                        <td class="col">{{$item->done_lesson}}</td>
                        <td class="col">
                            <div class="dropdown">
                                <button class="text-center btn @if ($item->fee_status=='pending') btn-warning @elseif ($item->fee_status=='100') btn-success @else btn-secondary @endif dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    @if ($item->fee_status=='pending')
                                        Pending
                                    @elseif ($item->fee_status=='25')
                                        25%
                                    @elseif ($item->fee_status=='50')
                                        50%
                                    @elseif ($item->fee_status=='75')
                                        75%
                                    @else
                                        Complete
                                    @endif
                                </button>
                                <ul class="dropdown-menu text-center">
                                    <li><a class="dropdown-item" href="{{route('admin#changeStatus',[$item->id,'pending'])}}">Pending</a></li>
                                    <li><a class="dropdown-item" href="{{route('admin#changeStatus',[$item->id,'25'])}}">25%</a></li>
                                    <li><a class="dropdown-item" href="{{route('admin#changeStatus',[$item->id,'50'])}}">50%</a></li>
                                    <li><a class="dropdown-item" href="{{route('admin#changeStatus',[$item->id,'75'])}}">75%</a></li>
                                    <li><a class="dropdown-item" href="{{route('admin#changeStatus',[$item->id,'100'])}}">Complete</a></li>
                                </ul>
                            </div>
                        </td>
                        <td class="col">
                            <input type="hidden" value="{{$item->id}}" id="item_id">
                            <div class=" d-flex gap-1">
                                <a href="{{route('admin#studentsViewProfile',$item->user_id)}}" class="btn btn-secondary"><i class="fa-solid fa-eye"></i></a>
                                <a href="{{route('admin#viewEnroll',$item->id)}}" class="btn @if ($item->status==0) btn-primary @else btn-secondary @endif"><i class="fa-solid fa-clipboard-list"></i></a>
                                <button class="btn btn-danger show"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </td>

                        <div class=" p-3 shadow rounded d-none alert {{'alert'.$item->id}}">
                            <div class=" position-relative ">
                                <form action="{{route('admin#deleteStudent')}}" method="POST">
                                    @csrf

                                    <h3 class="py-3">Are you sure to delete {{$item->user_name}} from {{$course->name}} ?</h3>
                                    <h3 class="py-3">Enter Your Password</h3>
                                    <input type="hidden" name="id" value="{{$item->id}}">
                                    <input type="hidden" name="course_id" value="{{$course->id}}">

                                    <div class=" py-3">
                                        <input type="password" name="password" class="form-control">
                                    </div>

                                    <div class=" py-3 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>

                                </form>
                                <div class=" position-absolute top-0 end-0 close">
                                    <i class="fa-solid fa-xmark fs-5"></i>
                                </div>
                            </div>
                        </div>

                    </tr>

                  @endforeach
                </tbody>
              </table>

            <div class="my-3">
                {{$students->appends(request()->query())->links()}}
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
    $(document).ready(function(){

        $('.show').click(function(){
            $item_id=$(this).parents('tr').find('#item_id').val();
            $('.alert'+$item_id).removeClass('d-none');
        });

        $('.close').click(function(){
            $('.alert').addClass('d-none');
        });

    })
</script>
@endsection
