<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // Cần thiết để lấy ID người dùng

class BookController extends Controller
{
    /**
     * Bước 2: Xử lý khi nhấn nút Thêm (Ajax)
     */
    public function cartadd(Request $request)
    {
        // Kiểm tra dữ liệu đầu vào
        $request->validate([
            "id" => ["required", "numeric"],
            "num" => ["required", "numeric"]
        ]);

        $id = $request->id;
        $num = $request->num;
        $total = 0; // Khởi tạo biến tổng số lượng
        $cart = [];

        if (session()->has('cart')) {
            $cart = session()->get("cart");
            if (isset($cart[$id])) {
                $cart[$id] += $num; // Nếu đã có thì cộng dồn số lượng
            } else {
                $cart[$id] = $num; // Nếu chưa có thì thêm mới
            }
        } else {
            $cart[$id] = $num;
        }

        session()->put("cart", $cart);
        
        // Trả về tổng số mặt hàng để Jquery cập nhật thẻ #cart-number-product
        return count($cart);
    }

    /**
     * Bước 3: Tạo trang đặt hàng - Hiển thị giỏ hàng
     */
    public function order()
    {
        $cart = [];
        $data = [];
        $quantity = [];

        if (session()->has('cart')) {
            $cart = session("cart");
            $list_book = "";

            foreach ($cart as $id => $value) {
                $quantity[$id] = $value; // Lưu số lượng của từng sách
                $list_book .= $id . ", "; // Tạo chuỗi ID
            }

            // Xóa dấu phẩy và khoảng trắng thừa ở cuối
            $list_book = substr($list_book, 0, strlen($list_book) - 2);

            // Truy vấn lấy thông tin từ database
            $data = DB::table("sach")->whereRaw("id in (" . $list_book . ")")->get();
        }

        return view("vidusach.order", compact("quantity", "data"));
    }

    /**
     * Bước 3: Xóa sản phẩm khỏi giỏ hàng
     */
    public function cartdelete(Request $request)
    {
        $request->validate(["id" => ["required", "numeric"]]);
        $id = $request->id;
        $cart = [];

        if (session()->has('cart')) {
            $cart = session()->get("cart");
            unset($cart[$id]); // Loại bỏ ID sách khỏi mảng
            session()->put("cart", $cart);
        }

        return redirect()->route('order');
    }

    /**
     * Bước 3: Tạo đơn hàng và lưu vào Database
     */
    public function ordercreate(Request $request)
    {
        // Kiểm tra hình thức thanh toán từ form
        $request->validate([
            "hinh_thuc_thanh_toan" => ["required", "numeric"]
        ]);

        $data = [];
        $quantity = [];

        if (session()->has('cart')) {
            
            $order = [
                "ngay_dat_hang" => DB::raw("now()"),
                "tinh_trang" => 1, 
                "hinh_thuc_thanh_toan" => $request->hinh_thuc_thanh_toan,
                "user_id" => Auth::user()->id
            ];

            
            DB::transaction(function () use ($order) {
                
                $id_don_hang = DB::table("don_hang")->insertGetId($order);

                $cart = session("cart");
                $list_book = "";
                $quantity = [];

                foreach ($cart as $id => $value) {
                    $quantity[$id] = $value;
                    $list_book .= $id . ", ";
                }

                $list_book = substr($list_book, 0, strlen($list_book) - 2);
                $books = DB::table("sach")->whereRaw("id in (" . $list_book . ")")->get();

                $detail = [];
                foreach ($books as $row) {
                  
                    $detail[] = [
                        "ma_don_hang" => $id_don_hang,
                        "sach_id" => $row->id,
                        "so_luong" => $quantity[$row->id],
                        "don_gia" => $row->gia_ban
                    ];
                }
                DB::table("chi_tiet_don_hang")->insert($detail);

               
                session()->forget('cart');
            });
        }

        
        return view("vidusach.order", compact('data', 'quantity'));
    }
}