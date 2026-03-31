<x-book-layout>
        <x-slot name="title">Trang chủ</x-slot>

        <div class='list-book'>
            @foreach($data as $row)
                <div class='book'>
                    <a href="{{url('sach/chitiet/'.$row->id)}}" style="text-decoration: none; color: black;">
                        <div style="height: 200px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                            <img src="{{asset('storage/book_image/'.$row->file_anh_bia)}}" 
                                 style="max-width: 100%; max-height: 100%; object-fit: contain;">
                        </div>
                        <br>
                        <b class="mt-2 d-block text-truncate" title="{{$row->tieu_de}}">{{$row->tieu_de}}</b>
                    </a>
                    
                    <div class="mt-1">
                        <span class="text-danger font-weight-bold" style="font-size: 1.1em;">
                            {{number_format($row->gia_ban, 0, ",", ".")}}đ
                        </span>
                    </div>
                    
                    <a href="{{url('sach/chitiet/'.$row->id)}}" class="btn btn-sm btn-outline-primary mt-2 btn-block">Xem chi tiết</a>
                </div>
            @endforeach
        </div>
</x-book-layout>