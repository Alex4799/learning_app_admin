@extends('admin.layout.index')

@section('title')
    View Payment Method
@endsection

@section('content')
    <div class="row py-3">
        <h1 class="py-2"><a href="{{route('admin#paymentList')}}">Payment Method</a> / View Payment Method</h1>
        <div class="col-md-8 offset-md-2 border border-black p-5">
            <h2 class="py-2 text-center">View Payment Method</h2>
            <hr>

            <div class="p-3 ">
                <div class="py-2">
                    <h4>Method - {{$payment->name}}</h4>
                </div>
                <div class="py-2">
                    <h4>Number - {{$payment->number}}</h4>
                </div>
                <div class="py-2">
                    <h4>User Name - {{$payment->user_name}}</h4>
                </div>
                <div class="d-flex justify-content-center">
                    <iframe width="560" height="315" src="{{$payment->video}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection
