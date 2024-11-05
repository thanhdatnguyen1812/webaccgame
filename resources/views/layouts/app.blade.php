<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <style>
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
            white-space: nowrap; /* Đảm bảo nội dung không xuống dòng */
        }

        .table th, .table td {
            width: auto;
        }

        .table img {
            max-width: 100px;
            height: auto;
        }

        .table .action-buttons {
            white-space: nowrap; /* Đảm bảo các nút không xuống dòng */
        }

        .btn-group .btn {
            margin-right: 5px;
        }

        .container {
            max-width: 100%;
        }

        .card {
            width: 100%;
        }
        .table-responsive {
            overflow-x: auto;
        }

        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
        }

        .table img {
            max-width: 100px;
            height: auto;
        }
        .table-responsive {
            overflow-x: auto;
            width: 100%;
        }

        .table th, .table td {
            white-space: nowrap;
            max-width: 10px; /* Thiết lập chiều rộng tối đa */
            overflow: hidden;
            text-overflow: ellipsis; /* Hiển thị dấu chấm lửng nếu nội dung bị cắt */
        }

        .table th {
            min-width: 100px; /* Thiết lập chiều rộng tối thiểu */
        }

    </style>



    <!-- Bootstrap CSS CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="    //cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('navbar')
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="{{ asset('frontend/js/jquery-3.7.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script type="text/javascript">
        let table = new DataTable('#myTable');
    </script>
    <script type="text/javascript">
        function ChangeToSlug() {
            var slug = document.getElementById("slug").value.toLowerCase();

            // Đổi ký tự có dấu thành không dấu
            var accents = [
                /á|à|ả|ã|ạ|â|ấ|ầ|ẫ|ậ|ẩ|ă|ắ|ằ|ẵ|ặ|ẳ/gi,
                /é|è|ẻ|ẽ|ẹ|ê|ế|ề|ễ|ể|ệ/gi,
                /i|í|ì|ị|ĩ|ỉ/gi,
                /o|ò|ó|ỏ|õ|ọ|ô|ố|ồ|ổ|ộ|ỗ|ơ|ớ|ờ|ỡ|ở|ợ/gi,
                /u|ù|ú|ủ|ũ|ụ|ư|ứ|ừ|ữ|ử|ự/gi,
                /y|ý|ỳ|ỷ|ỹ|ỵ/gi,
                /đ/gi
            ];

            var replacements = ['a', 'e', 'i', 'o', 'u', 'y', 'd'];

            for (var i = 0; i < accents.length; i++) {
                slug = slug.replace(accents[i], replacements[i]);
            }

            // Xóa các ký tự đặc biệt
            slug = slug.replace(/[\`\~\!\@\#\|\$\%\^\&\*\(\)\+\=\,\.\?\/\<\>\'\"\:\;\_]/gi, '');

            // Đổi khoảng trắng thành dấu gạch ngang
            slug = slug.replace(/ /gi, "-");

            // Đổi các ký tự gạch ngang liên tiếp thành 1 gạch
            slug = slug.replace(/-{2,}/g, '-');

            // Xoá các ký tự gạch ngang ở đầu và cuối
            slug = slug.replace(/^-+|-+$/g, '');

            // In slug ra textbox có id "convert_slug"
            document.getElementById('convert_slug').value = slug;
        }
    </script>
    <script type="text/javascript">
        $(".choose_category").change(function(){
            var category_id = $(this).val();
            if(category_id=='0'){
                alert('Vui lòng chọn danh mục game');
            }else{
                $.ajax({
                    url:"{{route('choose_category')}}",
                    method:"POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{category_id: category_id},
                    success:function(data){
                        $("#show_attribute").html(data);
                    }
                })
            }
        })

    </script>
</body>
</html>
