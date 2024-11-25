<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Bắt đầu session

// Require các file cần thiết
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ
require_once 'controllers/DashboardController.php';
require_once 'controllers/ProductController.php';
require_once 'controllers/CategoryController.php';
require_once 'controllers/AdminController.php';
require_once 'controllers/OrderController.php';

// Hàm bảo vệ (Middleware)
function protect(callable $callback) {
    if (!isset($_SESSION['MaAdmin']) || $_SESSION['MaQuyen'] != 1) {
        header("Location: ?act=admin/loginForm&error=Vui lòng đăng nhập trước!");
        exit;
    }
    return $callback();
}

// Require toàn bộ file Models
require_once './models/AdminDanhMuc.php';
require_once './models/AdminSanPham.php';
require_once './models/AdminDonHang.php';
require_once './models/AdminTaiKhoan.php';

// Route
$act = $_GET['act'] ?? '/';

switch ($act) {
    // Route không yêu cầu đăng nhập
    case 'admin/loginForm':
        (new AdminController())->loginForm();
        break;
    case 'admin/login':
        (new AdminController())->login();
        break;
    case 'admin/logout':
        (new AdminController())->logout();
        break;

    // Route yêu cầu đăng nhập
    case '/':
        protect(fn() => (new DashboardController())->index());
        break;
    case 'product':
        protect(fn() => (new ProductController())->index());
        break;
    case 'product/create':
        protect(fn() => (new ProductController())->create());
        break;
    case 'product/edit':
        protect(fn() => (new ProductController())->edit());
        break;
    case 'product/update':
        protect(fn() => (new ProductController())->update($_GET['MaSP']));
        break;
    case 'product/delete':
        protect(fn() => (new ProductController())->delete($_GET['MaSP']));
        break;

    // Cate
    case 'category':
        protect(fn() => (new CategoryController())->index());
        break;
    case 'category/create':
        protect(fn() => (new CategoryController())->create());
        break;
    case 'category/edit':
        protect(fn() => (new CategoryController())->edit());
        break;
    case 'category/update':
        protect(fn() => (new CategoryController())->update($_GET['MaLoai']));
        break;
    case 'category/delete':
        protect(fn() => (new CategoryController())->delete($_GET['MaLoai']));
        break;

    // Admin
    case 'admin':
        protect(fn() => (new AdminController())->index());
        break;
    case 'admin/create':
        protect(fn() => (new AdminController())->create());
        break;
    case 'admin/edit':
        protect(fn() => (new AdminController())->edit($_GET['MaAdmin']));
        break;
    case 'admin/update':
        protect(fn() => (new AdminController())->update($_GET['MaAdmin']));
        break;
    case 'admin/delete':
        protect(fn() => (new AdminController())->delete($_GET['MaAdmin']));
        break;

    // Đơn đặt hàng
    case 'orders':
        protect(fn() => (new OrderController())->index());
        break;
    case 'order/view':
        protect(fn() => (new OrderController())->view($_GET['MaDH']));
        break;
    case 'order/delete':
        protect(fn() => (new OrderController())->delete($_GET['MaDH']));
        break;
    case 'order/updateStatus':
        (new OrderController())->updateStatus();
        break;

    default:
        // Xử lý nếu không có route nào khớp
        echo "Trang không tồn tại!";
        break;
}
