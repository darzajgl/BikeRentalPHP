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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<?php
menu('Rejestracja');
?>
<body>
<form action="register_validation.php" method="post">
    <fieldset>
        <legend>Dane osobowe</legend>
        <input type="text" name="imie" required placeholder="Imię" id="imie">
        <?php
        if (isset($_SESSION['error_imie'])) {
            echo $_SESSION['error_imie'];
            unset($_SESSION['error_imie']);
        }
        ?>
        <br>

        <input type="text" name="nazwisko" required placeholder="Nazwisko" id="nazwisko">
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

        <input type="password" name="haslo" required placeholder="Hasło" id="haslo">
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
        <input type="text" name="ulica" required placeholder="Ulica" id="ulica"><br/>
        <input type="text" name="nr_domu" required placeholder="Nrumer domu/mieszkania" id="nr_domu"><br/>
        <input type="text" name="kod_pocztowy" required placeholder="Kod pocztowy" id="kod_pocztowy"><br/>
        <input type="text" name="miasto" required placeholder="Miasto" id="miasto"><br/>

        <?php
        if (isset($_SESSION['error_adres'])) {
            echo $_SESSION['error_adres'];
            unset($_SESSION['error_adres']);
        }
        ?>

    </fieldset>
<!--    <fieldset>-->
<!--        <legend>Wykształcenie</legend>-->
<!--        <input type="radio" id="podstawowe" name="wyksztalcenie" value="podstawowe">-->
<!--        <label for="podstawowe">Podstawowe</label></b>-->
<!--        <input type="radio" id="srednie" name="wyksztalcenie" value="srednie">-->
<!--        <label for="srednie">Średnie</label></b>-->
<!--        <input type="radio" id="wyzsze" name="wyksztalcenie" value="wyzsze">-->
<!--        <label for="wyzsze">Wyższe</label><br>-->
<!--    </fieldset>-->
<!--    <fieldset>-->
<!--        <legend>Zainteresowania</legend>-->
<!--        <input type="checkbox" id="sport" name="zainteresowania[]" value="sport">-->
<!--        <label for="sport">Sport</label><br>-->
<!--        <input type="checkbox" id="kultura" name="zainteresowania[]" value="kultura">-->
<!--        <label for="kultura">Kultura</label><br>-->
<!--        <input type="checkbox" id="podroze" name="zainteresowania[]" value="podroze">-->
<!--        <label for="podroze">Podróże</label><br>-->
<!--        <input type="checkbox" id="podroze" name="zainteresowania[]" value="kino">-->
<!--        <label for="kino">Kino</label><br>-->
<!--        <input type="checkbox" id="kino" name="zainteresowania[]" value="muzyka">-->
<!--        <label for="muzyka">Muzyka</label><br>-->
<!--    </fieldset>-->
    <fieldset>
        <div class="g-recaptcha" data-sitekey="6Lcz2Z0jAAAAALipOlsa3fPD1iNdwUzZ41M5RHG4"></div>
        <input type="submit" value="Zarejestruj się">
    </fieldset>

</form>
</body>
<?php
footer();
?>
</html>

