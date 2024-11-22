<?php

require_once "./models/CategoryModel.php";
require_once "./models/ProductModel.php";

class CategoryController {
    public $categoryModel;
    public $ProductModel;

    function __construct()
    {
        $this->categoryModel = new CategoryModel();
        $this->ProductModel = new ProductModel();
    }

    public function index() {
        $categories = $this->categoryModel->getAllCategories();

            // Số sản phẩm hiển thị mỗi trang
            $perPage = 5;

            // Tổng số sản phẩm
            $totalCategories = count($categories);

    
            // Tính số trang
            $totalPages = ceil($totalCategories / $perPage);
    
            // Lấy trang hiện tại từ query string (mặc định là 1 nếu không có)
            $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $currentPage = max(1, min($totalPages, $currentPage));

            //index để hiển thị stt
            $index = ($currentPage - 1) * $perPage + 1; // Khởi tạo STT, dựa trên trang hiện tại
    
            // Tính chỉ số bắt đầu và kết thúc sản phẩm trên trang hiện tại
            $startIndex = ($currentPage - 1) * $perPage;
            $endIndex = min($startIndex + $perPage, $totalCategories);
    
            // Lấy danh sách sản phẩm cho trang hiện tại
            $categoriesOnPage = array_slice($categories, $startIndex, $perPage);
                

        require_once __DIR__ . '/../views/category/ListCategory.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_category'])) {
            $TenLoai = $_POST['TenLoai'] ?? null;

            if (!$TenLoai) {
                echo "Tên loại không được để trống.";
                return;
            }

            $this->categoryModel->create($TenLoai);
            header("location:?act=category");
        }
        require_once "./views/category/CreateCategory.php";
    }

    public function edit() {
        $MaLoai = $_GET['MaLoai'] ?? null;
        $category = $this->categoryModel->getCategoryByID($MaLoai);

        if (!$MaLoai || !$category) {
            echo "Không tìm thấy mã loại cho chỉnh sửa.";
            return;
        }

        require_once "./views/category/EditCategory.php";
    }

    public function update($MaLoai) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_category'])) {
            $TenLoai = $_POST['TenLoai'] ?? null;

            if (!$TenLoai) {
                echo "Tên loại không được để trống.";
                return;
            }

            $this->categoryModel->update($MaLoai, $TenLoai);
            header("location:?act=category");
        } else {
            echo "Yêu cầu không hợp lệ.";
        }
    }

    public function delete($MaLoai) {
        $this->categoryModel->delete($MaLoai);
        header("location:?act=category");
    }


    public function showProductByCategory($MaLoai){
        $products = $this->ProductModel->getProductByCategory($MaLoai);
            // Số sản phẩm hiển thị mỗi trang
            $perPage = 5;

            // Tổng số sản phẩm
            $totalProducts = count($products);
    
            // Tính số trang
            $totalPages = ceil($totalProducts / $perPage);
    
            // Lấy trang hiện tại từ query string (mặc định là 1 nếu không có)
            $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $currentPage = max(1, min($totalPages, $currentPage));
    
            // Tính chỉ số bắt đầu và kết thúc sản phẩm trên trang hiện tại
            $startIndex = ($currentPage - 1) * $perPage;
            $endIndex = min($startIndex + $perPage, $totalProducts);
    
            // Lấy danh sách sản phẩm cho trang hiện tại
            $productsOnPage = array_slice($products, $startIndex, $perPage);
            

        require_once "./views/product/ListProduct.php";
        

    }
}
