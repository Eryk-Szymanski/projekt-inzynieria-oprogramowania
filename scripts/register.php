<?php

    session_start();

    $error = 0;
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $error = 1;
        }
    }

    if (!isset($_POST['agreeTerms'])) {
        $error = 1;
    }

    if($error == 1) {
        echo "<script>history.back();</script>";
        exit();
    }

    require_once 'connect.php';
    
    $pass = password_hash($_POST['pass1'], PASSWORD_ARGON2ID);  
    try {
        $stmt = $mysqli->prepare("INSERT INTO users(city_id, name, surname, email, pass, birthday) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $_POST['city_id'], $_POST['name'], $_POST['surname'], $_POST['email1'], $pass, $_POST['birthday']);
        $stmt->execute();

        if ($stmt->affected_rows == 1) {
            $_SESSION['success'] = "Prawidłowo dodano użytkownika $_POST[email1]";
        }

    } catch (Exception $e) {
        echo $e->getMessage();
        if($stmt->affected_rows != 1) {
            $_SESSION['error'] = "Nie dodano użytkownika $_POST[email1]";
        }
    }

    header('location: ../');
?>