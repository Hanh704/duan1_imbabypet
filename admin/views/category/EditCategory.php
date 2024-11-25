<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Danh Mục</title>
</head>
<body>
    <?php
        require_once "./views/layouts/includes/header_admin.php";
    ?>
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Sửa Danh Mục</h4>
            <a href="?act=category/delete&MaLoai=<?php echo $category['MaLoai']; ?>" class="btn btn-danger" onclick="return confirmDelete();">Xóa</a>
        </div>

        <div class="card-body">
            <form action="?act=category/update&MaLoai=<?php echo $category['MaLoai']; ?>" method="POST">
                <div class="mb-3">
                    <label for="TenLoai" class="form-label">Tên danh mục</label>
                    <input type="text" class="form-control" id="TenLoai" name="TenLoai" value="<?php echo $category['TenLoai']; ?>" required>
                </div>

                <button type="submit" name="edit_category" class="btn btn-primary">Cập nhật danh mục</button>
                <a href="?act=category" class="btn btn-secondary">Hủy</a>
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
        return confirm("Bạn có chắc chắn muốn xóa danh mục này không?");
    }
</script>
