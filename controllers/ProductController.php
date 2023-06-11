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
            return $this->service->newProduct($data);
        }

        public function updateProduct($data) {
            return $this->service->updateProduct($data);
        }

        public function deleteProduct(int $product_id) {
            return $this->service->deleteProduct($product_id);
        }

        public function addProductToCart($data, $cart) {
            return $this->service->addProductToCart($data, $cart);
        }

        public function getOrderProducts($productsJson) {
            return $this->service->getOrderProducts($productsJson);
        }

        public function getProductDetails(int $product_id) {
            return $this->service->getProductDetails($product_id);
        }

        public function getProducts() {
            return $this->service->getProducts();
        }

    }

?>