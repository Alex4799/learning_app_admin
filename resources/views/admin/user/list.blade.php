@extends('admin.layout.index')

@section('title')
    User List
@endsection

@section('content')
    <div>
        <h1 class="py-3">User List</h1>
        <div class="d-block d-lg-flex justify-content-around">
            <div class="py-2">
                <h4>Search Key - {{request('search_key')}}</h4>
            </div>
            <div class="py-2">
                <h4>Total - {{$user->total()}}</h4>
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
        <div class="d-flex  justify-content-end">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    @if (request('status')=='none')
                        Users
                    @elseif (request('status')=='students')
                        Students
                    @else
                        All
                    @endif
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{route('admin#userList')}}">All</a></li>
                  <li><a class="dropdown-item" href="{{route('admin#userList',['status'=>'none'])}}">User</a></li>
                  <li><a class="dropdown-item" href="{{route('admin#userList',['status'=>'students'])}}">Students</a></li>
                </ul>
            </div>
        </div>
        @if (session('updateSucc'))
            <div class="alert alert-success alert-dismissible fade show col-md-4 offset-md-8" role="alert">
                {{session('updateSucc')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="m-3 row">
            <table class="table table-dark table-striped text-center">
                <thead>
                  <tr class="row">
                    <th class="col-1"></th>
                    <th class="col">Name</th>
                    <th class="col">Email</th>
                    <th class="col">Status</th>
                    <th class="col">Role</th>
                  </tr>
                </thead>
                <tbody class="">
                  @foreach ($user as $item)
                      <tr class="row">
                        <td class="col-1">
                            <div>
                                @if ($item->image==null)
                                    @if ($item->gender=='male')
                                        <img src="{{asset('image/default-male-image.png')}}" class="w-100 img-thumbnail" alt="user image">
                                    @else
                                        <img src="{{asset('image/default-female-image.webp')}}" class="w-100 img-thumbnail" alt="user image">
                                    @endif
                                @else
                                    <img src="{{asset('storage/profile/'.$item->image)}}" class="w-100 img-thumbnail" alt="user image">
                                @endif
                            </div>
                        </td>
                        <td class="col"><a href="{{route('admin#userView',$item->id)}}" class="text-white">{{$item->name}}</a></td>
                        <td class="col">{{$item->email}}</td>
                        <td class="col">{{$item->status}}</td>
                        <td class="col">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{$item->role}}
                                </button>
                                <ul class="dropdown-menu">
                                  <li><a class="dropdown-item" href="{{route('admin#changeRole',[$item->id,'admin'])}}">admin</a></li>
                                  <li><a class="dropdown-item" href="{{route('admin#changeRole',[$item->id,'user'])}}">user</a></li>
                                </ul>
                            </div>
                        </td>
                      </tr>
                  @endforeach
                </tbody>
              </table>
            <div class="my-3">
                {{$user->appends(request()->query())->links()}}
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>

    </script>
@endsection
