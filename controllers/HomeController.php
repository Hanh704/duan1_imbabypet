<?php

class HomeController
{
    public $modelSanPham;
    public $modelTaiKhoan;
    public $modelGioHang;
    public $modelDonHang;
    public function __construct()
    {
        $this->modelSanPham = new SanPham();
        $this->modelTaiKhoan = new TaiKhoan();
        $this->modelGioHang = new GioHang();
        $this->modelDonHang = new DonHang();
    }
    public function home()
    {
        $listSanPham = $this->modelSanPham->getAllSanPham();
        require_once './views/home.php';
    }

    public function danhsachsanpham()
    {
        // echo" Danh sách sản phẩm";
        $listProduct = $this->modelSanPham->getAllProduct();
        require_once './views/listProduct.php';
        // var_dump($listProduct);die();
    }

    public function chiTietSanPham()
    {
        $id = $_GET['id_san_pham'];
        $sanPham = $this->modelSanPham->getDetailSanPham($id);

        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);

        $listBinhLuan = $this->modelSanPham->getBinhLuanFromSanPham($id);

        $listSanPhamCungDanhMuc = $this->modelSanPham->getListSanPhamCungDanhMuc($sanPham['danh_muc_id']);

        // var_dump($danhMuc);
        // die();
        if ($sanPham) {
            require_once './views/detailSanPham.php';
        } else {
            header("Location:" . BASE_URL);
            exit();
        }
    }


    public function fromLogin()
    {

        require_once './views/auth/fromLogin.php';

        deleteSessionError();

        exit();
    }

    public function postLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->modelTaiKhoan->checkLogin($email, $password);
            if ($user == $email) {
                $_SESSION['user_client'] = $user;
                header("Location:" . BASE_URL);
                exit();
            } else {
                $_SESSION['error'] = $user;
                // var_dump($_SESSION['error']);
                // die();
                $_SESSION['flash'] = true;
                header("Location:" . BASE_URL . '?act=login');
                exit();
            }
        }
    }

    public function addGioHang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_SESSION['user_client'])) {
                $mail = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);

                $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);

                if (!$gioHang) {
                   $gioHang=  $this->modelGioHang->addGioHang($mail['id']);
                   $gioHang= ['id' => $gioHang];
                }else{
                    $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
                   
                }

                $san_pham_id = $_POST['san_pham_id'];  
               
                $soLuong = $_POST['so_luong'];

                $checkSanPham = false;

              foreach ($chiTietGioHang as  $detail) {
                if($detail['san_pham_id'] == $san_pham_id){
                $newSoLuong = $detail['so_luong'] + $soLuong;
                $this->modelGioHang->updateSoLuong($gioHang['id'],$san_pham_id,$newSoLuong);
                $checkSanPham = true;
                break;
                }
              

              }
              if(!$checkSanPham){

                $this->modelGioHang->addDetailGioHang($gioHang['id'], $san_pham_id, $soLuong);
              }
            header("Location:" . BASE_URL . '?act=gio-hang');
            } else {
                var_dump('Chưa đăng nhập ');
                die();
            }
        }
    }

    public function gioHang(){
        if (isset($_SESSION['user_client'])) {
            $mail = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);

            $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);

            if (!$gioHang) {
               $gioHang=  $this->modelGioHang->addGioHang($mail['id']);
               $gioHang= ['id' => $gioHang];
               $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);

            }else{
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
               
            }
         
            require_once './views/gioHang.php';
        } else {
           header("Location:" . BASE_URL . '?act=login');
        }

    }

    public function thanhToan(){
        if (isset($_SESSION['user_client'])) {
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);

            $gioHang = $this->modelGioHang->getGioHangFromUser($user['id']);

            if (!$gioHang) {
               $gioHang=  $this->modelGioHang->addGioHang($user['id']);
               $gioHang= ['id' => $gioHang];
               $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);

            }else{
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
               
            }
         
            require_once './views/thanhToan.php';
        } else {
            var_dump('Chưa đăng nhập ');
            die();
        }
        require_once './views/thanhToan.php';
    }
    public function postThanhToan(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'];
        $email_nguoi_nhan = $_POST['email_nguoi_nhan'];
        $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'];
        $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'];
       
        $ghi_chu = $_POST['ghi_chu'];
        $tong_tien= $_POST['tong_tien'];
        $phuong_thuc_thanh_toan_id = $_POST['phuong_thuc_thanh_toan_id'];
        $ngay_dat = date('Y-m-d');
        
       $trang_thai_id = 1;
       $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
       $tai_khoan_id = $user['id'];
       $ma_don_hang= 'WAD-' . rand(1000, 9999);

       $this->modelDonHang->addDonHang($tai_khoan_id,
       $ten_nguoi_nhan,
       $email_nguoi_nhan,
       $sdt_nguoi_nhan,
       $dia_chi_nguoi_nhan,
       $ghi_chu,
       $tong_tien,
       $phuong_thuc_thanh_toan_id,
       $ngay_dat,
       $trang_thai_id,
       $ma_don_hang
       );


// var_dump('Thêm thành công');
// die();

        }
    }
}
