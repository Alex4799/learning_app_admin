@extends('admin.layout.index')

@section('title')
    Change Password
@endsection

@section('content')
<div class="">
    <h1 class="py-3"><a href="{{route('admin#profile')}}">Profile</a> / Change Password</h1>
    <div class="row">
        <div class="col-md-8 offset-md-2 py-5 px-5 shadow rounded">
            <div class="py-2">
                <label for="">Current Password</label>
                <input type="password" name="current_password" id="" class=" form-control">
            </div>
            <div class="py-2">
                <label for="">New Password</label>
                <input type="password" name="new_password" id="" class=" form-control">
            </div>
            <div class="py-2">
                <label for="">Confirm New Password</label>
                <input type="password" name="confirm_new_password" id="" class=" form-control">
            </div>
            <div class="py-2">
                <div class="d-flex gap-2"><input type="checkbox" name="" id="showPassword" class=" form-check pe-2">Show Password</div>
                <input type="submit" value="Change" class="btn btn-warning float-end">
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>

    </script>
@endsection
