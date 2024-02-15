@extends('admin.layout.index')

@section('title')
    Message List
@endsection

@section('content')
    <div class="bag-white">
        <h3 class="text-center py-3">Message List</h3>

        <div class="d-block d-lg-flex justify-content-around">
            <div class="py-2">
                <h4>Search Key - {{request('search_key')}}</h4>
            </div>
            <div class="py-2">
                <h4>Total - {{$message->total()}}</h4>
            </div>
        </div>
        @if (session('sendSucc'))
            <div class="alert alert-success alert-dismissible fade show col-md-4 offset-md-8" role="alert">
                {{session('sendSucc')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="m-3 row">
            <table class=" text-center">
                <thead>
                  <tr class="row py-2">
                    <th class="col">ID</th>
                    <th class="col">Name</th>
                    <th class="col"></th>
                  </tr>
                </thead>
                <tbody class="">
                  @foreach ($message as $item)
                      <tr class="row border border-primary py-2 @if ($item->status==0) bg-secondary @else bag-white @endif">
                        <td class="col">{{$item->id}}</td>
                        <td class="col"><a href="#">{{$item->user_name}}</a></td>
                        <td class="col"><a href="{{route('admin#viewMessage',$item->id)}}" class="btn btn-secondary"><i class="fa-solid fa-eye"></i></a></td>
                      </tr>
                  @endforeach
                </tbody>
              </table>
            <div class="my-3">
                {{$message->appends(request()->query())->links()}}
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>

    </script>
@endsection
