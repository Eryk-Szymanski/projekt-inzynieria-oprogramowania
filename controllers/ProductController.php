<?php

    require_once '../services/ProductService.php';

    class ProductController {

        public static function newProduct($data) {
            addProduct($data);
        }

        public static function addProductToCart($data) {
            addToCart($data);
        }

        public static function getOrderProducts($productsJson) {
            return getOrderProducts($productsJson);
        }

        public static function getProductDetails($product_id) {
            return getProductDetails($product_id);
        }

        public static function getProducts() {
            return getProductsAll();
        }

    }

?>