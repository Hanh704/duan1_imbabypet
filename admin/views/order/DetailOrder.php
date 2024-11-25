<?php
require_once "./views/layouts/includes/header_admin.php";
?>

<div class="h-100">
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Chi tiết đơn hàng</h4>
        </div><!-- end card header -->

        <div class="card-body">
            <form action="?act=order/updateStatus" method="POST">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Mã đơn hàng:</strong> <?= $order['MaDH'] ?></p>
                        <p><strong>Mã khách hàng:</strong> <?= $order['MaKH'] ?></p>
                        <p><strong>Ngày đặt:</strong> <?= $order['NgayDat'] ?></p>
                        <p><strong>Ngày giao:</strong> <?= $order['NgayGiao'] ?></p>
                        <p><strong>Đã thanh toán:</strong> <?= $order['DaThanhToan'] ? 'Có' : 'Không' ?></p>
                        <p><strong>Tổng tiền:</strong> <?= number_format($order['TongTien'], 0, ',', '.') ?> VNĐ</p>
                        
                        <!-- Select trạng thái -->
                        <div class="mb-3">
                            <label for="TinhTrangDH" class="form-label"><strong>Tình trạng đơn hàng:</strong></label>
                            <select class="form-select" name="TinhTrangDH" id="TinhTrangDH">
                                <option value="pending" <?= $order['TinhTrangDH'] == 'pending' ? 'selected' : '' ?>>Chờ xử lý</option>
                                <option value="shipping" <?= $order['TinhTrangDH'] == 'shipping' ? 'selected' : '' ?>>Đang giao</option>
                                <option value="delivered" <?= $order['TinhTrangDH'] == 'delivered' ? 'selected' : '' ?>>Đã giao</option>
                                <option value="cancel" <?= $order['TinhTrangDH'] == 'cancel' ? 'selected' : '' ?>>Hủy</option>
                            </select>
                        </div>

                        <!-- Hidden input để gửi Mã đơn hàng -->
                        <input type="hidden" name="MaDH" value="<?= $order['MaDH'] ?>">

                        <h5 class="mt-4">Chi tiết sản phẩm</h5>
                        <hr>    
                        <div class="table-responsive table-card">
                            <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                                <thead class="text-muted table-light">
                                    <tr>
                                        <th scope="col">Mã sản phẩm</th>
                                        <th scope="col">Hình Ảnh</th>
                                        <th scope="col">Tên Sản Phẩm</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Đơn giá</th>
                                        <th scope="col">Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($orderDetails as $detail): ?>
                                        <tr>
                                            <td><h5 class="fs-14 my-1 fw-normal"><?= $detail['MaSP'] ?></h5></td>
                                            <td>
                                                <img src="<?= $detail['HinhAnh'] ?>" alt="<?= $detail['TenSP'] ?>" width="50" height="50">
                                            </td>
                                            <td><h5 class="fs-14 my-1 fw-normal"><?= $detail['TenSP'] ?></h5></td>
                                            <td><h5 class="fs-14 my-1 fw-normal"><?= $detail['SoLuong'] ?></h5></td>
                                            <td><h5 class="fs-14 my-1 fw-normal"><?= number_format($detail['DonGia'], 0, ',', '.') ?> VNĐ</h5></td>
                                            <td><h5 class="fs-14 my-1 fw-normal"><?= number_format($detail['ThanhTien'], 0, ',', '.') ?> VNĐ</h5></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <div>
                        <button type="submit" class="btn btn-primary">Cập nhật trạng thái</button>
                        <a href="?act=orders" class="btn btn-secondary mt-3">Cancel</a>
                        </div>
                        <!-- Nút cập nhật -->



                    </div>
                </div>
            </form>

        </div>
    </div>
</div> <!-- end .h-100 -->

<?php
require_once "./views/layouts/includes/footer_admin.php";
?>
