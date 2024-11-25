-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th10 22, 2024 lúc 12:49 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ImBabyPetDA1`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `Admin`
--

CREATE TABLE `Admin` (
  `MaAdmin` int(11) NOT NULL,
  `HoTen` varchar(50) NOT NULL,
  `DiaChi` varchar(255) NOT NULL,
  `DienThoai` varchar(20) NOT NULL,
  `TenLoai` varchar(20) NOT NULL,
  `TenOn` varchar(50) NOT NULL,
  `MatKhau` varchar(100) NOT NULL,
  `Avatar` varchar(255) NOT NULL,
  `Email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `Admin`
--

INSERT INTO `Admin` (`MaAdmin`, `HoTen`, `DiaChi`, `DienThoai`, `TenLoai`, `TenOn`, `MatKhau`, `Avatar`, `Email`) VALUES
(1, 'Nguyen Van A', '123 Main St', '0123456789', 'SuperAdmin', 'AdminA', 'pass123', '/images/avatar1.png', 'admina@example.com'),
(2, 'Tran Thi B', '456 Elm St', '0987654321', 'Manager', 'AdminB', 'pass456', '/images/avatar2.png', 'adminb@example.com'),
(3, 'Le Van C', '789 Oak St', '0345678912', 'Staff', 'AdminC', 'pass789', '/images/avatar3.png', 'adminc@example.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ChiTietGioHang`
--

CREATE TABLE `ChiTietGioHang` (
  `MaGioHang` int(11) NOT NULL,
  `MaSP` int(11) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `DonGia` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ChiTietGioHang`
--

INSERT INTO `ChiTietGioHang` (`MaGioHang`, `MaSP`, `SoLuong`, `DonGia`) VALUES
(1, 2, 1, 300.00),
(2, 3, 1, 700.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `CTDonHang`
--

CREATE TABLE `CTDonHang` (
  `MaDH` int(11) NOT NULL,
  `MaSP` int(11) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `DonGia` decimal(10,2) NOT NULL,
  `ThanhTien` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `CTDonHang`
--

INSERT INTO `CTDonHang` (`MaDH`, `MaSP`, `SoLuong`, `DonGia`, `ThanhTien`) VALUES
(2, 2, 1, 300.00, 300.00),
(3, 3, 1, 400.00, 400.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `DonDatHang`
--

CREATE TABLE `DonDatHang` (
  `MaDH` int(11) NOT NULL,
  `MaKH` int(11) NOT NULL,
  `NgayDat` date NOT NULL,
  `NgayGiao` date NOT NULL,
  `TinhTrangDH` varchar(20) NOT NULL,
  `DaThanhToan` tinyint(1) NOT NULL,
  `TongTien` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `DonDatHang`
--

INSERT INTO `DonDatHang` (`MaDH`, `MaKH`, `NgayDat`, `NgayGiao`, `TinhTrangDH`, `DaThanhToan`, `TongTien`) VALUES
(1, 1, '2024-11-20', '2024-11-25', 'Pending', 0, 300.00),
(2, 2, '2024-11-19', '2024-11-24', 'Shipped', 1, 400.00),
(3, 3, '2024-11-18', '2024-11-23', 'Delivered', 1, 500.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `GiamGia`
--

CREATE TABLE `GiamGia` (
  `MaGG` int(11) NOT NULL,
  `TenGG` varchar(100) NOT NULL,
  `PhanTramGiam` int(11) NOT NULL,
  `NgayBatDau` date NOT NULL,
  `NgayKetThuc` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `GiamGia`
--

INSERT INTO `GiamGia` (`MaGG`, `TenGG`, `PhanTramGiam`, `NgayBatDau`, `NgayKetThuc`) VALUES
(1, 'Giảm giá Black Friday', 30, '2024-11-01', '2024-11-30'),
(2, 'Giảm giá Giáng Sinh', 50, '2024-12-01', '2024-12-25'),
(3, 'Giảm giá Tết', 20, '2025-01-01', '2025-01-20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `GioHang`
--

CREATE TABLE `GioHang` (
  `MaGioHang` int(11) NOT NULL,
  `MaKH` int(11) NOT NULL,
  `NgayTao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `GioHang`
--

INSERT INTO `GioHang` (`MaGioHang`, `MaKH`, `NgayTao`) VALUES
(1, 1, '2024-11-01'),
(2, 2, '2024-11-02'),
(3, 3, '2024-11-03');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `Hinh`
--

CREATE TABLE `Hinh` (
  `MaHinh` int(11) NOT NULL,
  `TenHinh` varchar(255) NOT NULL,
  `DuongDan` varchar(255) NOT NULL,
  `MaSP` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `Hinh`
--

INSERT INTO `Hinh` (`MaHinh`, `TenHinh`, `DuongDan`, `MaSP`) VALUES
(3, 'Shoes Side', '/images/shoes_side.png', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `KhachHang`
--

CREATE TABLE `KhachHang` (
  `MaKH` int(11) NOT NULL,
  `HoTen` varchar(100) NOT NULL,
  `DiaChi` varchar(255) NOT NULL,
  `DienThoai` varchar(20) NOT NULL,
  `Email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `KhachHang`
--

INSERT INTO `KhachHang` (`MaKH`, `HoTen`, `DiaChi`, `DienThoai`, `Email`) VALUES
(1, 'Nguyen Thi D', '123 Pham Van Dong', '0123456789', 'nguyenthid@example.com'),
(2, 'Tran Van E', '45 Nguyen Trai', '0987654321', 'tranvane@example.com'),
(3, 'Le Thi F', '78 Le Loi', '0345678912', 'lethif@example.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `KichThuoc`
--

CREATE TABLE `KichThuoc` (
  `MaKichThuoc` int(11) NOT NULL,
  `TenKichThuoc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `KichThuoc`
--

INSERT INTO `KichThuoc` (`MaKichThuoc`, `TenKichThuoc`) VALUES
(1, 'Small'),
(2, 'Medium'),
(3, 'Large');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `Loai`
--

CREATE TABLE `Loai` (
  `MaLoai` int(11) NOT NULL,
  `TenLoai` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `Loai`
--

INSERT INTO `Loai` (`MaLoai`, `TenLoai`) VALUES
(1, 'Thời trang nam'),
(2, 'Thời trang nữ'),
(4, 'Phụ kiện cho chó'),
(5, 'Phụ kiện cho mèo'),
(6, 'Đồ ăn cho mèo'),
(7, 'Đồ ăn cho chó');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `MauSac`
--

CREATE TABLE `MauSac` (
  `MaMauSac` int(11) NOT NULL,
  `TenMau` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `MauSac`
--

INSERT INTO `MauSac` (`MaMauSac`, `TenMau`) VALUES
(1, 'Red'),
(2, 'Green'),
(3, 'Blue'),
(4, 'Yellow'),
(5, 'Black'),
(6, 'White'),
(7, 'Purple'),
(8, 'Đỏ'),
(9, 'Xanh'),
(10, 'Vàng'),
(11, 'Trắng'),
(12, 'Đen'),
(13, 'Hồng'),
(14, 'Tím');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `PhanQuyen`
--

CREATE TABLE `PhanQuyen` (
  `MaQuyen` int(11) NOT NULL,
  `TenQuyen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `PhanQuyen`
--

INSERT INTO `PhanQuyen` (`MaQuyen`, `TenQuyen`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Manager');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `PhieuNhapKho`
--

CREATE TABLE `PhieuNhapKho` (
  `MaPN` int(11) NOT NULL,
  `NgayNhap` date NOT NULL,
  `TongTien` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `PhieuNhapKho`
--

INSERT INTO `PhieuNhapKho` (`MaPN`, `NgayNhap`, `TongTien`) VALUES
(1, '2024-11-10', 1000.00),
(2, '2024-11-15', 2000.00),
(3, '2024-11-20', 1500.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `SanPham`
--

CREATE TABLE `SanPham` (
  `MaSP` int(11) NOT NULL,
  `TenSP` varchar(100) NOT NULL,
  `DonGiaMua` bigint(20) NOT NULL,
  `DonGiaBan` bigint(20) NOT NULL,
  `MaLoai` int(11) NOT NULL,
  `MaMauSac` int(11) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `MaThuongHieu` int(11) NOT NULL,
  `HinhAnh` varchar(255) NOT NULL,
  `MoTa` text NOT NULL,
  `AnHien` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `SanPham`
--

INSERT INTO `SanPham` (`MaSP`, `TenSP`, `DonGiaMua`, `DonGiaBan`, `MaLoai`, `MaMauSac`, `SoLuong`, `MaThuongHieu`, `HinhAnh`, `MoTa`, `AnHien`) VALUES
(2, 'Shoes', 150, 300, 2, 2, 15, 2, 'assets/images/673fe7929c279-vn-11134207-7r98o-lwdt4u1b0t7d40.jpeg', 'Green running shoes.', 1),
(3, 'Jacket', 200, 400, 3, 3, 10, 3, '/images/jacket.png', 'Blue waterproof jacket.', 1),
(5, 'dương test 2', 444, 44444, 1, 10, 65, 2, 'assets/images/673f706b7fd6b-vn-11134201-7r98o-lq1w4j9hoe2fd0.jpeg', '', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ThuongHieu`
--

CREATE TABLE `ThuongHieu` (
  `MaThuongHieu` int(11) NOT NULL,
  `TenThuongHieu` varchar(100) NOT NULL,
  `XuatXu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ThuongHieu`
--

INSERT INTO `ThuongHieu` (`MaThuongHieu`, `TenThuongHieu`, `XuatXu`) VALUES
(1, 'Nike', 'USA'),
(2, 'Adidas', 'Germany'),
(3, 'Gucci', 'Italy');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`MaAdmin`);

--
-- Chỉ mục cho bảng `ChiTietGioHang`
--
ALTER TABLE `ChiTietGioHang`
  ADD PRIMARY KEY (`MaGioHang`,`MaSP`),
  ADD KEY `MaSP` (`MaSP`);

--
-- Chỉ mục cho bảng `CTDonHang`
--
ALTER TABLE `CTDonHang`
  ADD PRIMARY KEY (`MaDH`,`MaSP`),
  ADD KEY `MaSP` (`MaSP`);

--
-- Chỉ mục cho bảng `DonDatHang`
--
ALTER TABLE `DonDatHang`
  ADD PRIMARY KEY (`MaDH`);

--
-- Chỉ mục cho bảng `GiamGia`
--
ALTER TABLE `GiamGia`
  ADD PRIMARY KEY (`MaGG`);

--
-- Chỉ mục cho bảng `GioHang`
--
ALTER TABLE `GioHang`
  ADD PRIMARY KEY (`MaGioHang`),
  ADD KEY `MaKH` (`MaKH`);

--
-- Chỉ mục cho bảng `Hinh`
--
ALTER TABLE `Hinh`
  ADD PRIMARY KEY (`MaHinh`),
  ADD KEY `MaSP` (`MaSP`);

--
-- Chỉ mục cho bảng `KhachHang`
--
ALTER TABLE `KhachHang`
  ADD PRIMARY KEY (`MaKH`);

--
-- Chỉ mục cho bảng `KichThuoc`
--
ALTER TABLE `KichThuoc`
  ADD PRIMARY KEY (`MaKichThuoc`);

--
-- Chỉ mục cho bảng `Loai`
--
ALTER TABLE `Loai`
  ADD PRIMARY KEY (`MaLoai`);

--
-- Chỉ mục cho bảng `MauSac`
--
ALTER TABLE `MauSac`
  ADD PRIMARY KEY (`MaMauSac`);

--
-- Chỉ mục cho bảng `PhanQuyen`
--
ALTER TABLE `PhanQuyen`
  ADD PRIMARY KEY (`MaQuyen`);

--
-- Chỉ mục cho bảng `PhieuNhapKho`
--
ALTER TABLE `PhieuNhapKho`
  ADD PRIMARY KEY (`MaPN`);

--
-- Chỉ mục cho bảng `SanPham`
--
ALTER TABLE `SanPham`
  ADD PRIMARY KEY (`MaSP`),
  ADD KEY `MaMauSac` (`MaMauSac`);

--
-- Chỉ mục cho bảng `ThuongHieu`
--
ALTER TABLE `ThuongHieu`
  ADD PRIMARY KEY (`MaThuongHieu`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `Admin`
--
ALTER TABLE `Admin`
  MODIFY `MaAdmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `DonDatHang`
--
ALTER TABLE `DonDatHang`
  MODIFY `MaDH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `GiamGia`
--
ALTER TABLE `GiamGia`
  MODIFY `MaGG` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `GioHang`
--
ALTER TABLE `GioHang`
  MODIFY `MaGioHang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `Hinh`
--
ALTER TABLE `Hinh`
  MODIFY `MaHinh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `KhachHang`
--
ALTER TABLE `KhachHang`
  MODIFY `MaKH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `KichThuoc`
--
ALTER TABLE `KichThuoc`
  MODIFY `MaKichThuoc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `Loai`
--
ALTER TABLE `Loai`
  MODIFY `MaLoai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `MauSac`
--
ALTER TABLE `MauSac`
  MODIFY `MaMauSac` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `PhanQuyen`
--
ALTER TABLE `PhanQuyen`
  MODIFY `MaQuyen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `PhieuNhapKho`
--
ALTER TABLE `PhieuNhapKho`
  MODIFY `MaPN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `SanPham`
--
ALTER TABLE `SanPham`
  MODIFY `MaSP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `ThuongHieu`
--
ALTER TABLE `ThuongHieu`
  MODIFY `MaThuongHieu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `ChiTietGioHang`
--
ALTER TABLE `ChiTietGioHang`
  ADD CONSTRAINT `chitietgiohang_ibfk_1` FOREIGN KEY (`MaGioHang`) REFERENCES `GioHang` (`MaGioHang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chitietgiohang_ibfk_2` FOREIGN KEY (`MaSP`) REFERENCES `SanPham` (`MaSP`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `CTDonHang`
--
ALTER TABLE `CTDonHang`
  ADD CONSTRAINT `ctdonhang_ibfk_1` FOREIGN KEY (`MaDH`) REFERENCES `DonDatHang` (`MaDH`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ctdonhang_ibfk_2` FOREIGN KEY (`MaSP`) REFERENCES `SanPham` (`MaSP`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `GioHang`
--
ALTER TABLE `GioHang`
  ADD CONSTRAINT `giohang_ibfk_1` FOREIGN KEY (`MaKH`) REFERENCES `KhachHang` (`MaKH`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `Hinh`
--
ALTER TABLE `Hinh`
  ADD CONSTRAINT `hinh_ibfk_1` FOREIGN KEY (`MaSP`) REFERENCES `SanPham` (`MaSP`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `SanPham`
--
ALTER TABLE `SanPham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`MaMauSac`) REFERENCES `MauSac` (`MaMauSac`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
