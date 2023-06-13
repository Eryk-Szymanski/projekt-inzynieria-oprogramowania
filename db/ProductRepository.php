<?php declare(strict_types=1);

    use model\interfaces\IRepository;
    require_once '../model/interfaces/IRepository.php';

    class ProductRepository implements IRepository {

        private mysqli $connection;

        public function __construct() {
            include '../scripts/connect.php';
            $this->connection = $mysqli;
        }

        public function createNew($product) {

            $error = "";
            try {
                $is_available = 0;
                if(isset($product['is_available']))
                    $is_available = 1;
                $stmt = $this->connection->prepare("INSERT INTO products(name, weight, is_available, description, calories, price, image_path) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("siisiis", $product['name'], $product['weight'], $is_available, $product['description'], $product['calories'], $product['price'], $product['image_path']);
                $stmt->execute();

                if ($stmt->affected_rows == 1) {
                    return ["success" => true];
                }

            } catch (Exception $e) {
                if($stmt->affected_rows != 1) {
                    $error = "Nie utworzono produktu $product[name]";
                }
                $error = $error . "Message: " . $e->getMessage();
            }
            return ["error" => $error];
        }

        public function updateProduct($product) {

            $error = "";
            try {
                $is_available = 0;
                if(isset($product['is_available']))
                    $is_available = 1;
                $stmt = $this->connection->prepare("UPDATE products SET name = ?, weight = ?, is_available = ?, description = ?, calories = ?, price = ?, image_path = ? WHERE id = $product[product_id]");
                $stmt->bind_param("siisiis", $product['name'], $product['weight'], $is_available, $product['description'], $product['calories'], $product['price'], $product['image_path']);
                $stmt->execute();

                if ($stmt->affected_rows == 1) {
                    return ["success" => true];
                }

            } catch (Exception $e) {
                if($stmt->affected_rows != 1) {
                    $error = "Nie zaktualizowano produktu $product[name]";
                }
                $error = $error . "Message: " . $e->getMessage();
            }
            return ["error" => $error];
        }

        public function deleteProduct(int $product_id) {

            $error = "";
            try {
                $stmt = $this->connection->prepare("DELETE FROM products WHERE id = ?");
                $stmt->bind_param("i", $product_id);
                $stmt->execute();

                if ($stmt->affected_rows == 1) {
                    return ["success" => true];
                }

            } catch (Exception $e) {
                if($stmt->affected_rows != 1) {
                    $error = "Nie usunięto produktu $product[name]";
                }
                $error = $error . "Message: " . $e->getMessage();
            }
            return ["error" => $error];
        }

        public function getAll() {

            $error = "";
            $products = [];
            try {
                $sql = "SELECT * FROM `products`";
                $result = $this->connection->query($sql);
                while($product = $result->fetch_assoc()) {
                    array_push($products, $product);
                }
                return ["success" => true, "products" => $products];
                
            } catch (Exception $e) {
                if($stmt->affected_rows != 1) {
                    $error = "Nie udało się pobrać produktów";
                }
                $error = $error . "Message: " . $e->getMessage();
            }
            return ["error" => $error];
        }

        public function getById($product_id) {

            $error = "";
            try {
                $sql = "SELECT id, name, price, image_path FROM `products` WHERE id = $product_id";
                $result = $this->connection->query($sql);
                $product = $result->fetch_assoc();

                return ["success" => true, "product" => $product];

            } catch (Exception $e) {
                if($stmt->affected_rows != 1) {
                    $error = "Nie odnaleziono produktu";
                }
                $error = $error . "Message: " . $e->getMessage();
            }
            return ["error" => $error];
        }

        public function getProductDetails(int $product_id) {

            $error = "";
            try {
                $sql = "SELECT * FROM `products` WHERE id = $product_id";
                $result = $this->connection->query($sql);
                $product = $result->fetch_assoc();

                return ["success" => true, "product" => $product];

            } catch (Exception $e) {
                if($stmt->affected_rows != 1) {
                    $error = "Nie odnaleziono produktu";
                }
                $error = $error . "Message: " . $e->getMessage();
            }
            return ["error" => $error];
        }

    }

?>