<?php

// Kết nối CSDL qua PDO
function connectDB() {
    // Kết nối CSDL
    $host = DB_HOST;
    $port = DB_PORT;
    $dbname = DB_NAME;

    try {
        $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", DB_USERNAME, DB_PASSWORD);

        // cài đặt chế độ báo lỗi là xử lý ngoại lệ
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // cài đặt chế độ trả dữ liệu
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
        return $conn;
    } catch (PDOException $e) {
        echo ("Connection failed: " . $e->getMessage());
    }
}

function uploadFile($file, $folderUploat) {
 $pathStorage = $folderUploat.time() . $file['name'];
 $form = $file['tmp_name'];
 $to = PATH_ROOT . $pathStorage;
 if(move_uploaded_file($form, $to)) {
    return $pathStorage;
 }
 return null;
}
function deleteFile($path) {
    $pathDelete = PATH_ROOT . $path;
    if(file_exists($pathDelete)) {
        unlink($pathDelete);
    }
}

function deleteSessionError() {
    if(isset($_SESSION['flash'])) {
        unset($_SESSION['flash']);
        unset($_SESSION['error']);

        // session_unset();
        // session_destroy();
    }

    
}

function uploadFileAlbum($file, $folderUploat,$key) {
    $pathStorage = $folderUploat.time(). $file['name'][$key];
    $form = $file['tmp_name'][$key];
    $to = PATH_ROOT . $pathStorage;
    if(move_uploaded_file($form, $to)) {
       return $pathStorage;
    }
    return null;
   }

   function checkLoginAdmin() {
    if(!isset($_SESSION['user_admin'])) {
       require_once './views/auth/formLogin.php';
        exit();
    }


   }


   function formatPrice($price) {
    
    return number_format($price, 0, '', '.');
   }
   