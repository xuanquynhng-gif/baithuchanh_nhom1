<x-account-panel>
    <div class="content" style="margin-left: 240px; padding: 20px;">
        <h3>THÔNG TIN TÀI KHOẢN</h3>
        <form action="{{ route('saveaccount') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="name" value="{{ $data->name }}" class="form-control mb-2">
            <input type="file" name="photo" class="form-control mb-2">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
</x-account-panel>