@extends('admin.layout.index')

@section('title')
    Edit User Interface
@endsection

@section('content')
    <div>
        <div class="row py-3">

            <div class="col-md-6 offset-md-3 shadow border border-secondary p-3 rounded">
                <div>
                    <h3>Edit User Interface</h3>
                    <hr>
                </div>
                <div>
                    <form action="{{route('admin#updateUserInterface')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if (session('UpdateSucc'))
                            <div class="alert alert-success alert-dismissible fade show col-lg-4 offset-lg-8" role="alert">
                                {{session('UpdateSucc')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="py-2">
                            <h6>Title</h6>
                            <div class="py-2">
                                <input type="text" name="title" class=" form-control" value="{{$data->title}}">
                            </div>
                        </div>

                        <div class="py-2">
                            <h6>Category</h6>
                            <div class="py-2">
                                <input type="text" name="category" class=" form-control" value="{{$data->category}}">
                            </div>
                        </div>

                        <div class="py-2">
                            <h6>Address</h6>
                            <div class="py-2">
                                <input type="text" name="address" class=" form-control" value="{{$data->address}}">
                            </div>
                        </div>

                        <div class="py-2">
                            <h6>Phone</h6>
                            <div class="py-2">
                                <input type="text" name="phone" class=" form-control" value="{{$data->phone}}">
                            </div>
                        </div>

                        <div class="py-2">
                            <h6>Email</h6>
                            <div class="py-2">
                                <input type="text" name="email" class=" form-control" value="{{$data->email}}">
                            </div>
                        </div>

                        <div class="py-2">
                            <h6>Map( only src )</h6>
                            <div class="py-2">
                                <input type="text" name="map" class=" form-control" value="{{$data->map}}">
                            </div>
                            <div class="py-2">
                                <iframe className="w-100" src="{{$data->map}}" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>

                        <div class="py-2">
                            <h6>Logo</h6>
                            <div class="row">
                                <div class="py-1 col-md-6">
                                    @if ($data->logo==null)
                                        <img src="{{asset('image/ANGLE_logo.png')}}" alt="" class="w-100 img-thumbnail">
                                    @else
                                        <img src="{{asset('storage/interface/'.$data->logo)}}" alt="" class="w-100 img-thumbnail">
                                    @endif
                                </div>
                                <div class="col-md-6 m-auto">
                                    <input type="file" name="logo_image" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="py-2">
                            <h6>Cover Image</h6>
                            <div class="row">
                                <div class="py-1 col-md-6">
                                    @if ($data->coverimage==null)
                                        <img src="{{asset('image/cover.webp')}}" alt="" class="w-100 img-thumbnail">
                                    @else
                                        <img src="{{asset('storage/interface/'.$data->coverimage)}}" alt="" class="w-100 img-thumbnail">
                                    @endif
                                </div>
                                <div class="col-md-6 m-auto">
                                    <input type="file" name="cover_image" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="py-2">
                            <h6>Font Color</h6>
                            <div class="row">
                                <div class="py-1 col-md-6">
                                    @if ($data->font_color==null)
                                        <div style="width: 200px;height:200px;" class="bg-dark border border-black rounded"></div>
                                    @else
                                        <div style="width: 200px;height:200px;background-color:{{$data->font_color}}" class=" border border-black rounded"></div>
                                    @endif

                                </div>
                                <div class="col-md-6 m-auto">
                                    <div class="d-flex">
                                        @if ($data->font_color==null)
                                            <input type="color" value="#000000" name="font_color" class="form-control-color">
                                        @else
                                            <input type="color" value="{{$data->font_color}}" name="font_color" class="form-control-color">
                                        @endif

                                        <p class="p-2">Choose Color</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="py-2">
                            <h6>Background Color</h6>
                            <div class="row">
                                <div class="py-1 col-md-6">
                                    @if ($data->background_color==null)
                                        <div style="width: 200px;height:200px;" class="bg-white border border-black rounded"></div>
                                    @else
                                        <div style="width: 200px;height:200px;background-color:{{$data->background_color}}" class="border border-black rounded"></div>
                                    @endif
                                </div>
                                <div class="col-md-6 m-auto">
                                    <div class="d-flex">
                                        @if ($data->background_color==null)
                                            <input type="color" value="#ffffff" name="background_color" class="form-control-color">
                                        @else
                                            <input type="color" value="{{$data->background_color}}" name="background_color" class="form-control-color">
                                        @endif
                                        <p class="p-2">Choose Color</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-1">
                            <a href="{{route('admin#defaultUserInterface')}}" class="btn btn-primary">Change Default</a>
                            <button class="btn btn-primary"><i class="fa-solid fa-pen-to-square me-2"></i>Update</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
