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
    <div class="container">
        <?php
        echo "<script>alert('Wysłałem e-mail')</script>";
//        echo "Hejka!    Nadal jesteś zalogowany.        Wysłałem e-mail";
        header('Location: index.php')
        ?>
    </div>
    </body>
    </html>

<?php
footer();
?>