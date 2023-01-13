<?php
session_start();
include_once 'functions.php';

menu('Informacje');
?>
    <!DOCTYPE html>
    <html lang="pl-PL">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        <title>Informacje</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <div class="wrapper">
        <?php
        echo "Twoje zamówienie zostało złożone prawidłowo. Przesłaliśmy wiadomość e-mail z potwierdzeniem.";
        $_SESSION['order_placed'] = false;
        unset($_SESSION['bike_id']);
        unset($_SESSION['end_date']);
        unset($_SESSION['start_date']);
        ?>
        <hr>
        <a href="date_picker.php" class="box-button">Złóż kolejne zamówienie</a>
        <hr>
        <a href="logout.php" class="box-button">Wyloguj się!</a>
    </div>
    </body>
    </html>
<?php
footer();
?>