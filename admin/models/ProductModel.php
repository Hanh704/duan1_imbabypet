<?php

    require_once '../commons/function.php';

    class ProductModel{
        private $conn;
        public function __construct()
        {
            $this->conn = connectDB();
        }

        public function getAllProducts(){
            $query = "SELECT * FROM SanPham";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchALl();
        }

        public function getProductByID($MaSP){
            try{
                $sql = "SELECT * FROM SanPham WHERE MaSP = $MaSP";
                $result = $this->conn->query($sql);
                return $result->fetch(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                echo "lỗi truy vấn connect" .$e->getMessage();
                return [];
            }
        }

        public function getAllCategories(){
            $query = "SELECT * FROM loai";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchALl();
        }

        public function getAllColors(){
            $query = "SELECT * FROM MauSac";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchALl();
        }

        public function getAllBrands(){
            $query = "SELECT * FROM ThuongHieu";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchALl();
        }

        public function update($TenSP, $DonGiaMua, $DonGiaBan, $MaLoai, $MaThuongHieu, $MaMauSac, $SoLuong, $HinhAnh, $MoTa, $TrangThai, $MaSP){
            try {
                // Kiểm tra dữ liệu đầu vào
                if (empty($TenSP) || empty($DonGiaMua) || empty($DonGiaBan) || empty($SoLuong) || empty($MoTa) || empty($MaLoai) || empty($MaMauSac) || empty($MaSP)) {
                    throw new Exception("Thiếu dữ liệu Model. Vui lòng kiểm tra lại.");
                }
                $sql = "UPDATE SanPham SET 
                        TenSP = ?,
                        DonGiaMua = ?,
                        DonGiaBan = ?,
                        MaLoai = ?,
                        MaThuongHieu = ?,
                        MaMauSac = ?,
                        SoLuong = ?,
                        HinhAnh = ?,
                        MoTa = ?,
                        AnHien = ?
                        WHERE MaSP = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$TenSP, $DonGiaMua, $DonGiaBan, $MaLoai, $MaThuongHieu, $MaMauSac, $SoLuong, $HinhAnh, $MoTa, $TrangThai, $MaSP]);
            } catch (Exception $e) {
                echo "Lỗi: " . $e->getMessage();
            }
        }

        public function create($TenSP, $DonGiaMua, $DonGiaBan, $MaLoai, $MaThuongHieu, $MaMauSac, $SoLuong, $HinhAnh, $MoTa, $TrangThai){
            $sql = "INSERT INTO SanPham (TenSP, DonGiaMua, DonGiaBan, MaLoai, MaThuongHieu, MaMauSac, SoLuong, HinhAnh, MoTa, AnHien ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$TenSP, $DonGiaMua, $DonGiaBan, $MaLoai, $MaThuongHieu, $MaMauSac, $SoLuong, $HinhAnh, $MoTa, $TrangThai]);
        }

        public function delete($MaSP){
            $sql = "DELETE FROM SanPham WHERE MaSP = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$MaSP]);
        }

        public function getProductByCategory($MaLoai){
            $sql = "SELECT * FROM SanPham WHERE MaLoai = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$MaLoai]);
            return $stmt->fetchALl();
        }



        
    }


?>