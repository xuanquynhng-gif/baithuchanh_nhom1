@extends("layouts.sach_layout")
@section("title", $sach->tieu_de)

@section("content")
<div class="container-fluid">
    <div class="row">
        <div class="col-md-5">
            <img src="{{asset('book_image/'.$sach->file_anh_bia)}}" width="100%" class="img-thumbnail">
        </div>
        
        <div class="col-md-7">
            <h3 class="text-primary">{{$sach->tieu_de}}</h3>
            <hr>
            <p>Nhà cung cấp: <b>{{$sach->nha_cung_cap ?? 'Đang cập nhật'}}</b></p>
            <p>Nhà xuất bản: <b>{{$sach->nha_xuat_ban ?? 'Đang cập nhật'}}</b></p>
            <p>Tác giả: <b>{{$sach->tac_gia ?? 'Đang cập nhật'}}</b></p>
            <p>Hình thức bìa: <b>{{$sach->hinh_thuc_bia ?? 'Bìa mềm'}}</b></p>
            <h4 class="text-danger">{{number_format($sach->gia_ban, 0, ",", ".")}}đ</h4>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <h5 class="bg-light p-2">Mô tả:</h5>
            <p style="text-align: justify; line-height: 1.6;">
                {{$sach->mo_ta ?? 'Chưa có mô tả cho cuốn sách này.'}}
            </p>
        </div>
    </div>
</div>
@endsection