<?php declare(strict_types=1);

    use model\interfaces\IController;
    require_once '../model/interfaces/IController.php';

    include '../services/ProductService.php';

    class ProductController implements IController {

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

        public function createNew($data) {
            return $this->service->createNew($data);
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

        public function getAll() {
            return $this->service->getAll();
        }

        public function getById($id) {
            return $this->service->getById();
        }

    }

?>