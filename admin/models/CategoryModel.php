<?php

class CategoryModel {
    private $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    public function getAllCategories() {
        $query = "SELECT * FROM Loai";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategoryByID($MaLoai) {
        try {
            $sql = "SELECT * FROM Loai WHERE MaLoai = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$MaLoai]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Lỗi truy vấn: " . $e->getMessage();
            return [];
        }
    }

    public function create($TenLoai) {
        try {
            $sql = "INSERT INTO Loai (TenLoai) VALUES (?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$TenLoai]);
        } catch (PDOException $e) {
            echo "Lỗi tạo danh mục: " . $e->getMessage();
        }
    }

    public function update($MaLoai, $TenLoai) {
        try {
            $sql = "UPDATE Loai SET TenLoai = ? WHERE MaLoai = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$TenLoai, $MaLoai]);
        } catch (PDOException $e) {
            echo "Lỗi cập nhật danh mục: " . $e->getMessage();
        }
    }

    public function delete($MaLoai) {
        try {
            $sql = "DELETE FROM Loai WHERE MaLoai = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$MaLoai]);
        } catch (PDOException $e) {
            echo "Lỗi xóa danh mục: " . $e->getMessage();
        }
    }
}

?>
