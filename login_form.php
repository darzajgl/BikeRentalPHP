<?php
session_start();
include_once 'functions.php';
//sprawdzenie czy ktoś jest już zalogowany
if ((isset($_SESSION['logged'])) && ($_SESSION['logged'] == true)) {
    header('Location:account.php');
    exit();
}
require_once 'functions.php';
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>Logowanie</title>

    <link rel="stylesheet" href="style.css">
</head>
<?php
menu('Logowanie');
?>
<body>
<div class="wrapper">
    <form action="login_validation.php" method="post">
        <fieldset>

            <input type="text" name="login" required placeholder="login" id="login">
            <?php
            if (isset($_SESSION['login_error'])) {
                echo $_SESSION['login_error'];
                unset($_SESSION['login_error']);
            }
            ?>
            <br>
            <input type="password" name="password" placeholder="Hasło" id="password" required>
            <br>
        </fieldset>
        <?php
        if (isset($_SESSION['password_error'])) {
            echo $_SESSION['password_error'];
            unset($_SESSION['password_error']);
        }
        ?>
        <fieldset>

            <input type="submit" class="box-button" value="Zaloguj się">
            <p>Nie masz konta?</p>
            <a href="register_form.php" class="box-button">Zarejestruj się!</a>

        </fieldset>
    </form>
</div>
</body>
<?php
footer();
?>
</html>