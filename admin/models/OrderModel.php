<?php

class OrderModel {
    private $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    // Lấy danh sách tất cả đơn hàng
    public function getAllOrders() {
        $sql = "SELECT MaDH, MaKH, NgayDat, NgayGiao, TinhTrangDH, DaThanhToan, TongTien FROM DonDatHang";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll();
    }

    // Lấy thông tin đơn hàng theo ID
    public function getOrderById($MaDH) {
        $sql = "SELECT MaDH, MaKH, NgayDat, NgayGiao, TinhTrangDH, DaThanhToan, TongTien FROM DonDatHang WHERE MaDH = :MaDH";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':MaDH' => $MaDH]);
        return $stmt->fetch();
    }

    // Lấy chi tiết đơn hàng theo ID
    // public function getOrderDetailsById($MaDH) {
    //     try {
    //         // Chuẩn bị câu lệnh SQL
    //         $sql = "SELECT * FROM CTDonHang WHERE MaDH = :MaDH";
    //         $stmt = $this->conn->prepare($sql);
    
    //         // Thực thi câu lệnh với tham số
    //         $stmt->execute([':MaDH' => $MaDH]);
    
    //         // Kiểm tra nếu có dữ liệu, trả về kết quả
    //         $orderDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);

    
    //         // Nếu không có dữ liệu, trả về mảng rỗng
    //         if (empty($orderDetails)) {
    //             return [];
    //         }
    
    //         return $orderDetails;
    
    //     } catch (PDOException $e) {
    //         // Xử lý lỗi, ghi log hoặc hiển thị thông báo lỗi nếu cần thiết
    //         error_log("Error fetching order details: " . $e->getMessage());
    //         return [];
    //     }
    // }

    public function getOrderDetailsById($MaDH) {
        $sql = "SELECT 
                    CTDonHang.MaSP, 
                    CTDonHang.SoLuong, 
                    CTDonHang.DonGia, 
                    CTDonHang.ThanhTien, 
                    SanPham.TenSP, 
                    SanPham.HinhAnh
                FROM 
                    CTDonHang
                INNER JOIN 
                    SanPham ON CTDonHang.MaSP = SanPham.MaSP
                WHERE 
                    CTDonHang.MaDH = :MaDH";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':MaDH' => $MaDH]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Xóa đơn hàng
    public function deleteOrder($MaDH) {
        try {
            $this->conn->beginTransaction();

            // Xóa chi tiết đơn hàng trước
            $sql1 = "DELETE FROM CTDonHang WHERE MaDH = :MaDH";
            $stmt1 = $this->conn->prepare($sql1);
            $stmt1->execute([':MaDH' => $MaDH]);

            // Xóa đơn hàng
            $sql2 = "DELETE FROM DonDatHang WHERE MaDH = :MaDH";
            $stmt2 = $this->conn->prepare($sql2);
            $stmt2->execute([':MaDH' => $MaDH]);

            $this->conn->commit();
        } catch (PDOException $e) {
            $this->conn->rollBack();
            die("Lỗi khi xóa đơn hàng: " . $e->getMessage());
        }
    }

    public function updateOrderStatus($MaDH, $TinhTrangDH) {
        $sql = "UPDATE DonDatHang SET TinhTrangDH = :TinhTrangDH WHERE MaDH = :MaDH";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':TinhTrangDH' => $TinhTrangDH,
            ':MaDH' => $MaDH
        ]);
    }
}
