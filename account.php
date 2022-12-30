<?php
session_start();
include_once 'functions.php';
//if (!isset($_SESSION['logged'])) {
//    header('Location: index.php');
//}
?>

<!DOCTYPE html>
<html lang="pl-PL" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>Konto</title>
    <link rel="stylesheet" href="style.css">
</head>
<?php
menu('Konto');
?>
<body>
<form>
    <fieldset>
        <?php

        echo "<p>Witaj " . $_SESSION['imie'] . " " . $_SESSION['nazwisko'] . "!</p>";
        echo "<p><b>Twoje dane:</b></p>";
        echo "<p>Login: " . $_SESSION['login'] . "</p>";

        echo "<p>E-mail: " . $_SESSION['email'] . "</p>";
        echo "<p>Adres: " . $_SESSION['adres'] . "</p>";
        echo "<p>Wykształcenie: " . $_SESSION['wyksztalcenie'] . "</p>";
        echo "<p>Zainteresowania: " . $_SESSION['zainteresowania'] . "</p>";

//        echo "<a href ='logout.php'>Wyloguj się!</a>";
        echo"<br><br>";
        ?>
    </fieldset>
</form>
</body>
<?php
footer();
?>
</html>