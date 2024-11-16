<?php

require_once "./models/productModel.php";

class ProductController {
    public function index() {
        $productModel = new ProductModel();
        $products = $productModel->getAllProducts();

        require_once __DIR__ . '/../views/product/listProduct.php';
    }

    public function create(){
        require_once "./views/product/CreateProduct.php";
    }
}