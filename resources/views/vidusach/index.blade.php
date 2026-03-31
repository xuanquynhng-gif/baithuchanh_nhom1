<x-book-layout>
    <x-slot name="title">
        Sách
    </x-slot>
    <div id='book-view-div'>
        <div class='list-book'>
            @foreach($data as $row)
                <div class='book'>
                    <a href="{{url('sach/chitiet/'.$row->id)}}" style="text-decoration: none; color: black;">
                        {{-- Đường dẫn ảnh lấy từ thư mục storage/book_image (cite: image_056516.png) --}}
                        <img src="{{asset('book_image/'.$row->file_anh_bia)}}" width='200px' height='200px'><br>
                        <b>{{$row->tieu_de}}</b>
                    </a>
                    <br/>
                    <i>{{number_format($row->gia_ban,0,",",".")}}đ</i>

                    {{-- 1. Bổ sung nút Thêm vào giỏ hàng (cite: image_04f0b8.png, image_04f3fc.png) --}}
                    <div class='btn-add-product'>
                        {{-- Thêm class 'add-product' để xử lý sự kiện click và thuộc tính 'book_id' để xác định cuốn sách (cite: image_054a1d.png) --}}
                        <button class='btn btn-success btn-sm mb-1 add-product' book_id="{{$row->id}}">
                            Thêm vào giỏ hàng
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <style>
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

    <script>
        $(document).ready(function(){
            // XỬ LÝ 1: THÊM VÀO GIỎ HÀNG (cite: image_054a1d.png)
            $(".add-product").click(function(){ 
                var id = $(this).attr("book_id"); // Lấy giá trị id của cuốn sách (cite: image_054a1d.png)
                var num = 1; 

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('cartadd') }}", // Route đã định nghĩa tên 'cartadd' (cite: image_0461f3.png)
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "id": id,
                        "num": num
                    },
                    success: function(data){
                        // Cập nhật số lượng hiển thị trên icon giỏ hàng (cite: image_054a1d.png)
                        $("#cart-number-product").html(data);
                        alert("Đã thêm vào giỏ hàng!");
                    }
                });
            });

            // XỬ LÝ 2: HIỂN THỊ DANH SÁCH THEO THỂ LOẠI BẰNG AJAX (cite: image_0568fa.png)
            $(".menu-the-loai").click(function(){
                var the_loai = $(this).attr("the_loai"); // Lấy mã thể loại từ menu (cite: image_0568fa.png)
                
                $.ajax({
                    type: "POST",
                    dataType: "html", // Dữ liệu trả về có dạng HTML (cite: image_0568fa.png)
                    url: "{{route('bookview')}}", 
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "the_loai": the_loai
                    },
                    beforeSend: function(){
                        // Có thể thêm hiệu ứng loading tại đây (cite: image_0568fa.png)
                    },
                    success: function(data){
                        // Thay đổi nội dung của thẻ div id='book-view-div' (cite: image_0568fa.png)
                        $("#book-view-div").html(data);
                    },
                    error: function(xhr, status, error){
                        // Xử lý khi có lỗi xảy ra (cite: image_0568fa.png)
                    }
                });
            });
        });
    </script>
</x-book-layout>