<?php
session_start();
require_once 'functions.php';
if (isset($_SESSION['error_server'])) {
    echo $_SESSION['error_server'];
    unset($_SESSION['error_server']);
}
?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="utf-8">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="style.css">
<!--    <script src="https://www.google.com/recaptcha/api.js" async defer></script>-->
</head>
<?php
menu('Rejestracja');
?>
<body>
<form action="register_validation.php" method="post">
    <fieldset>
        <legend>Dane osobowe</legend>
        <input type="text" name="name" required placeholder="Imię" id="name">
        <?php
        if (isset($_SESSION['error_imie'])) {
            echo $_SESSION['error_imie'];
            unset($_SESSION['error_imie']);
        }
        ?>
        <br>

        <input type="text" name="surname" required placeholder="Nazwisko" id="surname">
        <?php
        if (isset($_SESSION['error_nazwisko'])) {
            echo $_SESSION['error_nazwisko'];
            unset($_SESSION['error_nazwisko']);
        }
        ?>

        <br>
        <input type="text" name="login" required placeholder="Login" id="login">
        <?php
        if (isset($_SESSION['error_login'])) {
            echo $_SESSION['error_login'];
            unset($_SESSION['error_login']);
        }
        ?>

        <br>

        <input type="password" name="password" required placeholder="Hasło" id="password">
        <?php
        if (isset($_SESSION['error_haslo'])) {
            echo $_SESSION['error_haslo'];
            unset($_SESSION['error_haslo']);
        }
        ?>

        <br>
        <input type="email" name="email" required placeholder="Adres e-mail" id="email">
        <?php
        if (isset($_SESSION['error_email'])) {
            echo '<span class="error">' . $_SESSION['error_email'] . '</span>';
            unset($_SESSION['error_email']);
        }
        ?>

    </fieldset>
    <fieldset>
        <legend>Dane adresowe</legend>
        <input type="text" name="street" required placeholder="Ulica" id="street"><br/>
        <?php
        if (isset($_SESSION['error_street'])) {
            echo $_SESSION['error_street'];
            unset($_SESSION['error_street']);
        }
        ?>
        <input type="text" name="house_number" required placeholder="Numer domu/mieszkania" id="house_number"><br/>
        <?php
        if (isset($_SESSION['error_house_number'])) {
            echo $_SESSION['error_house_number'];
            unset($_SESSION['error_house_number']);
        }
        ?>
        <input type="text" name="zip_code" required placeholder="Kod pocztowy" id="zip_code"><br/>
        <?php
        if (isset($_SESSION['error_zip_code'])) {
            echo $_SESSION['error_zip_code'];
            unset($_SESSION['error_zip_code']);
        }
        ?>
        <input type="text" name="city" required placeholder="Miasto" id="city"><br/>

        <?php
        if (isset($_SESSION['error_city'])) {
            echo $_SESSION['error_city'];
            unset($_SESSION['error_city']);
        }
        ?>

    </fieldset>
    <fieldset>
<!--        <div class="g-recaptcha" data-sitekey="6Lcz2Z0jAAAAALipOlsa3fPD1iNdwUzZ41M5RHG4"></div>-->
        <input type="submit" value="Zarejestruj się">
    </fieldset>

</form>
</body>
<?php
footer();
?>
</html>

