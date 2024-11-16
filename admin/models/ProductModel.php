<?php

    require_once '../commons/function.php';

    class ProductModel{
        private $conn;
        public function __construct()
        {
            $this->conn = connectDB();
        }

            //hàm lấy danh sách sản phẩm

        public function getAllProducts(){
            $query = "SELECT * FROM sanpham";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchALl();
        }



        
    }


?>