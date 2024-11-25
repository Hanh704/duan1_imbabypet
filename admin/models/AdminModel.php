<?php

class AdminModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy tất cả admin
    public function getAllAdmins()
    {
        $sql = "SELECT * FROM Admin";
        return $this->conn->query($sql)->fetchAll();
    }

    // Lấy thông tin admin theo ID
    public function getAdminById($MaAdmin)
    {
        try {
            $sql = "SELECT * FROM Admin WHERE MaAdmin = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$MaAdmin]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Lỗi truy vấn: " . $e->getMessage();
            return [];
        }
    }

    // Tạo admin mới
    public function create($data)
    {
        $sql = "INSERT INTO Admin (HoTen, DiaChi, DienThoai, Email, MatKhau, Avatar) 
                VALUES (:HoTen, :DiaChi, :DienThoai, :Email, :MatKhau, :Avatar)";
        $this->conn->query($sql, $data);
    }

    // Cập nhật thông tin admin
    public function update($MaAdmin, $data)
    {
        $data['MaAdmin'] = $MaAdmin;
        $sql = "UPDATE Admin SET 
                HoTen = :HoTen, 
                DiaChi = :DiaChi, 
                DienThoai = :DienThoai, 
                Email = :Email, 
                MatKhau = IF(:MatKhau IS NOT NULL, :MatKhau, MatKhau),
                Avatar = IF(:Avatar IS NOT NULL, :Avatar, Avatar) 
                WHERE MaAdmin = :MaAdmin";
        $this->conn->query($sql, $data);
    }

    // Xóa admin
    public function delete($MaAdmin)
    {
        $sql = "DELETE FROM Admin WHERE MaAdmin = ?";
        $this->conn->query($sql, [$MaAdmin]);
    }

    // public function getRules($MaQuyen){
     //     $sql = "SELECT * FROM PhanQuyen WHERE MaQuyen = ?";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->execute([$MaQuyen]);
    //     return $stmt->fetch(PDO::FETCH_ASSOC);
    // }


    public function getAdminByEmailAndPassword($email, $password) {
        $sql = "SELECT * FROM admin WHERE Email = ? AND MatKhau = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email, $password]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
