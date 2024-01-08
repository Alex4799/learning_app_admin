@extends('admin.layout.index')

@section('title')
    Add Lesson
@endsection

@section('style')
    <style>
        .coursecategory{
            display: none;
        }

        #closeChange{
            display: none;
        }
    </style>
@endsection
@section('content')
    <div class="row py-3">
        <h1 class="py-2"><a href="{{route('admin#viewCourseCategory',$lesson->course_category_id)}}">Lesson List</a> / Edit Lesson</h1>
        <div class="col-md-6 offset-md-3 border border-black p-5">
            <h2 class="py-2 text-center">Edit Lesson</h2>
            <hr>
            <form action="{{route('admin#updateLesson')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="">
                        <div class="py-2">
                            <label for="" class="py-2">Lesson Name</label>
                            <input type="text" value="{{old('name',$lesson->name)}}" class="form-control @error('name') is-invalid @enderror" name="name">
                            @error('name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="py-2">
                            <label for="" class="py-2">Description</label>
                            <textarea name="description" id="" cols="30" rows="10" class="form-control @error('description') is-invalid @enderror">{{old('description',$lesson->description)}}</textarea>
                            @error('description')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="py-2">
                            <label for="" class="py-2">Video Link</label>
                            <input type="text"  value="{{old('vd_link',$lesson->vd_link)}}" class="form-control @error('vd_link') is-invalid @enderror" name="vd_link">
                            @error('vd_link')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class='coursecategory' id="coursecategory">
                            <div class="py-2">
                                <label for="" class="py-2">Course</label>
                                <select name="course_id" class="form-control" id="course">
                                    @foreach ($course as $courseItem)
                                        <option class="text-dark" value="{{$courseItem->id}}" @if ($courseItem->id==$lesson->course_id) selected @endif>{{$courseItem->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="py-2">
                                <label for="" class="py-2">Course Category</label>
                                <select name="course_category_id" class="form-control" id="courseCategory">
                                    @foreach ($courseCategory as $courseCategoryItem)
                                        <option class="text-dark" value="{{$courseCategoryItem->id}}" @if ($courseCategoryItem->id==$lesson->course_id) selected @endif>{{$courseCategoryItem->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <input type="hidden" name="id" value="{{$lesson->id}}">

                        <div class="py-2 d-flex justify-content-around">
                            <button class="btn btn-secondary" type="button" id="changeCourse">Change Course</button>
                            <button class="btn btn-secondary" type="button" id="closeChange">Close Change</button>
                            <input type="submit" value="Update" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('#changeCourse').click(function(){
                $('#coursecategory').show();
                $('#closeChange').show();
                $('#changeCourse').hide();
                $.ajax({
                    url:`http://127.0.0.1:8000/admin/ajax/course`,
                    success:function(resoponse){
                        let data;
                        resoponse.forEach(element => {
                            data+=`<option class="text-dark" value="${element.id}">${element.name}</option>`
                        });
                        $('#course').html(data);
                    }
                })
            });

            $('#closeChange').click(function(){
                $('#coursecategory').hide();
                $('#closeChange').hide();
                $('#changeCourse').show();
                $('#course').html('<option class="text-dark" value="{{$lesson->course_category_id}}">Course</option>');
                $('#courseCategory').html('<option class="text-dark" value="{{$lesson->course_category_id}}">Course Category</option>');
            })

            $('#course').change(function(){
                $.ajax({
                    url:`http://127.0.0.1:8000/admin/ajax/courseCategory/${this.value}`,
                    success:function(resoponse){
                        let data;
                        resoponse.forEach(element => {
                            data+=`<option class="text-dark" value="${element.id}">${element.name}</option>`
                        });
                        $('#courseCategory').html(data);
                    }
                })
            })
        })
    </script>
@endsection
