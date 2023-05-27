<?php

    session_start();

    $error = 0;
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $error = 1;
        }
    }

    if(!isset($_POST['number'])) {
        $error = 1;
    }

    if($error == 1) {
        echo "<script>history.back();</script>";
        exit();
    }

    require_once 'connect.php';
    
    try {
        if(isset($_POST['decision'])) {
            $decision = 0;
            switch($_POST['decision']) {
                case 'accept':
                    $decision = 1;
                    break;
                case 'reject':
                    $decision = 2;
                    break;
            }
            $stmt = $mysqli->prepare("UPDATE orders SET status = ? WHERE number = $_POST[number]");
            $stmt->bind_param("i", $decision);
            $stmt->execute();
        }

    } catch (Exception $e) {
        echo $e->getMessage();
        $_SESSION['error'] = "Nie udało się zmienić statusu zamówienia";
    }

    header('location: ../views/logged.php');
?>