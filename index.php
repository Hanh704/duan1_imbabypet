<?php 
// Bắt đầu session
session_start();

// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
// require_once './admin/controllers/HomeController.php';

// Require toàn bộ file Models
require_once './admin/models/AdminDanhMuc.php';
require_once './admin/models/AdminSanPham.php';
require_once './admin/models/AdminDonHang.php';
require_once './admin/models/AdminTaiKhoan.php';

// Route - định tuyến
$act = $_GET['act'] ?? '/';

// Sử dụng match để xử lý hành động
match ($act) {
    // Trang chủ
    '/' => (new HomeController())->home(),
    
    // Chi tiết sản phẩm
    'chi-tiet-san-pham' => (new HomeController())->chiTietSanPham(),

    // Thêm vào giỏ hàng
    'them-gio-hang' => (new HomeController())->addGioHang(),

    // Trang giỏ hàng
    'gio-hang' => (new HomeController())->gioHang(),

    // Thanh toán
    'thanh-toan' => (new HomeController())->thanhToan(),
    'xu-ly-thanh-toan' => (new HomeController())->postThanhToan(),

    // Đăng nhập
    'login' => (new HomeController())->fromLogin(),
    'check-login' => (new HomeController())->postLogin(),

    // Xử lý trường hợp không tồn tại route
    default => die("404 - Không tìm thấy hành động bạn yêu cầu."),
};
