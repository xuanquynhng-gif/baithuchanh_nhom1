<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <style>
        .navbar {
            background-color: #ff5850;
            font-weight: bold;
        }
        .nav-item a {
            color: #fff !important;
        }
        .navbar-nav {
            margin: 0 auto;
        }
        .list-book {
            display: grid;
            grid-template-columns: repeat(4, 24%);
        }
        .book {
            position: relative;
            margin: 10px;
            text-align: center;
            padding-bottom: 35px; 
        }
        .btn-add-product {
            position: absolute; 
            bottom: 0; 
            width: 100%; 
        }
    </style>
</head>
<body>
    <header style='text-align:center'>
        <img src="{{asset('images/banner_sach.jpg')}}" width="1000px">
    </header>

    <main style="width:1000px; margin:2px auto;">
        <div class='row'>
            <div class='col-3 pr-0'>
              <x-menu>
    <x-slot name="item">
        <li class="nav-item">
            <a class="nav-link menu-the-loai" href="#" the_loai="">Trang chủ</a> 
        </li>
        <li class="nav-item">
            <a class="nav-link menu-the-loai" href="#" the_loai="1">Tiểu thuyết</a> 
        </li>
        <li class="nav-item">
            <a class="nav-link menu-the-loai" href="#" the_loai="2">Truyện ngắn - tản văn</a> 
        </li>
        <li class="nav-item">
            <a class="nav-link menu-the-loai" href="#" the_loai="3">Tác phẩm kinh điển</a> 
        </li>
    </x-slot>
</x-menu>
                <img src="{{asset('images/sidebar_1.jpg')}}" width="100%" class='mt-1'>
                <img src="{{asset('images/sidebar_2.jpg')}}" width="100%" class='mt-1'>
            </div>

            <div class='col-9'>
                <div id="book-view-div">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </main>
</body>
</html>