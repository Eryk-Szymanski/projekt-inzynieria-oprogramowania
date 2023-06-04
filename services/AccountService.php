<?php declare(strict_types=1);

if($_SESSION == [])
    session_start();

require_once '../../db/AccountRepository.php';

function loginUser(string $email) {

    $error = 0;
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $error = 1;
        }
    }

    if($error == 1) {
        $_SESSION['error'] = "Wypełnij wszystkie pola";
        echo "<script>history.back();</script>";
        exit();
    }

    $result = getUserForLogin($email);
    if(isset($result['user'])) {
        $user = $result['user'];
    } else {
        $_SESSION['error'] = $result['error'];
    }

    if ($user && password_verify($_POST['pass'], $user['pass'])) {
        $_SESSION['success'] = "Prawidłowo zalogowano użytkownika $_POST[email]";
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_id'] = $user['id'];
        header('location: ../../views/logged.php');
        exit();
    } else {
        $_SESSION['error'] = "Nie zalogowano użytkownika $_POST[email]";
    }

    header('location: ../../');
}

function registerUser($user) {

    $error = 0;
    foreach ($user as $key => $value) {
        if (empty($value))
            $error = 1;
    }

    if (!isset($user['agreeTerms']))
        $error = 1;

    if($error == 1) {
        echo "<script>history.back();</script>";
        exit();
    }

    require_once 'connect.php';
    
    $user['hash'] = password_hash($user['pass1'], PASSWORD_ARGON2ID); 
    
    $result = createUser($user);
    if(isset($result['error']))
        $_SESSION['error'] = $result['error'];

    header('location: ../../');
}

function logoutUser() {
    $_SESSION = array();

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    session_destroy();

    header('location: ../../');
}

?>