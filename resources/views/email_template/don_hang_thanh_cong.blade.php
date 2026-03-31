<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; line-height: 1.6; color: #333; }
        .container { width: 80%; margin: 0 auto; border: 1px solid #ddd; padding: 20px; border-radius: 8px; }
        .header { text-align: center; border-bottom: 2px solid #28a745; pb: 10px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        .table th { background-color: #f8f9fa; }
        .total { text-align: right; font-weight: bold; font-size: 18px; color: #d9534f; }
        .footer { margin-top: 30px; font-size: 12px; text-align: center; color: #777; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>CẢM ƠN BẠN ĐÃ ĐẶT HÀNG!</h2>
            <p>Mã đơn hàng: <strong>#{{ $data[0]->ma_don_hang }}</strong></p>
        </div>

        <p>Chào bạn, chúng tôi đã nhận được đơn đặt hàng của bạn và đang tiến hành xử lý.</p>

        <table class="table">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá bán</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @php $tong = 0; @endphp
                @foreach($data as $item)
                    @php 
                        $thanhTien = $item->so_luong * $item->gia_ban;
                        $tong += $thanhTien;
                    @endphp
                    <tr>
                        <td>{{ $item->tieu_de }}</td>
                        <td>{{ $item->so_luong }}</td>
                        <td>{{ number_format($item->gia_ban, 0, ',', '.') }}đ</td>
                        <td>{{ number_format($thanhTien, 0, ',', '.') }}đ</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p class="total">Tổng thanh toán: {{ number_format($tong, 0, ',', '.') }}đ</p>

        <div class="footer">
            <p>Đây là email tự động, vui lòng không phản hồi email này.</p>
            <p>© 2026 Nhà sách Phương Nam - Chúc bạn đọc sách vui vẻ!</p>
        </div>
    </div>
</body>
</html>