<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Danh Mục</title>
</head>
<body>
    <?php
        require_once "./views/layouts/includes/header_admin.php";
    ?>
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Thêm Danh Mục Mới</h4>
        </div>

        <div class="card-body">
            <form action="?act=category/create" method="POST">
                <div class="mb-3">
                    <label for="TenLoai" class="form-label">Tên danh mục</label>
                    <input type="text" class="form-control" id="TenLoai" name="TenLoai" placeholder="Nhập tên danh mục" required>
                </div>

                <button type="submit" name="create_category" class="btn btn-primary">Thêm danh mục</button>
                <a href="?act=category" class="btn btn-secondary">Hủy</a>
            </form>
        </div>
    </div>

    <?php
        require_once "./views/layouts/includes/footer_admin.php";
    ?>
</body>
</html>
