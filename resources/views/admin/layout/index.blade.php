<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{asset('image/code-solid.svg')}}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <title>@yield('title')</title>
    <script src="https://kit.fontawesome.com/10de2103ef.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
    @yield('style')
</head>
<body class="bag-white">
    <div class="nav py-3 px-3 shadow sticky-top zindex">
        <div class="d-flex justify-content-between w-100">
            <div>
                <p class="fs-4"><i class="fa-solid fa-code pe-2 text-primary"></i><span id="title">Angle</span></p>
            </div>
            <div class="d-none d-lg-block menu-bar">
                <ul class=" d-flex justify-content-around gap-4">
                    <li class=""><a class="fs-5  active" href="{{route('admin#dashboardPage')}}"><i class="fa-solid fa-chart-simple pe-2"></i>Dashboard</a></li>
                    <li class=""><a class="fs-5 " href="{{route('admin#courseList')}}"><i class="fa-solid fa-list pe-2"></i>Course</a></li>
                    <li class=""><a class="fs-5 " href="{{route('admin#studentsList')}}"><i class="fa-solid fa-users pe-2"></i>Students List</a></li>
                    <li class=""><a class="fs-5 " href="{{route('admin#userList')}}"><i class="fa-solid fa-users pe-2"></i>User List</a></li>
                    <li class=""><a class="fs-5 " href="{{route('admin#list')}}"><i class="fa-solid fa-users pe-2"></i>Admin List</a></li>
                    <li class=""><a class="fs-5 " href="{{route('admin#getMessage')}}"><i class="fa-solid fa-list pe-2"></i>Message</a></li>
                    <a href="{{route('admin#getMessage')}}" class="message"></a>
                    <a href="{{route('admin#studentsList')}}" class="enrollStatus"></a>
                </ul>

            </div>
            <div class="d-flex gap-2">
                <div>
                    <div class="checkbox">
                        <label>
                          <input type="checkbox" data-toggle="toggle" id="darkmood" onchange="changemood()">
                          <i class="fa-solid fa-moon"></i>
                        </label>
                      </div>
                </div>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                      {{Auth::user()->name}}
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="{{route('admin#profile')}}">Profile</a></li>
                      <li><a class="dropdown-item" href="{{route('changePasswordPage')}}">Change Password</a></li>
                      <li>
                        <form action="{{route('logout')}}" method="post" class="dropdown-item">
                            @csrf
                            <input type="submit" value="Logout" class="btn btn-danger">
                        </form>
                      </li>
                    </ul>
                  </div>
                  <div class="menu-bar" id="menu-bar">
                    <i class="fa-solid fa-bars fs-3"></i>
                  </div>
            </div>

        </div>
    </div>
    <div class="content row container-fluid">
        <div>
            <div class="slide-bar shadow p-3 bag-white position-fixed right-0 zindex" id="slide-bar">
                <div class="w-100">
                    <ul class="w-100">
                        <li class="my-4"><a class="fs-5 my-4 active" href="{{route('admin#dashboardPage')}}"><i class="fa-solid fa-chart-simple pe-2"></i>Dashboard</a></li>
                        <li class="my-4"><a class="fs-5 my-4" href="{{route('admin#courseList')}}"><i class="fa-solid fa-list pe-2"></i>Course</a></li>
                        <li class="my-4"><a class="fs-5 my-4" href="{{route('admin#studentsList')}}"><i class="fa-solid fa-users pe-2"></i>Students List</a></li>
                        <li class="my-4"><a class="fs-5 my-4" href="{{route('admin#userList')}}"><i class="fa-solid fa-users pe-2"></i>User List</a></li>
                        <li class="my-4"><a class="fs-5 my-4" href="{{route('admin#list')}}"><i class="fa-solid fa-users pe-2"></i>Admin List</a></li>
                        <li class=""><a class="fs-5 " href="{{route('admin#getMessage')}}"><i class="fa-solid fa-list pe-2"></i>Message</a></li>
                        <li><a href="{{route('admin#getMessage')}}" class="message"></a></li>
                        <li><a href="{{route('admin#studentsList')}}" class="enrollStatus"></a></li>
                    </ul>
                </div>
                <div class="close-btn" id="close-btn">
                    <i class="fa-solid fa-xmark fs-5"></i>
                </div>
            </div>
        </div>


        <div class="main-content bag-white">
            @yield('content')
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){

            $('#menu-bar').click(function(){
                $('#menu-bar').hide();
                $('#slide-bar').show();
                $('#close-btn').show();

            });

            $('#close-btn').click(function(){
                $('#menu-bar').show();
                $('#slide-bar').hide();
                $('#close-btn').hide();

            });



        })
    </script>
    <script>

            let status;
            let body=document.getElementsByTagName('body');
            if (sessionStorage.getItem('status')) {
                status=sessionStorage.getItem('status');
                if (status=='light') {
                    body[0].classList.remove('dark-mode-variables');
                    document.getElementById('darkmood').checked=false;
                }else{
                    body[0].classList.add('dark-mode-variables');
                    document.getElementById('darkmood').checked=true;
                }
            }else{
                status='light';
                body[0].classList.remove('dark-mode-variables');
            }

            let changemood=function (){
                if (status=='light') {
                    body[0].classList.add('dark-mode-variables');
                    status='dark';
                }else{
                    body[0].classList.remove('dark-mode-variables');
                    status='light'
                }
                sessionStorage.setItem("status", status);
            }

    </script>
    <script>
            $(document).ready(function(){
                $.ajax({
                    type:'get',
                    url:"{{route('admin#getUserInterface')}}",
                    dataType:'json',
                    success:function(data){
                        $('#title').html(data.layout.title);
                        if(data.messageCount!=0){
                            $('.message').html(`
                                <button type="button" class="btn btn-secondary position-relative">
                                    <i class="fa-solid fa-bell"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        ${data.messageCount}
                                        <span class="visually-hidden">unread messages</span>
                                    </span>
                                </button>
                            `)
                        }
                        if (data.enrollStatus!=0) {
                            $('.enrollStatus').html(`
                                <button type="button" class="btn btn-secondary position-relative">
                                    <i class="fa-solid fa-list"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        ${data.enrollStatus}
                                        <span class="visually-hidden">unresponse enroll</span>
                                    </span>
                                </button>
                            `)
                        }
                    }
                })
            })
    </script>
    @yield('script')
</body>
</html>
