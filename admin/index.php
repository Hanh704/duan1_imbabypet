<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once 'controllers/DashboardController.php';
require_once 'controllers/ProductController.php';
require_once 'controllers/CategoryController.php';

// Require toàn bộ file Models

// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Dashboards
    '/'                 => (new DashboardController())->index(),

    //product
    'product'           => (new ProductController())->index(),
    'product/create'       => (new ProductController())->create(),
    'product/edit'         => (new ProductController())->edit(),
    'product/update'       => (new ProductController())->update($_GET['MaSP']),
    'product/delete'       => (new ProductController())->delete($_GET['MaSP']),

    //category
    'category'          => (new CategoryController())->index(),
    'category/create'   => (new CategoryController())->create(),
    'category/edit'     => (new CategoryController())->edit(),
    'category/update'   => (new CategoryController())->update($_GET['MaLoai']),
    'category/delete'   => (new CategoryController())->delete($_GET['MaLoai']),

    'category/show_products' => (new CategoryController())->showProductByCategory($_GET['MaLoai']),


};