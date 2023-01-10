<?php
session_start();
//wylogowanie użytkownika, jeśli był zalogowany
$_SESSION['logged'] = false;


if (isset($_POST['imie'])) {
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
    $haslo_hash = password_hash($password, PASSWORD_DEFAULT);

    if (strlen($street) < 3 || strlen($street) > 255) {
        $status_OK = false;
        $_SESSION['error_street'] = "Ulica musi posiadać od 3 do 255 znaków";
        header('Location:register_form.php');
    }
    if (strlen($house_number) > 5) {
        $status_OK = false;
        $_SESSION['error_house_number'] = "Ulica musi posiadać do 5 znaków";
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

    require_once "db_config.php";
    mysqli_report(MYSQLI_REPORT_STRICT);

    try {
        $connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if ($connection->connect_errno !== 0) {
            throw new Exception((mysqli_connect_errno()));
        } else {
            //sprawdzenie czy email istnieje w bazie danych
            $result = $connection->query("SELECT user_id FROM users WHERE email='$email'");

            if (!$result) throw new Exception(mysqli_error($connection));

            //sprawdzenie czy podany email istnieje w bazie danyc
            $how_many_emails = mysqli_num_rows($result);
            if ($how_many_emails > 0) {
                $status_OK = false;
                $_SESSION['error_email'] = "Konto z podanym adresem e-mail już istnieje";
                header('Location:register_form.php');
            } else {
                // sprawdzenie czy login już istnieje w bazie danych
                $result = mysqli_query($connection, "SELECT user_id FROM users WHERE login='$login'");

                if (!$result) {
                    throw new Exception(mysqli_error($connection));
                }

                $how_many_logins = mysqli_num_rows($result);
                if ($how_many_logins > 0) {
                    $status_OK = false;
                    $_SESSION['error_login'] = "Istnieje już taki login. Wprowadź inny.";
                    header('Location:register_form.php');
                }

                if ($status_OK == true) {
                    //kwerenda zapisu do bazy danych
                    if ($connection->query("INSERT INTO users (name, surname, login, password, email, street, house_number, zip_code, city)
VALUES ('$name', '$surname', '$login', '$haslo_hash', '$email', '$street', '$house_number','$zip_code','$city')")) ;
                    $_SESSION['success_registration'] = true;
                    $_SESSION['logged'] = true;

                    //dane sesyjne
                    $_SESSION['name'] = $name;
                    $_SESSION['surname'] = $surname;
                    $_SESSION['login'] = $login;
                    $_SESSION['password'] = $password;
                    $_SESSION['email'] = $email;
                    $_SESSION['street'] = $street;
                    $_SESSION['house_number'] = $house_number;
                    $_SESSION['zip_code'] = $zip_code;
                    $_SESSION['city'] = $city;

                    header('Location:account.php');
                }
                //zamknięcie połączenia
                $connection->close();
            }
        }
    } catch
    (Exception $error) {
        $_SESSION['error_server'] = $error->getMessage();
        header('Location:register_form.php');
    }
}

?>
