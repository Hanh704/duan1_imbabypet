<?php 
session_start();
// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ
// Require toàn bộ file Controllers
require_once './controllers/AdminDanhMucController.php';
require_once './controllers/AdminSanPhamController.php';
require_once './controllers/AdminDonHangController.php';
require_once './controllers/AdminBaoCaoThongKeController.php';
require_once './controllers/AdminTaiKhoanController.php'; 


// // Require toàn bộ file Models
// require_once './models/Student.php';
// require_once './models/SanPham.php';
require_once './models/AdminDanhMuc.php';
require_once './models/AdminSanPham.php';
require_once './models/AdminDonHang.php';
require_once './models/AdminTaiKhoan.php';
// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

if($act !=='login-admin' && $act !=='check-login-admin' && $act !=='logout-admin') {
  checkLoginAdmin();
}

match ($act){
  // route báo cáo
    '/' =>(new AdminBaoCaoThongKeController())->home(),

  // route danh mục
    'danh-muc' =>(new AdminDanhMucController())->danhSachDanhMuc(),
    'from-them-danh-muc' =>(new AdminDanhMucController())->formAddDanhMuc(),
    'them-danh-muc' =>(new AdminDanhMucController())->postAddDanhMuc(),
    'from-sua-danh-muc' =>(new AdminDanhMucController())->formEditDanhMuc(),
    'sua-danh-muc' =>(new AdminDanhMucController())->postEditDanhMuc(),
    'xoa-danh-muc' =>(new AdminDanhMucController())->deleteDanhMuc(),
// route sản phẩm

'san-pham' =>(new AdminSanPhamController())->danhSachSanPham(),
'from-them-san-pham' =>(new AdminSanPhamController())->formAddSanPham(),
'them-san-pham' =>(new AdminSanPhamController())->postAddSanPham(),
'from-sua-san-pham' =>(new AdminSanPhamController())->formEditSanPham(),
'sua-san-pham' =>(new AdminSanPhamController())->postEditSanPham(),
'sua-album-anh-san-pham' =>(new AdminSanPhamController())->postEditAnhSanPham(),

'xoa-san-pham' =>(new AdminSanPhamController())->deleteSanPham(),

'chi-tiet-san-pham' =>(new AdminSanPhamController())->detailSanPham(),
// bình luận
'update-trang-thai-binh-luan' =>(new AdminSanPhamController())->updateTrangThaiBinhLuan(),


// route đơn hàng
'don-hang' =>(new AdminDonHangController())->danhSachDonHang(),

'from-sua-don-hang' =>(new AdminDonHangController())->formEditDonHang(),
'sua-don-hang' =>(new AdminDonHangController())->postEditDonHang(),

'chi-tiet-don_hang' =>(new AdminDonHangController())->detailDonHang(),

// route quản lí tk

'list-tai-khoan-quan-tri' =>(new AdminTaiKhoanController())->danhSachQuanTri(),
'form-them-quan-tri' =>(new AdminTaiKhoanController())->formAddQuanTri(),
'them-quan-tri' =>(new AdminTaiKhoanController())->postAddQuanTri(),
'from-sua-quan-tri' =>(new AdminTaiKhoanController())->formEditQuanTri(),
'sua-quan-tri' =>(new AdminTaiKhoanController())->postEditQuanTri(),

'reset-password' =>(new AdminTaiKhoanController())->resetPassword(),

// khách hàng
'list-tai-khoan-khach-hang' =>(new AdminTaiKhoanController())->danhSachKhachHang(),
  
'from-sua-khach-hang' =>(new AdminTaiKhoanController())->formEditKhachHang(),
'sua-khach-hang' =>(new AdminTaiKhoanController())->postEditKhachHang(),  
'chi-tiet-khach-hang' =>(new AdminTaiKhoanController())->detailKhachHang(),

// cá nhân 

'form-sua-thong-tin-ca-nhan-quan-tri' =>(new AdminTaiKhoanController())->formEditCaNhanQuanTri(),
'sua-thong-tin-ca-nhan-quan-tri' =>(new AdminTaiKhoanController())->postEditCaNhanQuanTri(),
'sua-mat-khau-ca-nhan-quan-tri' =>(new AdminTaiKhoanController())->postEditMatKhauCaNhan(),





// đăng nhập
'login-admin' =>(new AdminTaiKhoanController())->formLogin(),
'check-login-admin' =>(new AdminTaiKhoanController())->login(),
'logout-admin' =>(new AdminTaiKhoanController())->logout(),


};
?> 