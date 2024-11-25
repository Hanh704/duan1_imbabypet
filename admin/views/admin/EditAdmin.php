<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Admin</title>
</head>
<body>
    <?php
        require_once "./views/layouts/includes/header_admin.php";
    ?>

    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Sửa Admin</h4>
            <a href="?act=admin/delete&MaAdmin=<?php echo $admin['MaAdmin']; ?>" class="btn btn-danger" onclick="return confirmDelete();">Xóa</a>
        </div>

        <div class="card-body">
            <form action="?act=admin/update&MaAdmin=<?php echo $admin['MaAdmin']; ?>" method="POST" enctype="multipart/form-data">
                
                <div class="mb-3">
                    <label for="HoTen" class="form-label">Họ và Tên</label>
                    <input type="text" class="form-control" id="HoTen" name="HoTen" value="<?php echo $admin['HoTen']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="DiaChi" class="form-label">Địa chỉ</label>
                    <input type="text" class="form-control" id="DiaChi" name="DiaChi" value="<?php echo $admin['DiaChi']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="DienThoai" class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control" id="DienThoai" name="DienThoai" value="<?php echo $admin['DienThoai']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="TenLoai" class="form-label">Tên Loại</label>
                    <input type="text" class="form-control" id="TenLoai" name="TenLoai" value="<?php echo $admin['TenLoai']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="TenQuyen" class="form-label">Quyền</label>
                    <select name="Rule" id="Rule" class="form-control">
                        <?php
                        foreach ($admin as $rule) {
                            ?>
                            <option value="<?php echo $rule['MaQuyen']; ?>">
                                <?php echo $rule['MaQuyen'] ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>


                <div class="mb-3">
                    <label for="MatKhau" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="MatKhau" name="MatKhau" value="<?php echo $admin['MatKhau']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="Avatar" class="form-label">Avatar</label>
                    <input type="file" class="form-control" id="Avatar" name="Avatar">
                    <?php if ($admin['Avatar']) { ?>
                        <img src="uploads/<?php echo $admin['Avatar']; ?>" alt="Avatar" width="100">
                    <?php } ?>
                </div>

                <div class="mb-3">
                    <label for="Email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="Email" name="Email" value="<?php echo $admin['Email']; ?>" required>
                </div>

                <button type="submit" name="edit_admin" class="btn btn-primary">Cập nhật Admin</button>
                <a href="?act=admin" class="btn btn-secondary">Hủy</a>
            </form>
        </div>
    </div>

    <?php
        require_once "./views/layouts/includes/footer_admin.php";
    ?>

</body>
</html>

<script>
    function confirmDelete() {
        return confirm("Bạn có chắc chắn muốn xóa admin này không?");
    }
</script>
