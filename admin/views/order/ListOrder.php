<?php
require_once "./views/layouts/includes/header_admin.php";
?>

<div class="h-100">
    <div class="row mb-3 pb-1">
        <div class="col-12">
            <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                <div class="mt-3 mt-lg-0">
                    <form action="?act=order/search" method="GET">
                        <div class="row g-3 mb-0 align-items-center">
                            <div class="col">
                                <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm đơn hàng..." />
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-soft-primary material-shadow-none">
                                    <i class="ri-search-line align-middle me-1"></i> Tìm kiếm
                                </button>
                            </div>
                            <div class="col-auto">
                                <a href="?act=order/create">
                                    <button type="button" class="btn btn-soft-success material-shadow-none">
                                        <i class="ri-add-circle-line align-middle me-1"></i> Thêm Đơn Hàng
                                    </button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Danh Sách Đơn Hàng</h4>
        </div>

        <div class="card-body">
            <div class="table-responsive table-card">
                <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                    <thead class="text-muted table-light">
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Mã Đơn Hàng</th>
                            <th scope="col">Mã Khách Hàng</th>
                            <th scope="col">Ngày Đặt</th>
                            <th scope="col">Ngày Giao</th>
                            <th scope="col">Tình Trạng</th>
                            <th scope="col">Thanh Toán</th>
                            <th scope="col">Tổng Tiền</th>
                            <th scope="col">Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $index => $order): ?>
                            <tr>
                                <td><h5 class="fs-14 my-1 fw-normal"><?php echo $index + 1 ?></h5></td>
                                <td><h5 class="fs-14 my-1 fw-normal"><?php echo $order['MaDH']; ?></h5></td>
                                <td><h5 class="fs-14 my-1 fw-normal"><?php echo $order['MaKH']; ?></h5></td>
                                <td><h5 class="fs-14 my-1 fw-normal"><?php echo $order['NgayDat']; ?></h5></td>
                                <td><h5 class="fs-14 my-1 fw-normal"><?php echo $order['NgayGiao']; ?></h5></td>
                                <td><h5 class="fs-14 my-1 fw-normal"><?php echo $order['TinhTrangDH']; ?></h5></td>
                                <td><h5 class="fs-14 my-1 fw-normal"><?php echo $order['DaThanhToan'] ? 'Có' : 'Không'; ?></h5></td>
                                <td><h5 class="fs-14 my-1 fw-normal"><?php echo $order['TongTien']; ?></h5></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="?act=order/view&MaDH=<?php echo $order['MaDH']; ?>" class="btn btn-sm btn-outline-info">Chi Tiết</a>
                                        <a href="?act=order/delete&MaDH=<?php echo $order['MaDH']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirmDelete();">Xóa</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="align-items-center mt-4 pt-2 justify-content-between row text-center text-sm-start">
                <div class="col-sm">
                    <div class="text-muted">
                        Showing <span class="fw-semibold"><?php echo $perPage ?></span> of 
                        <span class="fw-semibold"><?php echo $totalOrders ?></span> Results
                    </div>
                </div>
                <div class="col-sm-auto mt-3 mt-sm-0">
                    <ul class="pagination pagination-separated pagination-sm mb-0 justify-content-center">
                        <li class="page-item <?php echo $currentPage == 1 ? 'disabled' : '' ?>">
                            <a href="?act=order&page=<?php echo $currentPage - 1 ?>" class="page-link">←</a>
                        </li>
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?php echo $currentPage == $i ? 'active' : '' ?>">
                                <a href="?act=order&page=<?php echo $i ?>" class="page-link"><?php echo $i ?></a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item <?php echo $currentPage == $totalPages ? 'disabled' : '' ?>">
                            <a href="?act=order&page=<?php echo $currentPage + 1 ?>" class="page-link">→</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once "./views/layouts/includes/footer_admin.php";
?>

<script>
    function confirmDelete() {
        return confirm("Bạn có chắc chắn muốn xoá không?");
    }
</script>
