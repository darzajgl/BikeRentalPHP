<?php
session_start();
require_once "db_config.php";
//wylogowanie użytkownika, jeśli był zalogowany
$_SESSION['logged'] = false;

//przekierowanie do register_form
if (!isset($_POST['name'])) {
    header('Location: register_form.php');
    exit();
}

if (isset($_POST['name'])) {
    //przypisanie zmiennych
    $status_OK = true;
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $street = $_POST['street'];
    $house_number = $_POST['house_number'];
    $zip_code = $_POST['zip_code'];
    $city = $_POST['city'];
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);

    //sprawdzenie poszczególnych danych
    if (strlen($name) < 3 || strlen($name) > 50) {
        $status_OK = false;
        $_SESSION['error_imie'] = "Imię musi posiadać od 3 do 50 znaków ";
        header('Location:register_form.php');
    }
    if (strlen($surname) < 3 || strlen($surname) > 50) {
        $status_OK = false;
        $_SESSION['error_nazwisko'] = "Nazwisko musi posiadać od 3 do 50 znaków ";
        header('Location:register_form.php');
    }

    if (ctype_alnum($login) == false) {
        $status_OK = false;
        $_SESSION['error_login'] = "Login może składać się tylko z liter i cyfr";
        header('Location:register_form.php');
    }
    if (strlen($password) < 6 || strlen($password) > 50) {
        $status_OK = false;
        $_SESSION['error_haslo'] = "Hasło musi posiadać od 6 do 50 znaków";
        header('Location:register_form.php');
    }
    $email_sanit = filter_var($email, FILTER_SANITIZE_EMAIL);
    if ((!filter_var($email, FILTER_VALIDATE_EMAIL)) || $email_sanit != $email) {
        $status_OK = false;
        $_SESSION['error_email'] = "<span class='error'>Nieprawidłowy adres email</span>";
        header('Location:register_form.php');
    }
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    if (strlen($street) < 3 || strlen($street) > 255) {
        $status_OK = false;
        $_SESSION['error_street'] = "Ulica musi posiadać od 3 do 255 znaków";
        header('Location:register_form.php');
    }
    if (strlen($house_number) > 5) {
        $status_OK = false;
        $_SESSION['error_house_number'] = "Numer domu musi posiadać do 5 znaków";
        header('Location:register_form.php');
    }
    if (strlen($zip_code) < 5 || strlen($zip_code) > 6) {
        $status_OK = false;
        $_SESSION['error_zip_code'] = "Podaj kod pocztowy w formacie 0000 lub 00-000";
        header('Location:register_form.php');
    }
    if (strlen($city) < 3 || strlen($city) > 255) {
        $status_OK = false;
        $_SESSION['error_city'] = "Miasto musi posiadać od 3 do 255 znaków";
        header('Location:register_form.php');
    }

    if ($status_OK) {
        try {
            //sprawdzanie czy login już istnieje
            $stmt = $pdo->prepare('SELECT * FROM users WHERE login = :login');
            $stmt->bindValue(':login', $login, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch();
            if ($result) {
                $_SESSION['error_login'] = "Podany login już istnieje";
                header('Location:register_form.php');
                exit();
            }

            //przygotowanie zapytania
            $stmt = $pdo->prepare("INSERT INTO users (name, surname, login, password, email, street, house_number, zip_code, city) VALUES (:name, :surname, :login, :password, :email, :street, :house_number, :zip_code, :city)");
            //podpięcie zmiennych do zapytania
            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            $stmt->bindValue(':surname', $surname, PDO::PARAM_STR);
            $stmt->bindValue(':login', $login, PDO::PARAM_STR);
            $stmt->bindValue(':password', $password_hash, PDO::PARAM_STR);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':street', $street, PDO::PARAM_STR);
            $stmt->bindValue(':house_number', $house_number, PDO::PARAM_STR);
            $stmt->bindValue(':zip_code', $zip_code, PDO::PARAM_STR);
            $stmt->bindValue(':city', $city, PDO::PARAM_STR);
            //wykonanie zapytania
            $stmt->execute();
            //sprawdzenie czy dane zostały zaktualizowane
            if ($stmt->rowCount() > 0) {
                //zapis do danych sesyjnych

                $_SESSION['logged'] = true;
                $_SESSION['name'] = $name;
                $_SESSION['surname'] = $surname;
                $_SESSION['login'] = $login;
                $_SESSION['password'] = $password;
                $_SESSION['email'] = $email;
                $_SESSION['street'] = $street;
                $_SESSION['house_number'] = $house_number;
                $_SESSION['zip_code'] = $zip_code;
                $_SESSION['city'] = $city;


                header('Location: account.php');
                exit();
            } else {
                $_SESSION['error_general'] = "Wystąpił problem podczas rejestracji. Spróbuj ponownie później.";
                header('Location: register_form.php');
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>