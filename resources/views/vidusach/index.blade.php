<x-book-layout>
    <x-slot name="title">Trang chủ Nhà sách</x-slot>
    <div id='book-view-div'>
        <div class='list-book'>
            @foreach($data as $row)
            <div class='book'>
                <a href="{{url('sach/chitiet/'.$row->id)}}" style="text-decoration: none; color: black;">
                   <img src="{{ asset('book_image/' . $row->file_anh_bia) }}" width="100%" class="img-thumbnail">
                    <b style="display: block; margin-top: 5px;">{{$row->tieu_de}}</b><br />
                    <i style="color: #ff5850;">{{number_format($row->gia_ban,0,",",".")}}đ</i>
                </a>

                <div class='btn-add-product'>
                    <button class='btn btn-success btn-sm mb-1 add-product' book_id="{{$row->id}}">
                        Thêm vào giỏ hàng
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script>
        $(document).ready(function() {
            console.log("Document is ready. Setting up click handlers for menu items.");
            $(".menu-the-loai").click(function(e) {
                e.preventDefault(); // Chặn load lại trang để AJAX chạy
                the_loai = $(this).attr("the_loai");
                $.ajax({
                    type: "POST",
                    dataType: "html",
                    url: "{{route('bookview')}}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "the_loai": the_loai
                    },
                    beforeSend: function() {},
                    success: function(data) {
                        $("#book-view-div").html(data);
                    },
                    error: function(xhr, status, error) {},
                    complete: function(xhr, status) {}
                });
            });
        });
    </script>
</x-book-layout>