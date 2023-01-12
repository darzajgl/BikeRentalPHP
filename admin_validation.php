<?php
session_start();
if (!isset($_POST['admin_login']) || (!isset($_POST['admin_password']))) {
    header('Location: index.php');
    exit();
}
require_once 'db_config.php';

try {
    $connection = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $login = $_POST['admin_login'];
    $password = $_POST['admin_password'];
    $login = htmlentities($login, ENT_QUOTES, "UTF-8");
    $stmt = $connection->prepare("SELECT * FROM admins WHERE login=:admin_login");
    $stmt->bindParam(':admin_login', $login);
    $stmt->execute();
    $result = $stmt->fetch();

    if ($result) {
        if (password_verify($password, $result['password'])) {
            $_SESSION['admin_logged'] = true;
            $_SESSION['admin_id'] = $result['admin_id'];
            $_SESSION['admin_login'] = $result['login'];
            $_SESSION['admin_password'] = $result['password'];
            $_SESSION['admin_email'] = $result['email'];
            unset($_SESSION['admin_login_error']);
            unset($_SESSION['admin_password_error']);
            header('Location:admin_panel.php');
        } else {
            $_SESSION['admin_password_error'] = 'Nieprawidłowe hasło';
            header('Location:admin_form.php');
        }
    } else {
        $_SESSION['admin_login_error'] = 'Nieprawidłowy login';
        header('Location:admin_form.php');
    }
}
catch (PDOException $error) {
    $_SESSION['admin_login_error'] = $error->getMessage();
    header('Location:admin_form.php');
}
//Komentarze:
// W przypadku nieprawidłowego loginu lub hasła zostają unsetowane zmienne sesyjne admin_login_error i admin_password_error
