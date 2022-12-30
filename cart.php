<?php

session_start();
//require_once "db_config.php";
require_once "functions.php";

//try {
//    $connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
//    if ($connection->connect_errno !== 0) {
//        throw new Exception((mysqli_connect_errno()));
//    }
//} catch
//(Exception $error) {
//    $_SESSION['error_server'] = $error->getMessage();
//    header('Location: index.php');
//}
//
////usuwanie przedmiotu z koszyka
//if (isset($_POST['remove'])) {
//    if ($_GET['action'] == 'remove') {
//        foreach ($_SESSION['cart'] as $key => $value) {
//            if ($value["product_id"] == $_GET['id']) {
//                unset($_SESSION['cart'][$key]);
//                echo "<script>alert('Przedmiot usunięty z koszyka')</script>";
//                echo "<script>window.location = 'cart.php'</script>";
//            }
//        }
//    }
//}

?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="utf-8">
    <title>Koszyk</title>
    <link rel="stylesheet" href="style.css">
    <!-- style.css -->
    <link rel="stylesheet" href="style.css">

</head>
<?php
menu('Koszyk');
?>
<body>

<div class="container-fluid">
    <div class="row px-5">
        <div class="col-md-7">
            <div class="shopping-cart">
                <h5>Mój koszyk</h5>
                <hr>

<!--                --><?php
//                $total_amount = 0;
//                if (isset($_SESSION['cart'])) {
//                    $product_id = array_column($_SESSION['cart'], 'product_id');
//
//                    $sql = "SELECT * FROM products";
//                    $result = mysqli_query($connection, $sql);
//                    while ($row = mysqli_fetch_assoc($result)) {
//                        foreach ($product_id as $id) {
//                            if ($row['id'] == $id) {
//                                cartItem($row['name'], $row['price'], $row['image'], $row['id']);
//                                $total_amount += (int)$row['price'];
//                            }
//                        }
//                    }
//                } else {
//                    echo "<h5>Koszyk jest pusty</h5>";
//                }
//
//                ?>
            </div>
        </div>
        <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">

            <div class="pt-4">
                <h5>SZCZEGÓŁY ZAMÓWIENIA</h5>
                <hr>
                <div class="row price-details">
                    <div class="col-md-6">
<!--                        --><?php
//                        if (isset($_SESSION['cart'])) {
//                            $count = count($_SESSION['cart']);
//                            echo "<h5>Cena za $count produktów</h5>";
//                        } else {
//                            echo "<h5>Brak produktów w koszyku</h5>";
//                        }
//                        ?>
                        <h5>Opłata za wysyłkę</h5>
                        <hr>
                        <h5>Kwota do zapłaty</h5>
                    </div>
                    <div class="col-md-6">
<!--                        <h5>--><?php //echo $total_amount; ?><!-- PLN</h5>-->
<!--                        6655
                        <h5 class="text-success">Za darmo!</h5>
                        <hr>6666 PLN
<!--                        <h5>--><?php
//                            echo $total_amount;
                            ?> PLN</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="container">

</div>
</body>
<?php
footer();
?>
</html>
