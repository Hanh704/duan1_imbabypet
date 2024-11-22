<?php

require_once "./models/ProductModel.php";
require_once "./commons/helper.php";

class ProductController {
    public $productModel;

    function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function index() {
        $products = $this->productModel->getAllProducts();

        require_once __DIR__ . '/../views/product/listProduct.php';
    }

    public function create(){
        $colors = $this->productModel->getAllColors();
        $categories = $this->productModel->getAllCategories();
        $brands = $this->productModel->getAllBrands();

        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_product'])){
            $TenSP = $_POST['TenSP'] ?? null;
            $DonGiaMua = $_POST['DonGiaMua'] ?? null;
            $DonGiaBan = $_POST['DonGiaBan'] ?? null;
            $SoLuong = $_POST['SoLuong'] ?? null;
            $MaLoai = $_POST['MaLoai'] ?? null;
            $MaThuongHieu = $_POST['MaThuongHieu'] ?? null;
            $MaMauSac = $_POST['MaMauSac'] ?? null;
            $HinhAnh = uploadFile($_FILES['HinhAnh']);
            $MoTa = $_POST['MoTa'] ?? null;
            $TrangThai = $_POST['TrangThai'] ?? null;

            if (!$TenSP || !$DonGiaMua || !$DonGiaBan || !$SoLuong || !$MaThuongHieu || !$MaLoai || !$MaMauSac) {
                echo "Thiếu dữ liệu. Vui lòng kiểm tra lại.";
                if (!$TenSP) echo "Tên sản phẩm, ";
                if (!$DonGiaMua) echo "Giá mua, ";
                if (!$DonGiaBan) echo "Giá bán, ";
                if (!$SoLuong) echo "Số lượng, ";
                if (!$MaThuongHieu) echo "Mã thương hiệu, ";
                if (!$MaLoai) echo "Mã loại, ";
                if (!$MaMauSac) echo "Mã màu sắc.";
                return;
            }

            $this->productModel->create($TenSP, $DonGiaMua, $DonGiaBan, $MaLoai, $MaThuongHieu, $MaMauSac, $SoLuong, $HinhAnh, $MoTa, $TrangThai);
            header("location:?act=product");
        }
        require_once "./views/product/CreateProduct.php";
    }

    public function edit(){
        $MaSP = $_GET['MaSP'] ?? null;
        $product = $this->productModel->getProductByID($MaSP);
        $colors = $this->productModel->getAllColors();
        $categories = $this->productModel->getAllCategories();
        $brands = $this->productModel->getAllBrands();

        if(!$MaSP){
            echo "không tìm thấy mã sản phẩm cho chỉnh sửa";
            return;
        }

        require_once "./views/product/EditProduct.php";
    }

    public function update($MaSP){
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_product'])) {
            $TenSP = $_POST['TenSP'] ?? null;
            $DonGiaMua = $_POST['DonGiaMua'] ?? null;
            $DonGiaBan = $_POST['DonGiaBan'] ?? null;
            $SoLuong = $_POST['SoLuong'] ?? null;
            $MaLoai = $_POST['MaLoai'] ?? null;
            $MaThuongHieu = $_POST['MaThuongHieu'] ?? null;
            $MaMauSac = $_POST['MaMauSac'] ?? null;
            $HinhAnh = $_FILES['HinhAnh'] ?? null;
            $MoTa = $_POST['MoTa'] ?? null;
            $TrangThai = $_POST['TrangThai'] ?? null;

            if ($HinhAnh['size'] == 0) {
                $product = $this->productModel->getProductByID($MaSP);
                if ($product && isset($product['HinhAnh'])) {
                    $HinhAnh = $product['HinhAnh'];
                } else {
                    echo "Không tìm thấy sản phẩm để lấy hình ảnh.";
                    return;
                }
            } else {
                $HinhAnh = uploadFile($HinhAnh);
            }
    
            // Kiểm tra đầu vào
            if (!$MaSP || !$TenSP || !$DonGiaMua || !$DonGiaBan || !$HinhAnh || !$SoLuong || !$MoTa || !$MaLoai || !$MaMauSac) {
                echo "Thiếu dữ liệu. Vui lòng kiểm tra lại.";
                if (!$TenSP) echo "Tên sản phẩm, ";
                if (!$DonGiaMua) echo "Giá mua, ";
                if (!$DonGiaBan) echo "Giá bán, ";
                if (!$SoLuong) echo "Số lượng, ";
                if (!$MaThuongHieu) echo "Mã thương hiệu, ";
                if (!$MaLoai) echo "Mã loại, ";
                if (!$MaMauSac) echo "Mã màu sắc.";
                if (!$HinhAnh) echo "Hình ảnh.";
                if(!$MaSP) echo "Mã sản phẩm.";
                return;
            }
            // Cập nhật 
            $this->productModel->update($TenSP, $DonGiaMua, $DonGiaBan, $MaLoai, $MaThuongHieu, $MaMauSac, $SoLuong, $HinhAnh, $MoTa, $TrangThai, $MaSP);
    
            header("location:?act=product");
        } else {
            echo "Yêu cầu không hợp lệ.";
        }
    }

    function delete($MaSP){
        $this->productModel->delete($MaSP);
        header("location:?act=product");
    }

    
}