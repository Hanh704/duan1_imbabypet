
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
                                    <a href="?act=product/create"><button type="button" class="btn btn-soft-success material-shadow-none"><i class="ri-add-circle-line align-middle me-1"></i>Thêm sản phấm</button></a>
                                </div>
                                <!--end col-->
                                <div class="col-auto">
                                    <button type="button" class="btn btn-soft-info btn-icon waves-effect material-shadow-none waves-light layout-rightside-btn"><i class="ri-pulse-line"></i></button>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </form>
                    </div>
                </div><!-- end card header -->
            </div>
            <!--end col-->
        </div>
        <!--end row-->



        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Danh Sách Sản Phẩm</h4>
                <div class="flex-shrink-0">
                    <div class="dropdown card-header-dropdown">
                        <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="fw-semibold text-uppercase fs-12">Sort by:
                            </span><span class="text-muted">Today<i class="mdi mdi-chevron-down ms-1"></i></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#">Today</a>
                            <a class="dropdown-item" href="#">Yesterday</a>
                            <a class="dropdown-item" href="#">Last 7 Days</a>
                            <a class="dropdown-item" href="#">Last 30 Days</a>
                            <a class="dropdown-item" href="#">This Month</a>
                            <a class="dropdown-item" href="#">Last Month</a>
                        </div>
                    </div>
                </div>
            </div><!-- end card header -->

            <div class="card-body">
                <div class="table-responsive table-card">
                    <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                        <thead class="text-muted table-light">
                            <tr>
                                <th scope="col">Sản Phẩm </th>
                                <th scope="col">Mã Sản phẩm</th>
                                <th scope="col">Giá Nhập</th>
                                <th scope="col">Giá Bán</th>
                                <th scope="col">Số Lượng</th>
                                <th scope="col">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($productsOnPage as $product) {
                            ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm bg-light rounded p-1 me-2">
                                                <a href="?act=product/edit&MaSP=<?php echo $product['MaSP'] ?>"><img src="<?php echo $product['HinhAnh'] ?>" alt="" class="img-fluid d-block" /></a>
                                            </div>
                                            <div>
                                                <h5 class="fs-14 my-1"><a href="?act=product/edit&id=<?php echo $product['MaSP'] ?>" class="text-reset"><?php echo $product['TenSP'] ?></a></h5>
                                                <span class="text-muted">24 Apr 2021</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h5 class="fs-14 my-1 fw-normal"><?php echo $product['MaSP'] ?></h5>
                                        <span class="text-muted"></span>
                                    </td>
                                    <td>
                                        <h5 class="fs-14 my-1 fw-normal"><?php echo $product['DonGiaMua'] ?></h5>
                                        <span class="text-muted">vnđ</span>
                                    </td>
                                    <td>
                                        <h5 class="fs-14 my-1 fw-normal"><?php echo $product['DonGiaBan'] ?></h5>
                                        <span class="text-muted">vnđ</span>
                                    </td>
                                    <td>
                                        <h5 class="fs-14 my-1 fw-normal"><?php echo $product['SoLuong'] ?></h5>
                                        <span class="text-muted">cái</span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="?act=product/edit&MaSP=<?php echo $product['MaSP'] ?>" class="btn btn-sm btn-outline-success">Sửa</a>
                                            <a href="?act=product/delete&MaSP=<?php echo $product['MaSP'] ?>" class="btn btn-sm btn-outline-danger"  onclick="return confirmDelete();">Xóa</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                            </tr>
                        </tbody>
                    </table>
                </div>


                <!-- page link -->
                <div class="align-items-center mt-4 pt-2 justify-content-between row text-center text-sm-start">
                    <div class="col-sm">
                        <div class="text-muted">
                            Showing <span class="fw-semibold"><?php echo min($perPage, $totalProducts - $startIndex) ?></span> of 
                            <span class="fw-semibold"><?php echo $totalProducts ?></span> Results
                        </div>
                    </div>
                    <div class="col-sm-auto mt-3 mt-sm-0">
                        <ul class="pagination pagination-separated pagination-sm mb-0 justify-content-center">
                            <li class="page-item <?php echo $currentPage == 1 ? 'disabled' : '' ?>">
                                <a href="?act=product&page=<?php echo $currentPage - 1 ?>" class="page-link">←</a>
                            </li>
                            <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                                <li class="page-item <?php echo $currentPage == $i ? 'active' : '' ?>">
                                    <a href="?act=product&page=<?php echo $i ?>" class="page-link"><?php echo $i ?></a>
                                </li>
                            <?php } ?>
                            <li class="page-item <?php echo $currentPage == $totalPages ? 'disabled' : '' ?>">
                                <a href="?act=product&page=<?php echo $currentPage + 1 ?>" class="page-link">→</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- end page link -->
            </div>
        </div>
        <!-- end card -->

    </div> <!-- end .h-100-->


<?php
        require_once "./views/layouts/includes/footer_admin.php";


?>

<script>
    function confirmDelete(){
        return confirm("Bạn có chắc chắn xoá không?");
    }

</script>

