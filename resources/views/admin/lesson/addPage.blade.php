@extends('admin.layout.index')

@section('title')
    Add Lesson
@endsection

@section('content')
    <div class="row py-3">
        <h1 class="py-2"><a href="{{route('admin#viewCourseCategory',$id)}}">Lesson List</a> / Add Lesson</h1>
        <div class="col-md-6 offset-md-3 border border-black p-5">
            <h2 class="py-2 text-center">Add Lesson</h2>
            <hr>
            <form action="{{route('admin#addLesson')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="">
                        <div class="py-2">
                            <label for="" class="py-2">Lesson Name</label>
                            <input type="text" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" name="name">
                            @error('name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="py-2">
                            <label for="" class="py-2">Description</label>
                            <textarea name="description" id="editor" cols="30" rows="10" class="form-control @error('description') is-invalid @enderror">{{old('description')}}</textarea>
                            @error('description')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="py-2">
                            <label for="" class="py-2">Video Link</label>
                            <input type="text"  value="{{old('vd_link')}}" class="form-control @error('vd_link') is-invalid @enderror" name="vd_link">
                            @error('vd_link')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <input type="hidden" name="course_id" value="{{$courseCategory->course_id}}">
                        <input type="hidden" name="course_category_id" value="{{$courseCategory->id}}">

                        <div class="py-2 d-flex justify-content-end">
                            <input type="submit" value="Create" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        CKEDITOR.replace('editor');
    </script>
@endsection
