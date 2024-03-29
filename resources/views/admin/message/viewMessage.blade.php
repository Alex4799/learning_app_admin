@extends('admin.layout.index')

@section('title')
    View Message
@endsection

@section('content')
    <div>
        <div>
            <h3 class="py-3"><a href="{{route('admin#getMessage')}}">Message List / </a>View Message</h3>
            <div class="row container-fluid">
                <div class="col-md-8 offset-md-2 border border-primary rounded p-3">
                    <div class="">
                        <p class="">name - {{$message->user_name}}</p>
                    </div>
                    <div class="">
                        <p class="">email - {{$message->user_email}}</p>
                    </div>
                    <div class="">
                        <h6>Message</h6>
                        <p class="">{{$message->message}}</p>
                    </div>
                    <div class=" d-flex justify-content-end">
                        <button class="btn btn-primary" id="reply">Reply</button>
                    </div>
                </div>
            </div>
            <div class="d-none" id="reply_box">
                <div class="row container-fluid">
                    <form action="{{route('admin#sendMessage')}}" method="post" class="col-md-8 offset-md-2 border border-primary rounded p-3">
                        @csrf
                        <input type="hidden" name="reply_id" value="{{$message->id}}">
                        <input type="hidden" name="get_id" value="{{$message->send_id}}">

                        <div class="py-2">
                            <textarea name="message" class="form-control bag-white" cols="30" rows="2"></textarea>
                        </div>
                        <div class="py-2 d-flex justify-content-end">
                            <button class="btn btn-primary" id="send">Send</button>
                        </div>
                    </form>
                </div>
            </div>
            @if (count($replyMessage)!=0)
                @foreach ($replyMessage as $item)
                    <div class="row container-fluid">
                        <div class="col-md-8 offset-md-2 border border-primary rounded p-3">
                            <div class="">
                                <p class="">name - {{$item->user_name}}</p>
                            </div>
                            <div class="">
                                <p class="">email - {{$item->user_email}}</p>
                            </div>
                            <div class="">
                                <h6>Message</h6>
                                <p class="">{{$item->message}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){

            $('#reply').click(function(){
                $('#reply_box').toggleClass('d-none')
            });

        })
    </script>
@endsection
