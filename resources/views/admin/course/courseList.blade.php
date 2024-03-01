@extends('admin.layout.index')

@section('title')
    Course List
@endsection

@section('content')
    <div>
        <h1 class="py-3">Course List</h1>
        <div class="d-flex justify-content-end py-3">
            <a href="{{route('admin#addCoursePage')}}" class="btn btn-primary"><i class="fa-solid fa-plus me-2"></i>Add Course</a>
        </div>
        <div class="d-block d-lg-flex justify-content-around">
            <div class="py-2">
                <h4>Search Key - {{request('search_key')}}</h4>
            </div>
            <div class="py-2">
                <h4>Total - {{$courses->total()}}</h4>
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
        <div class="py-2 row">
            @foreach ($courses as $item)
                <div class="col-md-3 py-2">
                    <div class=" bag-white shadow rounded p-2">
                        <div class="p-2 img-container">
                            @if ($item->image==null)
                                <img src="{{asset('image/default.jpg')}}" class="w-100 img-thumbnail" alt="course image">
                            @else
                                <img src="{{asset('storage/courseImage/'.$item->image)}}" class="w-100 img-thumbnail" alt="course image">
                            @endif
                        </div>
                        <div class="card-body">
                          <h5 class="card-title py-2">{{$item->name}}</h5>
                          <button class="btn btn-secondary py-2">Course Fee - {{$item->course_fee}} MMK</button>
                          <p class="card-text py-2">{!! Str::limit($item->description, 100)!!}</p>
                          <div class="d-flex justify-content-end p-2">
                            <a href="{{route('admin#viewCourse',$item->id)}}" class="btn btn-secondary"><i class="fa-solid fa-eye"></i></a>
                          </div>
                        </div>
                      </div>
                </div>
            @endforeach
            <div class="my-3">
                {{$courses->appends(request()->query())->links()}}
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>

    </script>
@endsection
