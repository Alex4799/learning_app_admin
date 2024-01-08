<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body{
            background-image: linear-gradient(to right, #22c1c3 , #e579f3);
        }
        .button{
            width: 100%;
            height: 50px;
            padding: 5px;
            background-image: linear-gradient(to right, #22c1c3 , #e579f3);
            border: none;
            outline: none;
            color: white;
            font-weight: bolder;
            border-radius: 10px;
        }
    </style>

    <title>Angle</title>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center my-4">
        <div class="container-fluid row">
            <div class="col-lg-4 offset-lg-4 bg-white shadow p-3 rounded">
                <div class="p-4">
                    <form action="{{route('register')}}" method="post">
                        @csrf
                        <h2 class=" text-center">Welcome To Angle</h2>
                        <h2 class=" py-2 text-center">Register</h2>
                        <div class="py-2">
                            <label for="" class="py-2">Name</label>
                            <input type="text" class="form-control py-2" name="name">
                        </div>
                        <div class="py-2">
                            <label for="" class="py-2">Email</label>
                            <input type="email" class="form-control py-2" name="email">
                        </div>
                        <div class="py-2">
                            <label for="" class="py-2">Password</label>
                            <input type="password" class="form-control py-2" name="password">
                        </div>
                        <div class="py-2">
                            <label for="" class="py-2">Confirm Password</label>
                            <input type="password" class="form-control py-2" name="password_confirmation">
                        </div>
                        <div class="py-4">
                            <button class="button fs-4">Register</button>
                        </div>
                        <div class="py-1">
                            <a href="{{route('loginPage')}}">You already have an account? Login Here!</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
