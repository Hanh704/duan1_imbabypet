<h2>
    đây là trang chủ List Product
</h2>

<button><a href="?act=product/create">Thêm sản phẩm</a></button>



        
<table style="border-collapse: collapse; width: 100%; border: 1px solid;">
    <thead>
        <tr>
            <td>Mã Sản Phẩm</td>
            <th>Tên Sản Phẩm</th>
            <th>Hình Ảnh</th>
            <th>Đơn Giá Mua</th> 
            <th>Đơn Giá Bán</th>
            <th>Số Lượng</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($products as $product){
        ?>
        <tr>
                <td><?php echo $product['sanpham_MASP'] ?></td>
                <td><?php echo $product['sanpham_TENSP'] ?></td>
                <td><img width="100px" height="100px" src="<?php echo $product['sanpham_HINHANH'] ?>" alt=""></td>
                <td><?php echo $product['sanpham_DONGIAMUA'] ?></td>
                <td><?php echo $product['sanpham_DONGIABAN'] ?></td>
                <td><?php echo $product['sanpham_SOLUONG'] ?></td>
        </tr>
        <?php
            }
        ?>
    </tbody>
</table>

