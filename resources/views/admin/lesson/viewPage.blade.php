@extends('admin.layout.index')

@section('title')
    View Lesson
@endsection

@section('content')
    <div class="row py-3">
        <div class="">
            <h1 class="py-2"><a href="{{route('admin#viewCourseCategory',$lesson->course_category_id)}}">Lesson List</a> / View Lesson</h1>
            <div class="row">

                @if (session('updateSucc'))
                    <div class="alert alert-success alert-dismissible fade show col-md-4 offset-md-8" role="alert">
                        {{session('updateSucc')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="col-md-8 offset-md-2 p-3 border border-black shadow rounded">
                    <h3>{{$lesson->name}}</h3>
                    <p class="p-3">{{$lesson->description}}</p>
                    @if ($lesson->vd_link != null)
                        <div class="d-flex justify-content-center">
                            <iframe width="560" height="315" src="{{$lesson->vd_link}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        </div>
                    @endif
                    <div class="py-3 float-end">
                        <a href="{{route('admin#editLesson',$lesson->id)}}" class="btn btn-secondary"><i class="fa-solid fa-pen-to-square me-2"></i>Edit</a>
                        <a href="{{route('admin#deleteLesson',$lesson->id)}}" class="btn btn-danger"><i class="fa-solid fa-trash me-2"></i>Delete</a>
                    </div>
                </div>
            </div>
            <div class="row py-3">
                <div class="col-md-8 offset-md-2 p-3 border border-black shadow rounded">
                    <h3>Comment</h3>
                    <form action="{{route('admin#sendComment')}}" class="p-3 border border-black shadow rounded" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row gap-2 p-3">
                            <input type="hidden" name="lesson_id" value="{{$lesson->id}}">
                            <input type="hidden" name="reply_id">
                            <div class="py-2 col-sm">
                                <input type="text" name="content" class=" form-control" placeholder="Enter your comment"/>
                            </div>
                            <div class="py-2 col-sm">
                                <input name="image" type="file" class=" form-control"/>
                            </div>
                            <div class="py-2 d-flex justify-content-end">
                                <button class="btn btn-primary">Send</button>
                            </div>
                        </div>
                    </form>
                    <div>
                        @foreach ($comment as $item)
                            @if ($item->reply_id==null)
                                <div class="py-2">
                                    <div class="p-3 border border-black shadow rounded" id="parents">
                                        <h5>{{$item->user_name}}</h5>
                                        <p>{{$item->content}}</p>
                                        @if ($item->image!=null)
                                            <div class="d-flex justify-content-end py-2">
                                                <span class="seeMore">See More &gt;&gt;&gt;</span>
                                            </div>
                                        @endif
                                        @if ($item->image!=null)
                                            <div class="d-none" id="comment_image">
                                                <img src={{asset('storage/commentImage/'.$item->image)}} class="w-25 img-thumbnail rounded" alt="" />
                                            </div>
                                        @endif
                                        <div class="d-flex justify-content-end gap-2 py-2">

                                            <button class="btn btn-primary reply">Reply</button>

                                            @if ($item->user_id==Auth::user()->id)
                                            <a href="{{route('admin#deleteComment',[$item->id,$lesson->id])}}" class="btn btn-danger" >Delete</a>
                                            @endif
                                        </div>
                                        <div class="d-none" id="reply_box">
                                            <form action="{{route('admin#sendComment')}}" class="p-3 border border-black shadow rounded" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row gap-2 p-3">
                                                    <input type="hidden" name="lesson_id" value="{{$lesson->id}}">
                                                    <input type="hidden" name="reply_id" value="{{$item->id}}">
                                                    <div class="py-2 col-sm">
                                                        <input type="text" name="content" class=" form-control" placeholder="Enter your comment"/>
                                                    </div>
                                                    <div class="py-2 col-sm">
                                                        <input name="image" type="file" class=" form-control"/>
                                                    </div>
                                                    <div class="py-2 d-flex justify-content-end">
                                                        <button class="btn btn-primary">Send</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        @foreach ($comment as $reply_comment)
                                            @if ($reply_comment->reply_id == $item->id)
                                                <div class="p-3 border border-black shadow rounded" id="parents_reply">
                                                    <h5>{{$reply_comment->user_name}}</h5>
                                                    <p>{{$reply_comment->content}}</p>
                                                    @if ($reply_comment->image!=null)
                                                        <div class="d-flex justify-content-end py-2">
                                                            <span class="seeMore_reply">See More &gt;&gt;&gt;</span>
                                                        </div>
                                                    @endif
                                                    @if ($reply_comment->image!=null)
                                                        <div class="d-none" id="comment_image">
                                                            <img src={{asset('storage/commentImage/'.$item->image)}} class="w-25 img-thumbnail rounded" alt="" />
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach

                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){

            $('.seeMore').click(function(){
                $parentsNode=$(this).parents('#parents');
                $parentsNode.find('#comment_image').toggleClass('d-none');
            });

            $('.seeMore_reply').click(function(){
                $parentsNode=$(this).parents('#parents_reply');
                $parentsNode.find('#comment_image').toggleClass('d-none');
            });

            $('.reply').click(function(){
                $parentsNode=$(this).parents('#parents');
                $parentsNode.find('#reply_box').toggleClass('d-none');
            });

        })
    </script>
@endsection
