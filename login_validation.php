<?php
session_start();
if (!isset($_POST['login']) || (!isset($_POST['password']))) {
    header('Location: index.php');
    exit();
}
require_once 'db_config.php';

try {
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $login = $_POST['login'];
    $password = $_POST['password'];
    $login = htmlentities($login, ENT_QUOTES, "UTF-8");
    $stmt = $pdo->prepare("SELECT * FROM users WHERE login=:login");
    $stmt->bindParam(':login', $login);
    $stmt->execute();
    $result = $stmt->fetch();

    if ($result) {
        if (password_verify($password, $result['password'])) {
            $_SESSION['logged'] = true;
            $_SESSION['user_id'] = $result['user_id'];
            $_SESSION['name'] = $result['name'];
            $_SESSION['surname'] = $result['surname'];
            $_SESSION['login'] = $result['login'];
            $_SESSION['password'] = $result['password'];
            $_SESSION['email'] = $result['email'];
            $_SESSION['street'] = $result['street'];
            $_SESSION['house_number'] = $result['house_number'];
            $_SESSION['zip_code'] = $result['zip_code'];
            $_SESSION['city'] = $result['city'];
            // W przypadku nieprawidłowego loginu lub hasła zostają unsetowane zmienne sesyjne login_error i password_error
            unset($_SESSION['login_error']);
            unset($_SESSION['password_error']);
            header('Location:account.php');
        } else {
            // Zmienna sesyjna $_SESSION['password_error'] jest używana do przechowywania błędu nieprawidłowego hasła
            $_SESSION['password_error'] = 'Nieprawidłowe hasło';
            header('Location:login_form.php');
        }
    } else {
        // Zmienna sesyjna $_SESSION['login_error'] jest używana do przechowywania błędu nieprawidłowego loginu
        $_SESSION['login_error'] = 'Nieprawidłowy login';
        header('Location:login_form.php');
    }
}
catch (PDOException $error) {
    $_SESSION['login_error'] = $error->getMessage();
    header('Location:login_form.php');
}




