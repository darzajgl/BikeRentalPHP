<?php

session_start();

require_once "db_config.php";
require_once "functions.php";

try {
    $connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if ($connection->connect_errno !== 0) {
        throw new Exception((mysqli_connect_errno()));
    }
} catch (Exception $error) {
    $_SESSION['error_server'] = $error->getMessage();
    header('Location: index.php');
}

//usuwanie przedmiotu z koszyka
if (isset($_POST['remove'])) {
    if ($_GET['action'] == 'remove') {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value["product_id"] == $_GET['id']) {
                unset($_SESSION['cart'][$key]);
                echo "<script>alert('Przedmiot usunięty z koszyka')</script>";
                echo "<script>window.location = 'cart.php'</script>";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="utf-8">
    <title>Koszyk</title>
    <link rel="stylesheet" href="style.css">
</head>
<?php
menu('Koszyk');
?>
<body>

<div id="container">
    <?php
    $total_amount = 0;
    if (isset($_SESSION['cart'])) {
        $product_id = array_column($_SESSION['cart'], 'product_id');

        $sql = "SELECT * FROM bikes";
        $result = mysqli_query($connection, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            foreach ($product_id as $id) {
                if ($row['bike_id'] == $id) {
                    cartItem($row['name'], $row['price'], $row['image'], $row['bike_id']);
                    $total_amount += (int)$row['price'];
                }
            }
        }
    } else {
        echo "<h5>Koszyk jest pusty</h5>";
    }
    ?>
</div>

<div id="container">
    <h5>SZCZEGÓŁY ZAMÓWIENIA</h5>
    <div class="box">
        <h3 class="box-name">

            <?php
            if (isset($_SESSION['cart'])) {
                $count = count($_SESSION['cart']);
                echo "<h5>Cena za $count produktów: $total_amount PLN</h5>";
            } else {
                echo "<h5>Brak produktów w koszyku</h5>";
            }
            ?>
        </h3>
        <div class="box-center">
            <h5>Opłata za wysyłkę: Za darmo!</h5>
        </div>
        <div class="box-right">
            <p class="box-price">Całkowita cena: <?php echo $total_amount; ?> PLN</p>
        </div>
    </div>
</div>
</body>
<?php
footer();
// Zamknięcie połączenia z bazą danych
mysqli_close($connection);
?>
</html>