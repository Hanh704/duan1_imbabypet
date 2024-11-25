<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sản Phẩm</title>
</head>
<body>
    <?php
        require_once "./views/layouts/includes/header_admin.php";
    ?>
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Thêm Sản Phẩm</h4>
        </div>

        <div class="card-body">
            <form action="?act=product/create" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="TenSP" class="form-label">Tên sản phẩm</label>
                    <input type="text" class="form-control" id="TenSP" name="TenSP" required>
                </div>

                <div class="mb-3">
                    <label for="DonGiaMua" class="form-label">Đơn giá mua (vnđ)</label>
                    <input type="number" class="form-control" id="DonGiaMua" name="DonGiaMua" required>
                </div>

                <div class="mb-3">
                    <label for="DonGiaBan" class="form-label">Đơn giá bán (vnđ)</label>
                    <input type="number" class="form-control" id="DonGiaBan" name="DonGiaBan" required>
                </div>

                <div class="mb-3">
                    <label for="SoLuong" class="form-label">Số lượng</label>
                    <input type="number" class="form-control" id="SoLuong" name="SoLuong" required>
                </div>

                <div class="mb-3">
                    <label for="MaLoai" class="form-label">Danh mục</label>
                    <select name="MaLoai" id="loai" name="MaLoai">
                        <option value="">--chọn danh mục--</option>
                        <?php
                            foreach($categories as $category) {
                                ?>
                                    <option value="<?php echo $category['MaLoai']; ?>"><?php echo $category['TenLoai']; ?></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="MaThuongHieu">Thương hiệu:</label>
                    <select name="MaThuongHieu" id="">
                        <option value="">--chọn thương hiệu--</option>
                        <?php
                            foreach($brands as $brand) {
                                ?>
                                    <option value="<?php echo $brand['MaThuongHieu']; ?>"><?php echo $brand['TenThuongHieu']; ?></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="MaMauSac" class="form-label">Màu sắc</label>
                    <select name="MaMauSac" id="MauSac">
                        <option value="">--chọn màu sắc--</option>
                        <?php
                            foreach ($colors as $color) {
                            ?>
                                <option value="<?php echo $color['MaMauSac']?>"><?php echo $color['TenMau']; ?></option>
                            <?php
                            }
                        ?>
                    </select>

                </div>

                <div class="mb-3">
                    <label for="HinhAnh" class="form-label">Hình ảnh sản phẩm</label>
                    <input type="file" class="form-control" id="HinhAnh" name="HinhAnh">
                </div>

                <div class="mb-3">
                    <label for="MoTa" class="form-label">Mô tả sản phẩm</label>
                    <textarea class="form-control" id="MoTa" name="MoTa" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label for="TrangThai" class="form-label">Trạng Thái</label>
                    <select name="TrangThai" id="TrangThai">
                        <option value="1">hiện</option>
                        <option value="0">ẩn</option>
                    </select>
                </div>

                <button type="submit" name="create_product" class="btn btn-primary">Thêm mới sản phẩm</button>
                <a href="?act=product" class="btn btn-secondary">Hủy</a>
            </form>
        </div>

    </div>
    <?php
        require_once "./views/layouts/includes/footer_admin.php";
    ?>
    
</body>
</html>