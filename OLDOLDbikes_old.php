<?php
session_start();

include_once 'functions.php';
require_once "db_config.php";

// Połączenie z bazą danych przy użyciu PDO
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
} catch (PDOException $error) {
    $_SESSION['error_server'] = $error->getMessage();
    header('Location:register_form.php');
}

if (isset($_POST['add'])) {
    if (isset($_SESSION['cart'])) {
        $item_array_id = array_column($_SESSION['cart'], 'product_id');
        if (in_array($_POST['product_id'], $item_array_id)) { //sprawdzenie czy jest zawarty
            echo "<script>alert('Przedmiot jest już dodany do koszyka')</script>";
        } else {
            $count = count($_SESSION['cart']); //określenie wielkości array
            $item_array = array('product_id' => $_POST['product_id']);

            $_SESSION['cart'][$count] = $item_array;
        }
    } else {
        $item_array = array(
            'product_id' => $_POST['product_id']
        );
        $_SESSION['cart'][0] = $item_array;
    }
}

if (isset($_POST['product_id'])) {
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
    $result = mysqli_query($pdo, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        element($row['name'], $row['price'], $row['description'], $row['image'], $row['bike_id']);
    }
    ?>
</div>
</body>
</html>

<?php
footer();
// Zamknięcie połączenia z bazą danych
$pdo = null;
?>

