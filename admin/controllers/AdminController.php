<?php

require_once "./models/AdminModel.php";

class AdminController {
    public $adminModel;

    function __construct()
    {
        $this->adminModel = new AdminModel();

    }

    // Hiển thị danh sách admin
    public function index() {
        $admins = $this->adminModel->getAllAdmins();

        // Số admin hiển thị mỗi trang
        $perPage = 5;

        // Tổng số admin
        $totalAdmins = count($admins);

        // Tính số trang
        $totalPages = ceil($totalAdmins / $perPage);

        // Lấy trang hiện tại từ query string (mặc định là 1 nếu không có)
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $currentPage = max(1, min($totalPages, $currentPage));

        //index để hiển thị stt
        $index = ($currentPage - 1) * $perPage + 1; // Khởi tạo STT, dựa trên trang hiện tại

        // Tính chỉ số bắt đầu và kết thúc admin trên trang hiện tại
        $startIndex = ($currentPage - 1) * $perPage;
        $endIndex = min($startIndex + $perPage, $totalAdmins);

        // Lấy danh sách admin cho trang hiện tại
        $adminsOnPage = array_slice($admins, $startIndex, $perPage);

        require_once __DIR__ . '/../views/admin/ListAdmin.php';
    }

    // Thêm mới admin
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_admin'])) {
            $HoTen = $_POST['HoTen'] ?? null;
            $Email = $_POST['Email'] ?? null;
            $DienThoai = $_POST['DienThoai'] ?? null;

            if (!$HoTen || !$Email || !$DienThoai) {
                echo "Các trường không được để trống.";
                return;
            }

            $this->adminModel->create($HoTen, $Email, $DienThoai);
            header("location:?act=admin");
        }
        require_once "./views/admin/CreateAdmin.php";
    }

    // Sửa thông tin admin
    public function edit() {
        $MaAdmin = $_GET['MaAdmin'] ?? null;
        $admin = $this->adminModel->getAdminByID($MaAdmin);

        if (!$MaAdmin || !$admin) {
            echo "Không tìm thấy admin để chỉnh sửa.";
            return;
        }

        require_once "./views/admin/EditAdmin.php";
    }

    // Cập nhật thông tin admin
    public function update($MaAdmin) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_admin'])) {
            $HoTen = $_POST['HoTen'] ?? null;
            $Email = $_POST['Email'] ?? null;
            $DienThoai = $_POST['DienThoai'] ?? null;

            if (!$HoTen || !$Email || !$DienThoai) {
                echo "Các trường không được để trống.";
                return;
            }

            $this->adminModel->update($MaAdmin, $HoTen, $Email, $DienThoai);
            header("location:?act=admin");
        } else {
            echo "Yêu cầu không hợp lệ.";
        }
    }

    // Xóa admin
    public function delete($MaAdmin) {
        $this->adminModel->delete($MaAdmin);
        header("location:?act=admin");
    }



    // Hiển thị form đăng nhập
    public function loginForm() {
        $error = $_GET['error'] ?? null; // Nhận lỗi (nếu có)
        require_once './views/admin/login.php';
    }

    // Xử lý đăng nhập
    public function login() {
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        if (!$email || !$password) {
            header("Location: ?act=admin/loginForm&error=Vui lòng nhập đầy đủ thông tin!");
            exit;
        }

        // Kiểm tra tài khoản qua model
        $admin = $this->adminModel->getAdminByEmailAndPassword($email, $password);

        if ($admin && $admin['MaQuyen'] == 1) { // Xác nhận quyền admin
            $_SESSION['MaAdmin'] = $admin['MaAdmin'];
            $_SESSION['HoTen'] = $admin['HoTen'];
            $_SESSION['MaQuyen'] = $admin['MaQuyen'];

            header("Location: ?act=/"); // Chuyển hướng về dashboard
        } else {
            header("Location: ?act=admin/loginForm&error=Thông tin đăng nhập không chính xác!");
        }
    }

    // Đăng xuất
    public function logout() {
        session_destroy();
        header("Location: ?act=admin/loginForm");
        exit;
    }

}
