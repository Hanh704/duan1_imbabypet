<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sản phẩm</title>
</head>
<body>
    <?php
        require_once "./views/layouts/includes/header_admin.php";
    ?>
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Sửa Sản Phẩm</h4>
            <a href="?act=product/delete&MaSP=<?php echo $product['MaSP'] ?>" class="btn btn-danger"  onclick="return confirmDelete();">Xóa</a>

        </div>

        <div class="card-body">
            <form action="?act=product/update&MaSP=<?php echo $product['MaSP']; ?>" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="TenSP" class="form-label">Tên sản phẩm</label>
                    <input type="text" class="form-control" id="TenSP" name="TenSP" value="<?php echo $product['TenSP']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="DonGiaMua" class="form-label">Đơn giá mua (vnđ)</label>
                    <input type="number" class="form-control" id="DonGiaMua" name="DonGiaMua" value="<?php echo $product['DonGiaMua']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="DonGiaBan" class="form-label">Đơn giá bán (vnđ)</label>
                    <input type="number" class="form-control" id="DonGiaBan" name="DonGiaBan" value="<?php echo $product['DonGiaBan']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="SoLuong" class="form-label">Số lượng</label>
                    <input type="number" class="form-control" id="SoLuong" name="SoLuong" value="<?php echo $product['SoLuong']; ?>" required>
                </div>

                <div class="mb-3">
                    <label for="MaLoai" class="form-label">Danh mục</label>
                    <select name="MaLoai" id="loai" name="MaLoai">
                        <?php
                            foreach($categories as $category) {
                                ?>
                                    <option <?php if($category['MaLoai'] == $product['MaLoai']) echo ("selected") ?> value="<?php echo $category['MaLoai']; ?>"><?php echo $category['TenLoai']; ?></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="MaThuongHieu">Thương hiệu:</label>
                    <select name="MaThuongHieu" id="">
                        <?php
                            foreach($brands as $brand) {
                                ?>
                                    <option <?php if($brand['MaThuongHieu'] == $product['MaThuongHieu']) echo ("selected") ?> value="<?php echo $brand['MaThuongHieu']; ?>"><?php echo $brand['TenThuongHieu']; ?></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="MaMauSac" class="form-label">Màu sắc</label>
                    <select name="MaMauSac" id="MaMauSac">
                        <?php
                            foreach ($colors as $color) {
                            ?>
                                <option <?php if($color['MaMauSac'] == $product['MaMauSac']) echo ("selected") ?> value="<?php echo $color['MaMauSac']?>"><?php echo $color['TenMau']; ?></option>
                            <?php
                            }
                        ?>
                    </select>

                </div>

                <div class="mb-3">
                    <label for="HinhAnh" class="form-label">Hình ảnh sản phẩm</label>
                    <input type="file" class="form-control" id="HinhAnh" name="HinhAnh">
                    <p class="mt-2">Hình ảnh hiện tại:</p>
                    <img src="<?php echo $product['HinhAnh']; ?>" alt="Hình sản phẩm" width="100">
                </div>

                <div class="mb-3">
                    <label for="MoTa" class="form-label">Mô tả sản phẩm</label>
                    <textarea class="form-control" id="MoTa" name="MoTa" rows="3"><?php echo $product['MoTa']; ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="TrangThai" class="form-label">Trạng Thái</label>
                    <select name="TrangThai" id="TrangThai">
                        <option value="1" <?php echo ($product['AnHien'] == 1) ? 'selected' : ''; ?>>hiện</option>
                        <option value="0" <?php echo ($product['AnHien'] == 0) ? 'selected' : ''; ?>>ẩn</option>
                    </select>
                </div>

                <button type="submit" name="edit_product" class="btn btn-primary">Cập nhật sản phẩm</button>
                <a href="?act=product" class="btn btn-secondary">Hủy</a>
            </form>
        </div>

    </div>

    <?php
        require_once "./views/layouts/includes/footer_admin.php";
    ?>
    
</body>
</html>
<script>
    function confirmDelete(){
        return confirm("Bạn có chắc chắn xoá không?");
    }

</script>