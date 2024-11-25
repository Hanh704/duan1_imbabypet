<?php
    require_once "./views/layouts/includes/header_admin.php";
?>

<div class="h-100">
    <div class="row mb-3 pb-1">
        <div class="col-12">
            <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                <div class="mt-3 mt-lg-0">
                    <form action="javascript:void(0);">
                        <div class="row g-3 mb-0 align-items-center">
                            <div class="col-auto">
                                <a href="?act=admin/create">
                                    <button type="button" class="btn btn-soft-success material-shadow-none">
                                        <i class="ri-add-circle-line align-middle me-1"></i>Thêm Admin
                                    </button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- end card header -->
        </div>
    </div>

    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Danh Sách Admin</h4>
        </div><!-- end card header -->

        <div class="card-body">
            <div class="table-responsive table-card">
                <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                    <thead class="text-muted table-light">
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Mã Admin</th>
                            <th scope="col">Avatar</th>
                            <th scope="col">Họ Tên</th>
                            <th scope="col">Email</th>
                            <th scope="col">Số Điện Thoại</th>
                            <th scope="col">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($adminsOnPage as $index => $admin) { ?>
                            <tr>
                                <td><h5 class="fs-14 my-1 fw-normal"><?php echo $index + 1; ?></h5></td>
                                <td>
                                    <h5 class="fs-14 my-1 fw-normal"><?php echo $admin['MaAdmin']; ?></h5>
                                </td>
                                <td>
                                    <h5><img src="<?php echo $admin['Avatar']; ?>" alt="" class="fs-14 my-1 fw-normal"/></h5>
                                </td>
                                <td>
                                    <h5 class="fs-14 my-1 fw-normal"><?php echo $admin['HoTen']; ?></h5>
                                </td>
                                <td>
                                    <h5 class="fs-14 my-1 fw-normal"><?php echo $admin['Email']; ?></h5>
                                </td>
                                <td>
                                    <h5 class="fs-14 my-1 fw-normal"><?php echo $admin['DienThoai']; ?></h5>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="?act=admin/edit&MaAdmin=<?php echo $admin['MaAdmin']; ?>" class="btn btn-sm btn-outline-success">Sửa</a>
                                        <a href="?act=admin/delete&MaAdmin=<?php echo $admin['MaAdmin']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirmDelete();">Xóa</a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- page link -->
            <div class="align-items-center mt-4 pt-2 justify-content-between row text-center text-sm-start">
                <div class="col-sm">
                    <div class="text-muted">
                        Showing <span class="fw-semibold"><?php echo min($perPage, $totalAdmins - $startIndex) ?></span> of 
                        <span class="fw-semibold"><?php echo $totalAdmins ?></span> Results
                    </div>
                </div>
                <div class="col-sm-auto mt-3 mt-sm-0">
                    <ul class="pagination pagination-separated pagination-sm mb-0 justify-content-center">
                        <li class="page-item <?php echo $currentPage == 1 ? 'disabled' : '' ?>">
                            <a href="?act=admin&page=<?php echo $currentPage - 1 ?>" class="page-link">←</a>
                        </li>
                        <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                            <li class="page-item <?php echo $currentPage == $i ? 'active' : '' ?>">
                                <a href="?act=admin&page=<?php echo $i ?>" class="page-link"><?php echo $i ?></a>
                            </li>
                        <?php } ?>
                        <li class="page-item <?php echo $currentPage == $totalPages ? 'disabled' : '' ?>">
                            <a href="?act=admin&page=<?php echo $currentPage + 1 ?>" class="page-link">→</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- end page link -->
        </div>
    </div>
    <!-- end card -->
</div> <!-- end .h-100 -->

<?php
    require_once "./views/layouts/includes/footer_admin.php";
?>

<script>
    function confirmDelete() {
        return confirm("Bạn có chắc chắn xoá không?");
    }
</script>
