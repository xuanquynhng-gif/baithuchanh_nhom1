<x-book-layout>
    {{-- Định nghĩa tiêu đề trang --}}
    <x-slot name="title">
        {{ $sach->tieu_de }}
    </x-slot>

    <div class="container-fluid">
      
        </div>

        <div class="row">
            <div class="col-md-5">
                <img src="{{ asset('book_image/'.$sach->file_anh_bia) }}" width="100%" class="img-thumbnail">
            </div>
            
            <div class="col-md-7">
                <h3 class="text-primary">{{ $sach->tieu_de }}</h3>
                <hr>
                <p>Nhà cung cấp: <b>{{ $sach->nha_cung_cap ?? 'Đang cập nhật' }}</b></p>
                <p>Nhà xuất bản: <b>{{ $sach->nha_xuat_ban ?? 'Đang cập nhật' }}</b></p>
                <p>Tác giả: <b>{{ $sach->tac_gia ?? 'Đang cập nhật' }}</b></p>
                <p>Hình thức bìa: <b>{{ $sach->hinh_thuc_bia ?? 'Bìa mềm' }}</b></p>
                <h4 class="text-danger">{{ number_format($sach->gia_ban, 0, ",", ".") }}đ</h4>

                {{-- 2. THÊM NÚT VÀ Ô ĐIỀU CHỈNH SỐ LƯỢNG (image_0392e2.png) --}}
                <div class='mt-3 p-3 bg-light border' style="border-radius: 8px;">
                    Số lượng mua:
                    <input type='number' id='product-number' size='5' min="1" value="1" class="form-control d-inline-block mx-2" style="width: 80px;">
                    <button class='btn btn-success btn-sm mb-1' id='add-to-cart'>Thêm vào giỏ hàng</button>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <h5 class="bg-light p-2">Mô tả:</h5>
                <p style="text-align: justify; line-height: 1.6;">
                    {{ $sach->mo_ta ?? 'Chưa có mô tả cho cuốn sách này.' }}
                </p>
            </div>
        </div>
    </div>

    {{-- 3. THÊM SCRIPT AJAX XỬ LÝ KHI NHẤN NÚT THÊM (image_0392e2.png) --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#add-to-cart").click(function(){ // Xử lý sự kiện khi nhấn nút Thêm bằng Jquery
                
                var id = "{{ $sach->id }}"; 
                var num = $("#product-number").val(); // Lấy giá trị số lượng mua

                $.ajax({ // Sử dụng ajax để gửi dữ liệu
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('cartadd') }}", // Đường dẫn trang xử lý thêm vào giỏ hàng
                    data: {
                        "_token": "{{ csrf_token() }}", // Sử dụng hàm csrf_token để tạo token
                        "id": id,
                        "num": num // Dữ liệu được gửi đến trang xử lý
                    },
                    beforeSend: function(){
                        // Có thể thêm loading tại đây
                    },
                    success: function(data){
                        // Giá trị trang xử lý thêm vào giỏ hàng trả về
                        $("#cart-number-product").html(data); // Cập nhật lại số lượng sản phẩm
                        alert("Đã thêm sản phẩm vào giỏ hàng thành công!");
                    },
                    error: function(xhr, status, error){
                        console.error(error);
                    }
                });
            });
        });
    </script>
    <script>
    $(document).ready(function(){
      $(".add-product").click(function(){
      id = $(this).attr("book_id");
      num = 1;
      $.ajax({
        type:"POST",
        dataType:"json",
        url: "{{route('cartadd')}}",
        data:{"_token": "{{ csrf_token() }}","id":id,"num":num},
        beforeSend:function(){
        
        },
        success:function(data){
          $("#cart-number-product").html(data);
        },
        error: function (xhr,status,error){
        },
        complete: function(xhr,status){
        }
      });
      });
    });
  </script>
</x-book-layout>