<?php
session_start();
include_once 'functions.php';
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>Administracja</title>

    <link rel="stylesheet" href="style.css">
</head>
<?php
menu('Administracja');
?>
<body>
<form action="admin_validation.php" method="post">
    <fieldset>
        <input type="text" name="admin_login" required placeholder="Login administratora" id="login">
        <?php
        if (isset($_SESSION['admin_login_error'])) {
            echo $_SESSION['admin_login_error'];
            unset($_SESSION['admin_login_error']);
        }
        ?>
        <br>
        <input type="password" name="admin_password"  placeholder="Hasło" id="admin_password" required>
        <br>
        <?php
        if (isset($_SESSION['admin_password_error'])) {
            echo $_SESSION['admin_password_error'];
            unset($_SESSION['admin_password_error']);
        }
        ?>

    </fieldset>
    <fieldset>

        <input type="submit" value="Zaloguj się">
        <br>

    </fieldset>
</form>
</body>
<?php
footer();
?>
</html>