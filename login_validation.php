<?php
session_start();
if (!isset($_POST['login']) || (!isset($_POST['password']))) {
    header('Location: index.php');
    exit();
}
// Pobierz informacje o bazie danych z pliku db_config.php
require_once 'db_config.php';
try {
//połączenie z bazą danych
    $connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if ($connection->connect_errno !== 0) {
        throw new Exception("<span style='color: red'>Błąd połączenia z bazą danych: {$connection->connect_errno}</span>");
    } else {
        $login = $_POST['login'];
        $password = $_POST['password'];

        //zabezpieczenie przed wstrzykiwaniem SQL
        $login = htmlentities($login, ENT_QUOTES, "UTF-8");

        if ($result = $connection->query(
            sprintf("SELECT * FROM users WHERE login='%s'",
                mysqli_real_escape_string($connection, $login)))) {

            if (mysqli_num_rows($result) > 0) {
                $row = $result->fetch_assoc();
                if (password_verify($password, $row['password'])) {

                    // flaga czy zalogowany
                    $_SESSION['logged'] = true;
                    //dane sesyjne

                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['surname'] = $row['surname'];
                    $_SESSION['login'] = $row['login'];
                    $_SESSION['password'] = $row['password'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['street'] = $row['street'];
                    $_SESSION['house_number'] = $row['house_number'];
                    $_SESSION['zip_code'] = $row['zip_code'];
                    $_SESSION['city'] = $row['city'];

                    //usunięcie zmiennej sesyjnej blędu
                    unset($_SESSION['login_error']);
                    $result->free_result();
                    //przekierowanie
                    header('Location:account.php');
                } else {
                    $_SESSION['login_error'] = 'Nieprawidłowy login lub hasło';
                    header('Location:login_form.php');
                }
            } else {
                $_SESSION['login_error'] = 'Nieprawidłowy login lub hasło';
                header('Location:login_form.php');
            }
            $connection->close();
        }
    }
} // obsłuż wyjątek
catch (Exception $error) {
    $_SESSION['login_error'] = $error->getMessage();
    header('Location:login_form.php');
}