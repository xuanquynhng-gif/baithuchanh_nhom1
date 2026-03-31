<x-account-panel>
    <div class="panel panel-default" style="width:60%; margin:0 auto;">
        <div class="panel-body mt-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('booksave', ['action' => $action]) }}" method="post" enctype="multipart/form-data">
                @csrf
                
                <h4 class="text-center font-weight-bold text-primary mb-3">
                    {{ $action == "add" ? "THÊM THÔNG TIN SÁCH" : "SỬA THÔNG TIN SÁCH" }}
                </h4>

                <div class="form-group mb-2">
                    <label>Tiêu đề</label>
                    <input type="text" class="form-control form-control-sm" name="tieu_de" 
                           value="{{ $sach->tieu_de ?? '' }}" required> </div>

                <div class="row">
                    <div class="col-md-6 form-group mb-2">
                        <label>Nhà xuất bản</label>
                        <input type="text" class="form-control form-control-sm" name="nha_xuat_ban" 
                               value="{{ $sach->nha_xuat_ban ?? '' }}"> </div>
                    <div class="col-md-6 form-group mb-2">
                        <label>Nhà cung cấp</label>
                        <input type="text" class="form-control form-control-sm" name="nha_cung_cap" 
                               value="{{ $sach->nha_cung_cap ?? '' }}"> </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group mb-2">
                        <label>Tác giả</label>
                        <input type="text" class="form-control form-control-sm" name="tac_gia" 
                               value="{{ $sach->tac_gia ?? '' }}"> </div>
                    <div class="col-md-6 form-group mb-2">
                        <label>Hình thức bìa</label>
                        <input type="text" class="form-control form-control-sm" name="hinh_thuc_bia" 
                               value="{{ $sach->hinh_thuc_bia ?? '' }}"> </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group mb-2">
                        <label>Giá bán</label>
                        <input type="text" class="form-control form-control-sm" name="gia_ban" 
                               value="{{ $sach->gia_ban ?? '' }}"> </div>
                    <div class="col-md-6 form-group mb-2">
                        <label>Thể loại</label>
                        <select name="the_loai" class="form-control form-control-sm">
                            @php $selected = $sach->the_loai ?? ""; @endphp @foreach($the_loai as $row)
                                <option value="{{ $row->id }}" {{ $selected == $row->id ? 'selected' : '' }}>
                                    {{ $row->ten_the_loai }}
                                </option> @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label>Ảnh đại diện</label><br>
                    @if($action == "edit")
                        <img src="{{ asset('storage/book_image/'.$sach->file_anh_bia) }}" width="50px" class="mb-1">
                        <input type="hidden" value="{{ $sach->id }}" name="id">
                    @endif
                    <input type="file" name="file_anh_bia" accept="image/*" class="form-control-file"> </div>

                <div class="text-center">
                    <input type="submit" class="btn btn-primary" value="Lưu">
                    <a href="{{ route('booklist') }}" class="btn btn-secondary">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</x-account-panel>