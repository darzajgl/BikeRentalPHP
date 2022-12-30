<?php
SESSION_START();
include_once 'functions.php';
require_once "db_config.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//mysqli_report(MYSQLI_REPORT_STRICT);
//połączenie z DB


try {
    $connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if ($connection->connect_errno !== 0) {
        throw new Exception((mysqli_connect_error()));
    } else {
            $connection->close();
        }

} catch
(Exception $error) {
    $_SESSION['error_server'] = $error->getMessage();
    header('Location:register_form.php');

}

if (!$connection) {
    echo "Błąd podczas łączenia z bazą danych: " . mysqli_connect_error();
} else {
    echo "Połączenie z bazą danych zostało nawiązane.";
}
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>Strona główna</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://fonts.googleapis.com/css?family=Pacifico&subset=latin,latin-ext' rel='stylesheet'
          type="text/css">
</head>
<?php
//menu('Strona główna');
//?>
<body>
<div id="container">
<!---->
<!--        --><?php
//        $sql = "SELECT * FROM bikes";
//        $result = mysqli_query($connection, $sql);
//        while ($row = mysqli_fetch_assoc($result)) {
//
//            element($row['name'], $row['price'], $row['description'], $row['image']);
            element('Rower', '6666', 'rowerek','images/gravel1.jpg');
//        }
        ?>

    <!--
        <div class="box">
            <div class="box-left">
                <img src="images/gravel1.jpg" alt="Zdjęcie roweru" class="box-image">
            </div>
            <div class="box-center">
                <h3 class="box-name">ROWER111</h3>
                <p class="box-description">Szybki rower</p>
            </div>
            <div class="box-right">
                <p class="box-price">Cena: 6666 PLN</p>
                <button type="submit" class="box-button">Dodaj</button>
            </div>
        </div>


        <div class="box">
            <div class="box-left">
                <img src="images/city1.jpg" alt="Zdjęcie roweru" class="box-image">
            </div>
            <div class="box-center">
                <h3 class="box-name">ROWER111</h3>
                <p class="box-description">Szybki rower</p>
            </div>
            <div class="box-right">
                <p class="box-price">Cena: 6666 PLN</p>
                <button type="submit" class="box-button">Dodaj</button>
            </div>
        </div>
        <div class="box">
            <div class="box-left">
                <img src="images/road1.jpg" alt="Zdjęcie roweru" class="box-image">
            </div>
            <div class="box-center">
                <h3 class="box-name">ROWER111</h3>
                <p class="box-description">Szybki rower</p>
            </div>
            <div class="box-right">
                <p class="box-price">Cena: 6666 PLN</p>
                <button type="submit" class="box-button">Dodaj</button>
            </div>
        </div>

        <div class="box">
            <div class="box-left">
                <img src="images/electric1.jpg" alt="Zdjęcie roweru" class="box-image">
            </div>
            <div class="box-center">
                <h3 class="box-name">ROWER111</h3>
                <p class="box-description">Szybki rower</p>
            </div>
            <div class="box-right">
                <p class="box-price">Cena: 6666 PLN</p>
                <button type="submit" class="box-button">Dodaj</button>
            </div>
        </div>

        -->

</div>
</body>
<?php
footer();
?>
</html>