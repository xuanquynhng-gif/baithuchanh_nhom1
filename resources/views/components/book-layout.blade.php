<!DOCTYPE html>
<html>

<head>
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #ff5850;
            font-weight: bold;
            border-radius: 0;
        }

        .nav-item a {
            color: #fff !important;
        }

        .navbar-nav {
            margin: 0;
        }

        /* Cấu trúc lưới hiển thị sách ở trang index */
        .list-book {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            /* Chia 4 cột đều nhau */
            gap: 20px;
            padding: 10px;
        }

        .book {
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: 0.3s;
        }

        .book:hover {
            transform: translateY(-5px);
        }

        .book img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
        }

        /* Căn chỉnh Sidebar menu */
        .sidebar-img {
            width: 100%;
            border-radius: 4px;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <header class="text-center bg-white border-bottom">
        <div class="container p-0">
            <img src="{{asset('images/banner_sach.jpg')}}" class="img-fluid" style="max-width: 1000px;">
        </div>

        <nav class="navbar navbar-expand-sm navbar-dark m-auto" style="width: 1000px;">
            <div class="container p-0">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="{{url('sach')}}">Trang chủ</a></li>
                </ul>
                <div class="d-flex align-items-center">
                    @auth
                    <div class="dropdown">
                        <button type="button" class="btn btn-light dropdown-toggle btn-sm font-weight-bold" data-toggle="dropdown" style="color: #ff5850;">
                            Chào, {{ Auth::user()->name }}
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{route('account')}}">Quản lý tài khoản</a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">Đăng xuất</button>
                            </form>
                        </div>
                    </div>
                    @else
                    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light">Đăng nhập</a>
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    <main class="container py-4" style="max-width: 1000px; background: white;">
        <div class="row">
            <aside class="col-md-3">
                <x-menu>
                    <x-slot name="item">
                        <li class="nav-item border-bottom"><a class="nav-link text-dark" href="{{url('sach/theloai/1')}}" style="color: #333 !important;">Tiểu thuyết</a></li>
                        <li class="nav-item border-bottom"><a class="nav-link text-dark" href="{{url('sach/theloai/2')}}" style="color: #333 !important;">Truyện ngắn</a></li>
                        <li class="nav-item"><a class="nav-link text-dark" href="{{url('sach/theloai/3')}}" style="color: #333 !important;">Kinh điển</a></li>
                    </x-slot>
                </x-menu>
                <img src="{{asset('images/sidebar_1.jpg')}}" class="sidebar-img">
                <img src="{{asset('images/sidebar_2.jpg')}}" class="sidebar-img">
            </aside>

            <section class="col-md-9">
                {{ $slot }}
            </section>
        </div>
    </main>

    <footer class="text-center py-4 text-muted">
        <small>&copy; 2026 Bài thực hành 3</small>
    </footer>
</body>

</html>