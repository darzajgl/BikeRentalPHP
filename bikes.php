<?php
session_start();

include_once 'functions.php';
require_once "db_config.php";
mysqli_report(MYSQLI_REPORT_STRICT);


if (isset($_POST['add'])) {
//    print_r($_POST['product_id']);
    if (isset($_SESSION['cart'])) {
//        print_r($_SESSION)['cart'];

        $item_array_id = array_column($_SESSION['cart'], 'product_id');
//        print_r($item_array_id);
        if (in_array($_POST['product_id'], $item_array_id)) { //sprawdzenie czy jest zawarty
            echo "<script>alert('Przedmiot jest już dodany do koszyka')</script>";
        } else {
            $count = count($_SESSION['cart']); //określenie wielkości array
            $item_array = array('product_id' => $_POST['product_id']);

            $_SESSION['cart'][$count] = $item_array;
//            print_r($_SESSION['cart']);
        }
    } else {
        $item_array = array(
            'product_id' => $_POST['product_id']
        );
        $_SESSION['cart'][0] = $item_array;
//        print_r($_SESSION['cart']);
    }
}


// Połączenie z bazą danych
try {
    $connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if ($connection->connect_errno !== 0) {
        throw new Exception((mysqli_connect_error()));
    }
} catch (Exception $error) {
    $_SESSION['error_server'] = $error->getMessage();
    header('Location:register_form.php');
}

if (!$connection) {
    echo "Błąd podczas łączenia z bazą danych: " . mysqli_connect_error();
}

if(isset($_POST['product_id'])) {
    header('Location: order_summary.php');
    exit;
}

menu('Strona główna');
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>Wybór roweru</title>
    <link rel="stylesheet" href="style.css">
    <link href='http://fonts.googleapis.com/css?family=Pacifico&subset=latin,latin-ext' rel='stylesheet'
          type="text/css">
</head>
<body>
<div id="container">
    <?php
    $sql = "SELECT * FROM bikes";
    $result = mysqli_query($connection, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        element($row['name'], $row['price'], $row['description'], $row['image'],$row['bike_id']);
    }
    ?>
</div>
</body>
</html>

<?php
footer();
// Zamknięcie połączenia z bazą danych
mysqli_close($connection);
?>

