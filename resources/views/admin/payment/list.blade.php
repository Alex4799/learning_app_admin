@extends('admin.layout.index')

@section('title')
    Payment Method List
@endsection

@section('content')
    <div>
        <h1 class="py-3">Payment Method List</h1>
        <div class="d-flex justify-content-end py-3">
            <a href="{{route('admin#paymentAddPage')}}" class="btn btn-primary"><i class="fa-solid fa-plus me-2"></i>Add Payment Method</a>
        </div>
        <div class="d-block d-lg-flex justify-content-around">
            <div class="py-2">
                <h4>Total - {{$payment->total()}}</h4>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show col-md-4 offset-md-8" role="alert">
                {{session('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('danger'))
            <div class="alert alert-danger alert-dismissible fade show col-md-4 offset-md-8" role="alert">
                {{session('danger')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="py-2 row">
            @foreach ($payment as $item)
                <div class="col-md-3 py-2">
                    <div class=" bag-white shadow rounded p-2">
                        <div class="py-2">
                            <h5>Method - {{$item->name}}</h5>
                        </div>
                        <div class="py-2">
                            <h5>Number - {{$item->number}}</h5>
                        </div>
                        <div class="py-2">
                            <h5>User Name - {{$item->user_name}}</h5>
                        </div>
                        <div class="py-2 d-flex justify-content-around">
                            <a href="{{route('admin#paymentView',$item->id)}}" class="btn btn-secondary"><i class="fa-solid fa-eye"></i></a>
                            <a href="{{route('admin#paymentEdit',$item->id)}}" class="btn btn-secondary"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="{{route('admin#paymentDelete',$item->id)}}" class="btn btn-secondary"><i class="fa-solid fa-trash"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="my-3">
                {{$payment->appends(request()->query())->links()}}
            </div>
        </div>
    </div>
@endsection
