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

// Route
$act = $_GET['act'] ?? '/';

match ($act) {
    // Route không yêu cầu đăng nhập
    'admin/loginForm'   => (new AdminController())->loginForm(),
    'admin/login'       => (new AdminController())->login(),
    'admin/logout'      => (new AdminController())->logout(),

    // Route yêu cầu đăng nhập
    '/'                 => protect(fn() => (new DashboardController())->index()),
    'product'           => protect(fn() => (new ProductController())->index()),
    'product/create'    => protect(fn() => (new ProductController())->create()),
    'product/edit'      => protect(fn() => (new ProductController())->edit()),
    'product/update'    => protect(fn() => (new ProductController())->update($_GET['MaSP'])),
    'product/delete'    => protect(fn() => (new ProductController())->delete($_GET['MaSP'])),

    //cate
    'category'          => protect(fn() => (new CategoryController())->index()),
    'category/create'   => protect(fn() => (new CategoryController())->create()),
    'category/edit'     => protect(fn() => (new CategoryController())->edit()),
    'category/update'   => protect(fn() => (new CategoryController())->update($_GET['MaLoai'])),
    'category/delete'   => protect(fn() => (new CategoryController())->delete($_GET['MaLoai'])),

    //admin
    'admin'             => protect(fn() => (new AdminController())->index()),
    'admin/create'      => protect(fn() => (new AdminController())->create()),
    'admin/edit'        => protect(fn() => (new AdminController())->edit($_GET['MaAdmin'])),
    'admin/update'      => protect(fn() => (new AdminController())->update($_GET['MaAdmin'])),
    'admin/delete'      => protect(fn() => (new AdminController())->delete($_GET['MaAdmin'])),

    // Đơn đặt hàng
    'orders' => protect(fn() => (new OrderController())->index()),
    'order/view' => protect(fn() => (new OrderController())->view($_GET['MaDH'])),
    'order/delete' => protect(fn() => (new OrderController())->delete($_GET['MaDH'])),
    'order/updateStatus' => (new OrderController())->updateStatus(),

    
};
