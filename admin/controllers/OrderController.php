<?php
require_once './models/OrderModel.php';

class OrderController {
    private $orderModel;

    public function __construct() {
        $this->orderModel = new OrderModel();
    }

    // Hiển thị danh sách đơn hàng
    public function index() {
        $orders = $this->orderModel->getAllOrders();
        // Số sản phẩm hiển thị mỗi trang
        $perPage = 5;

        // Tổng số sản phẩm
        $totalOrders = count($orders);

        // Tính số trang
        $totalPages = ceil($totalOrders / $perPage);

        // Lấy trang hiện tại từ query string (mặc định là 1 nếu không có)
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $currentPage = max(1, min($totalPages, $currentPage));

        // Tính chỉ số bắt đầu và kết thúc sản phẩm trên trang hiện tại
        $startIndex = ($currentPage - 1) * $perPage;
        $endIndex = min($startIndex + $perPage, $totalOrders);

        // Lấy danh sách sản phẩm cho trang hiện tại
        $ordersOnPage = array_slice($orders, $startIndex, $perPage);
        require_once './views/order/ListOrder.php';
    }

    // Xem chi tiết đơn hàng
    public function view($MaDH) {
        $order = $this->orderModel->getOrderById($MaDH);
        $orderDetails = $this->orderModel->getOrderDetailsById($MaDH);
        // var_dump($orderDetails); die();

        // $products = $this->orderModel->getProductById($MaSP);
        // // echo $orderDetails;
        // // die();
        require_once './views/order/DetailOrder.php';
    }

    // Xóa đơn hàng
    public function delete($MaDH) {
        $this->orderModel->deleteOrder($MaDH);
        header("Location: ?act=orders");
        exit;
    }

    public function updateStatus() {
        $MaDH = $_POST['MaDH'] ?? null;
        $TinhTrangDH = $_POST['TinhTrangDH'] ?? null;
    
        if (!$MaDH || !$TinhTrangDH) {
            header("Location: ?act=order/view&MaDH=$MaDH&error=Missing data");
            exit;
        }
    
        // Gọi model để cập nhật trạng thái
        $this->orderModel->updateOrderStatus($MaDH, $TinhTrangDH);
    
        // Chuyển hướng lại trang chi tiết đơn hàng
        header("Location: ?act=orders");
    }
    
}