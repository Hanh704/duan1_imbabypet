<?php
class AdminDonHangController
{
    public $modelDonHang;
    public function __construct()
    {
        $this->modelDonHang = new AdminDonHang();
    }
    public function danhSachDonHang()

    {
        $listDonHang = $this->modelDonHang->getAllDonHang();
        require_once './views/donhang/listDonHang.php';
    }
   
public function detailDonHang(){

   $don_hang_id = $_GET['id_don_hang'];
   $donHang = $this->modelDonHang->getDetailDonHang($don_hang_id);

   $sanPhamDonHang = $this->modelDonHang->getListSpDonHang($don_hang_id);


   $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();
  

   require_once './views/donhang/detailKhachHang.php';
}
   

    public function formEditDonHang()   
    {
        // hiện thị from nhập
        $id = $_GET['id_don_hang'];
        $donHang = $this->modelDonHang->getDetailDonHang($id);

        $listTrangThaiDonHang= $this->modelDonHang->getAllTrangThaiDonHang();

       
        if ($donHang) {
            require_once './views/donhang/editDonHang.php';
            deleteSessionError();
        } else {
            header("Location:" . BASE_URL_ADMIN . '?act=don-hang');
            exit();
        }
        // require_once './views/sanpham/editSanPham.php';
    }

    public function postEditDonHang()
    {
        // xử lí thêm dữ liệu
        // kiểm tra dữ liệu có đc submit lên không

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $don_hang_id = $_POST['don_hang_id'] ?? ' ';
         

            $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'] ?? ' ';
            $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'] ?? ' ';
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'] ?? ' ';
            $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'] ?? ' ';
            $ghi_chu = $_POST['ghi_chu'] ?? ' ';
            $trang_thai_id = $_POST['trang_thai_id'] ?? ' ';
  
            $errors = [];
            if (empty($ten_nguoi_nhan)) {
                $errors['ten_nguoi_nhan'] = 'Vui lòng nhập không bỏ trống ';
            }
            if (empty($sdt_nguoi_nhan)) {
                $errors['sdt_nguoi_nhan'] = 'Vui lòng nhập không bỏ trống ';
            }
            if (empty($email_nguoi_nhan)) {
                $errors['email_nguoi_nhan'] = 'Vui lòng nhập không bỏ trống ';
            }
            if (empty($dia_chi_nguoi_nhan)) {
                $errors['dia_chi_nguoi_nhan'] = 'Vui lòng nhập không bỏ trống ';
            }
            if (empty($ghi_chu)) {
                $errors['ghi_chu'] = 'Vui lòng nhập không bỏ trống ';
            }
            if (empty($trang_thai_id)) {
                $errors['trang_thai_id'] = 'Vui lòng phải chọn trạng thái ';
            }
            
            $_SESSION['error'] = $errors;
           
              
            if (empty($errors)) {
         $abc = $this->modelDonHang->updateDonHang($don_hang_id,$ten_nguoi_nhan, $sdt_nguoi_nhan, $email_nguoi_nhan, $dia_chi_nguoi_nhan, $ghi_chu, $trang_thai_id);

          
                header("Location:" . BASE_URL_ADMIN . '?act=don-hang');
                exit();
            } else {
                // require_once './views/sanpham/addSanPham.php';
                $_SESSION['flash']= true;
                header("Location:" . BASE_URL_ADMIN . '?act=from-sua-don-hang&id_don_hang=' . $don_hang_id);
                exit();
            }
        }
    }

//     public function postEditAnhSanPham(){

//         if($_SERVER['REQUEST_METHOD'] == 'POST'){
//             $san_pham_id = $_POST['san_pham_id'] ?? '';
//             $listAnhSanPhamCurrent = $this->modelSanPham->getListAnhSanPham($san_pham_id);
//             $img_array= $_FILES['img_array'];
//             $img_delete = isset($_POST['img_delete'] )? explode(',', $_POST['img_delete']) : [];
//             $current_img_ids = $_POST['current_img_ids'] ?? [];
//             $upload_file =[];
//             foreach($img_array['name'] as $key => $value){
//                 if($img_array['error'][$key] == UPLOAD_ERR_OK){
//                     $new_file = uploadFileAlbum($img_array, './uploads/', $key);
//                     if($new_file){
//                         $upload_file[] = [
//                             'id' => $current_img_ids[$key] ?? null,
//                             'file'=> $new_file
//                         ];
//                     }
//                     }

//         }
        
        
//         foreach($upload_file as $file_info){
//             if($file_info['id']){
//                 $old_file = $this->modelSanPham-> getDetailAnhSanPham($file_info['id'])['link_hinh_anh'];

//                 $this->modelSanPham->updateAnhSanPham($file_info['id'], $file_info['file']);

//                 deleteFile($old_file);
//             }else{

//                 $this->modelSanPham->insertAlbumAnhSanPham($san_pham_id, $file_info['file']);


//             }
            
//         }
//         foreach($listAnhSanPhamCurrent as $anhSP){
//             $anh_id = $anhSP['id'];
//             if(in_array($anh_id, $img_delete)){

//                 $this->modelSanPham->destroyAnhSanPham($anh_id);

//                 deleteFile($anhSP['link_hinh_anh']);
//             }
            
//         }
//         header("Location:" . BASE_URL_ADMIN . '?act=from-sua-san-pham&id_san_pham=' . $san_pham_id);
//         exit();
//     }
    
//     }

//  public function deleteSanPham(){
//             $id = $_GET['id_san_pham'];
//             $sanPham = $this -> modelSanPham -> getDetailSanPham($id);
//             $listAnhSanPham = $this -> modelSanPham -> getListAnhSanPham($id);
//             if($sanPham){
//                 deleteFile($sanPham['hinh_anh']);

//                 $this -> modelSanPham -> destroySanPham($id);

//     }
//     if ($listAnhSanPham) {
//         foreach ($listAnhSanPham as $key => $anhSP) {
//             deleteFile($anhSP['link_hinh_anh']);
//             $this -> modelSanPham -> destroyAnhSanPham($listAnhSanPham['id']);
//         }
//     }

//             header("Location:". BASE_URL_ADMIN . '?act=san-pham');
//             exit();
//         }



//         public function detailSanPham()
//     {
//         // hiện thị from nhập
//         $id = $_GET['id_san_pham'];
//         $sanPham = $this->modelSanPham->getDetailSanPham($id);

//         $listAnhSanPham= $this->modelSanPham->getListAnhSanPham($id);

//         // var_dump($danhMuc);
//         // die();
//         if ($sanPham) {
//             require_once './views/sanpham/detailSanPham.php';

//         } else {
//             header("Location:" . BASE_URL_ADMIN . '?act=san-pham');
//             exit();
//         }
//         // require_once './views/sanpham/editSanPham.php';
//     }



}
     


?>