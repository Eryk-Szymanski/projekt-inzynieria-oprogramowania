<?php declare(strict_types=1);

    include '../db/ProductRepository.php';

    class ProductService {

        private ProductRepository $repository;

        public function __construct() {
            $this->repository = new ProductRepository();
        }

        public function newProduct($product) {
            
            $error = 0;
            foreach ($_POST as $key => $value) {
                if (empty($value))
                    $error = 1;
            }

            if($error == 1) 
                echo "<script>history.back();</script>";

            session_start();
            $result = $this->repository->createProduct($product);
            if(isset($result['error']))
                $_SESSION['error'] = $result['error'];
            else {
                $_SESSION['success'] = "Prawidłowo dodano produkt";
                return true;
            }

            return false;
        }

        public function updateProduct($product) {
            
            $error = 0;
            foreach ($_POST as $key => $value) {
                if (empty($value)) 
                    $error = 1;
            }

            if($error == 1)
                echo "<script>history.back();</script>";

            session_start();
            $result = $this->repository->changeProduct($product);
            if(isset($result['error']))
                $_SESSION['error'] = $result['error'];
            else {
                $_SESSION['success'] = "Prawidłowo zaktualizowano produkt";
                return true;
            }
            
            return false;
        }

        public function removeProduct(int $product_id) {
            
            if (empty($product_id))
                echo "<script>history.back();</script>";

            session_start();
            $result = $this->repository->deleteProduct($product_id);
            if(isset($result['error']))
                $_SESSION['error'] = $result['error'];
            else {
                $_SESSION['success'] = "Prawidłowo usunięto produkt";
                return true;
            }

            return false;
        }

        public function getProductsAll() {

            $result = $this->repository->getProducts();
            if(isset($result['success'])) 
                return $result['products'];
            
            return null;
        }


        public function getProductDetails($product_id) {

            $result = $this->repository->getProductData($product_id);
            if(isset($result['success'])) 
                return $result['product'];
            
            return null;
        }

        public function getOrderProducts($productsJson) {

            $products = [];
            foreach($productsJson as $productJson) {
                $result = $this->repository->getProduct($productJson->product_id);
                if(isset($result['success'])) {
                    $result['product']['quantity'] = $productJson->quantity;
                    if(isset($result['product']['price'])) 
                        $result['product']['final_price'] = intval($productJson->quantity) * intval($result['product']['price']);
                    array_push($products, $result['product']);
                }
            }
            return $products;
        }

        public function addToCart($product) {

            $error = 0;
            foreach ($_POST as $key => $value) {
                if (empty($value)) 
                    $error = 1;
            }

            if($error == 1) 
                echo "<script>history.back();</script>";
            
            session_start();

            try {
                $_SESSION['cart'][$product['product_id']] = $product['quantity'];
                $_SESSION['success'] = "Dodano produkt $product[name] do koszyka";
                return true;
            } catch (Exception $e) {
                $_SESSION['error'] = "Nie dodano produktu";
            }

            return false;
        }

    }

?>