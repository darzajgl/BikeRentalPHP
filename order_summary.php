<?php
session_start();

include_once 'functions.php';
require_once "db_config.php";
mysqli_report(MYSQLI_REPORT_STRICT);

// Połączenie z bazą danych
try {
    $connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if ($connection->connect_errno !== 0) {
        throw new Exception((mysqli_connect_error()));
    }
} catch (Exception $error) {
    $_SESSION['error_server'] = $error->getMessage();
    header('Location:index.php');
}

if (!$connection) {
    echo "Błąd podczas łączenia z bazą danych: " . mysqli_connect_error();
}


// sprawdzenie czy daty i produkt zostały wybrane
if (!isset($_SESSION['start_date']) || !isset($_SESSION['end_date']) || (!isset($_SESSION['cart']))) {
    header('Location: index.php');
}

// Pobieranie produktu z bazy danych
$id = $_SESSION['cart'][0]['product_id'];
$query = "SELECT * FROM bikes WHERE bike_id = $id";
$result = mysqli_query($connection, $query);
$product = mysqli_fetch_assoc($result);

$start_date = $_SESSION['start_date'];
$end_date = $_SESSION['end_date'];
$diff = date_diff(date_create($start_date), date_create($end_date));
$total_days = $diff->format("%a");

$total_price = 0;
$total_price = $product['price'] * $total_days;

$_SESSION['product_price'] = $product['price'];
$_SESSION['product_image'] = $product['image'];
$_SESSION['diff_days'] = $total_days;
$_SESSION['total_price'] = $total_price;

menu('Podsumowanie zamówienia');
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>Podsumowanie zamówienia</title>
    <link rel="stylesheet" href="style.css">
    <link href='http://fonts.googleapis.com/css?family=Pacifico&subset=latin,latin-ext' rel='stylesheet'
          type="text/css">
</head>

<body>
<div id="container">
    <form action="login_form.php" method="post">
        <div class="box">
            <div class="box-left">
                <img src="<?php echo $_SESSION['product_image']; ?>" alt="Zdjęcie" class="box-image">
            </div>
            <div class="box-center-left">
                <br><br>
                <p>Okres wypożyczenia</p>
                <p>od: <?php echo $_SESSION['start_date']; ?></p>
                <p>do: <?php echo $_SESSION['end_date']; ?></p>
            </div>
            <div class="box-center-right">
                <p>Cena/dzień: <?php echo $_SESSION['product_price']; ?> PLN</p>
                <p>Ilość dni: <?php echo $_SESSION['diff_days']; ?></p>
                <p>Cena całkowita: <?php echo $_SESSION['total_price']; ?> PLN</p>
            </div>
            <div class="box-right">
                <p><input type="submit" name="add" class="box-button" value="Zatwierdź zamówienie"></p>
            </div>
        </div>
    </form>
</div>
</body>
</html>
<?php
footer();
?>

