<?php
function uploadFile($file) {
    if ($file['error'] === UPLOAD_ERR_OK) {
        // Kiểm tra kích thước tệp
        $maxFileSize = 5 * 1024 * 1024; // 5MB
        if ($file['size'] > $maxFileSize) {
            throw new Exception("Tệp tải lên quá lớn. Giới hạn kích thước là 5MB.");
        }

        // Kiểm tra loại tệp
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($file['type'], $allowedTypes)) {
            throw new Exception("Chỉ cho phép tải lên tệp hình ảnh (JPEG, PNG, GIF).");
        }

        // Đặt tên file mới để tránh trùng lặp
        $fileName = uniqid() . '-' . pathinfo($file['name'], PATHINFO_FILENAME) . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
        
        // Đường dẫn lưu file
        $uploadDir = __DIR__ . '/../assets/images/'; // Đường dẫn tuyệt đối đến admin/assets/images
        $uploadFilePath = $uploadDir . $fileName;

        // Kiểm tra quyền ghi thư mục
        if (!is_writable($uploadDir)) {
            throw new Exception("Thư mục không có quyền ghi: $uploadDir. Kiểm tra quyền truy cập.");
        }

        // Tạo thư mục nếu chưa tồn tại
        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0777, true) && !is_dir($uploadDir)) {
                throw new Exception("Không thể tạo thư mục $uploadDir. Kiểm tra quyền truy cập.");
            }
        }

        // Di chuyển file tải lên vào thư mục đích
        if (move_uploaded_file($file['tmp_name'], $uploadFilePath)) {
            return 'assets/images/' . $fileName; // Trả về đường dẫn tương đối cho ảnh
        } else {
            throw new Exception("Không thể tải lên tệp.");
        }
    } else {
        throw new Exception("Lỗi khi tải lên tệp. Mã lỗi: " . $file['error']);
    }
}
