<?php
session_start();
//sprawdzenie czy ktoś jest już zalogowany
if ((isset($_SESSION['logged'])) && ($_SESSION['logged'] == true)) {
    header('Location:account.php');
    exit();
}
require_once 'menu.php';
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>Strona administracyjna</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>
<form action="login_validation.php" method="post">
    <h1>Strona administracyjna</h1>
    <fieldset>

        <input type="text" name="login" required placeholder="Login administratora" id="login">
        <br>
        <input type="password" name="haslo"  required placeholder="Hasło" id="haslo" required>
        <br>
    </fieldset>
    <?php
    if (isset($_SESSION['login_error'])) {
        echo $_SESSION['login_error'];
        unset($_SESSION['login_error']);
    }
    ?>
    <fieldset>

        <input type="submit" value="Zaloguj się">
        <br>
        <br><a href="index.php">Przejdź do strony głównej</a>
    </fieldset>
</form>
</body>
</html>