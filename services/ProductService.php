<?php declare(strict_types=1);

    use model\interfaces\IService;
    require_once '../model/interfaces/IService.php';

    include '../db/ProductRepository.php';

    class ProductService implements IService {

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

            $result = $this->repository->newProduct($product);
            if(isset($result['success']))
                return ["success" => "Prawidłowo zarejestrowano użytkownika"];

            return ["error" => $result['error']];
        }

        public function updateProduct($product) {
            
            $error = 0;
            foreach ($_POST as $key => $value) {
                if (empty($value)) 
                    $error = 1;
            }

            if($error == 1)
                echo "<script>history.back();</script>";

            $result = $this->repository->updateProduct($product);
            if(isset($result['success']))
                return ["success" => "Prawidłowo zaktualizowano produkt"];
            
            return ["error" => $result['error']];
        }

        public function deleteProduct(int $product_id) {
            
            if (empty($product_id))
                echo "<script>history.back();</script>";

            session_start();
            $result = $this->repository->deleteProduct($product_id);
            if(isset($result['success']))
                return ["success" => "Prawidłowo usunięto produkt"];

            return ["error" => $result['error']];
        }

        public function getProducts() {

            $result = $this->repository->getProducts();
            if(isset($result['success'])) 
                return $result['products'];
            
            return null;
        }


        public function getProductDetails($product_id) {

            $result = $this->repository->getProductDetails($product_id);
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

        public function addProductToCart($product, $cart) {

            $error = 0;
            foreach ($_POST as $key => $value) {
                if (empty($value)) 
                    $error = 1;
            }

            if($error == 1) 
                echo "<script>history.back();</script>";
            
            try {
                $cart[$product['product_id']] = $product['quantity'];
                return ["success" => "Dodano produkt $product[name] do koszyka", "cart" => $cart];

            } catch (Exception $e) {
                $error = "Nie dodano produktu: " . "Message: " . $e->getMessage();
            }

            return ["error" => $error];
        }

    }

?>