<?php declare(strict_types=1);

    include '../services/ProductService.php';

    class ProductController {

        private ProductService $service;
        private static ProductController $instance;

        private function __construct() {
            $this->service = new ProductService();
        }

        public static function getInstance() {
            if(!isset(self::$instance)) {
                self::$instance = new ProductController();
            }
            return self::$instance;
        }

        public function newProduct($data) {
            $result = $this->service->newProduct($data);
            if($result)
                return header('location: ../views/products.php');
            return header('location: ../');
        }

        public function editProduct($data) {
            $result = $this->service->updateProduct($data);
            if($result)
                return header('location: ../views/products.php');
            return header('location: ../');
        }

        public function deleteProduct(int $product_id) {
            $result = $this->service->removeProduct($product_id);
            if($result)
                return header('location: ../views/products.php');
            return header('location: ../');
        }

        public function addProductToCart($data) {
            $result = $this->service->addToCart($data);
            if($result)
                return header('location: ../views/products.php');
            return header('location: ../');
        }

        public function getOrderProducts($productsJson) {
            return $this->service->getOrderProducts($productsJson);
        }

        public function getProductDetails(int $product_id) {
            return $this->service->getProductDetails($product_id);
        }

        public function getProducts() {
            return $this->service->getProductsAll();
        }

    }

?>