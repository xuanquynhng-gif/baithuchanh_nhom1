<div class='list-book'>
    @foreach($data as $row)
    <div class='book'>
        <a href="{{url('sach/chitiet/'.$row->id)}}" style="text-decoration: none; color: black;">
        <img src="{{ asset('book_image/' . $row->file_anh_bia) }}" width="100%" class="img-thumbnail">
            
            <b style="display: block; margin-top: 5px;">{{$row->tieu_de}}</b><br/>
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