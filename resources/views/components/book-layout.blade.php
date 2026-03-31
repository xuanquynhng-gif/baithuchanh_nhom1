<!DOCTYPE html>
<html>
    <head>
        <title>{{ $title }}</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        
        {{-- Thêm Jquery để chạy được AJAX (image_0403a0.png) --}}
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <style>
            .navbar { background-color: #ff5850; font-weight:bold; }
            .nav-item a { color: #fff!important; }
            .navbar-nav { margin:0 auto; }
            .list-book { display:grid; grid-template-columns:repeat(4,24%); }

            /* 5. BỔ SUNG CSS XỬ LÝ GIAO DIỆN NÚT BẤM (image_055233.png) */
            .book { 
                margin:10px; 
                text-align:center; 
                position: relative; /* Thêm position để định vị nút con */
                padding-bottom: 35px; /* Tạo khoảng trống phía dưới cho nút */
            }

            .btn-add-product {
                position: absolute;
                bottom: 0;
                width: 100%;
            }
        </style>
    </head>
<body>
    <header style='text-align:center; position: relative;'>
        <img src="{{asset('images/banner_sach.jpg')}}" width="1000px">
        
        <div style="position: absolute; top: 10px; right: calc(50% - 480px); display: flex; align-items: center;">
            <div style='color:#ff5850; position:relative' class='mr-2'>
                <div style='width:20px; height:20px; background-color:#23b85c; color:white; font-size:12px; border:none; 
                     border-radius:50%; position:absolute; right:-5px; top:-5px; line-height:20px; text-align:center;' id='cart-number-product'>
                    @if (session('cart'))
                        {{ count(session('cart')) }}
                    @else
                        0
                    @endif
                </div>
                <a href="{{ route('order') }}" style='cursor:pointer; color:#ff5850;'>
                    <i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </header>

    <main style="width:1000px; margin:2px auto;">
        <div class='row'>
            <div class='col-3 pr-0'>
                <x-menu>
                    <x-slot name="item">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{url('sach')}}">Trang chủ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('sach/theloai/1')}}">Tiểu thuyết</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('sach/theloai/2')}}">Truyện ngắn - tản văn</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('sach/theloai/3')}}">Tác phẩm kinh điển</a>
                        </li>
                    </x-slot>
                </x-menu>
                <img src="{{asset('images/sidebar_1.jpg')}}" width="100%" class='mt-1'>
                <img src="{{asset('images/sidebar_2.jpg')}}" width="100%" class='mt-1'>
            </div>
            <div class='col-9'>
                {{ $slot }}
            </div>
        </div>
    </main>
</body>
</html>