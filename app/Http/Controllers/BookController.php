<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function booklist()
    {
        $data = DB::table("sach")->get();
        return view("vidusach.book_list", compact("data"));
    }
    public function bookcreate()
    {
        $the_loai = DB::table("dm_the_loai")->get();
        $action = "add";
        return view("vidusach.book_form", compact("the_loai", "action"));
    }

    public function bookedit($id)
    {
        $action = "edit";
        $the_loai = DB::table("dm_the_loai")->get();
        $sach = DB::table("sach")->where("id", $id)->first();
        return view("vidusach.book_form", compact("the_loai", "action", "sach"));
    }

    public function booksave($action, Request $request)
    {
        // 1. Kiểm tra dữ liệu đầu vào (Validation)
        $request->validate([
            'tieu_de' => ['required', 'string', 'max:200'],
            'nha_cung_cap' => ['required', 'string', 'max:50'],
            'nha_xuat_ban' => ['required', 'string', 'max:50'],
            'tac_gia' => ['required', 'string', 'max:50'],
            'hinh_thuc_bia' => ['required', 'string', 'max:50'],
            'gia_ban' => ['required', 'numeric'],
            'the_loai' => ['required', 'max:3'],
            'file_anh_bia' => ['nullable', 'image']
        ]);

        // 2. Chuẩn bị dữ liệu để lưu (Loại bỏ các trường không cần thiết)
        $data = $request->except("_token"); // Mặc định loại bỏ token bảo mật
        if ($action == "edit") {
            $data = $request->except("_token", "id"); // Nếu sửa thì loại bỏ cả id khỏi mảng data
        }

        // 3. Xử lý tải hình ảnh (Nếu có file mới được chọn)
        if ($request->hasFile("file_anh_bia")) {
            // Tạo tên file duy nhất: Tiêu đề + số ngẫu nhiên + đuôi file
            $fileName = $request->input("tieu_de") . "_" . rand(1000000, 9999999) . '.' . $request->file('file_anh_bia')->extension();

            // Lưu file vào thư mục: storage/app/public/book_image
            $request->file('file_anh_bia')->storeAs('public/book_image', $fileName);

            // Cập nhật tên file vào mảng dữ liệu để lưu xuống database
            $data['file_anh_bia'] = $fileName;
        }

        // 4. Thực hiện lưu vào Database dựa trên hành động (Action)
        $message = "";
        if ($action == "add") {
            DB::table("sach")->insert($data); // Lệnh thêm mới
            $message = "Thêm thành công";
        } else if ($action == "edit") {
            $id = $request->id; // Lấy ID của cuốn sách đang sửa
            DB::table("sach")->where("id", $id)->update($data); // Lệnh cập nhật theo ID
            $message = "Cập nhật thành công";
        }

        // 5. Quay về trang danh sách kèm thông báo trạng thái
        return redirect()->route('booklist')->with('status', $message);
    }
    public function bookdelete(Request $request)
    {
        // 1. Lấy ID của cuốn sách từ request gửi lên 
        $id = $request->id;

        // 2. Thực hiện lệnh xóa trong bảng 'sach' dựa vào ID 
        
        DB::table("sach")->where("id", $id)->delete();

        // 3. Chuyển hướng quay lại trang danh sách kèm thông báo thành công 
        return redirect()->route('booklist')->with('status', "Xóa thành công");
    }
}
