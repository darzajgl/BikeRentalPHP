<?php
session_start();

include_once 'functions.php';


// sprawdzenie czy daty i produkt zostały wybrane
if (!isset($_SESSION['start_date']) || !isset($_SESSION['end_date']) || (!isset($_SESSION['bike_id']))) {
    header('Location: index.php');
}




//$first_item_id = $bike['bike_id'];
//$first_item_name = $bike['name'];
// Pobieranie produktu z bazy danych
//$id = $_SESSION['bike_id'];
//$query = "SELECT * FROM bikes WHERE bike_id = $id";
//$result = mysqli_query($connection, $query);
//$product = mysqli_fetch_assoc($result);


//$id = $_SESSION['cart'][0]['product_id'];
//$query = "SELECT * FROM bikes WHERE bike_id = $id";
//$result = mysqli_query($connection, $query);
//$product = mysqli_fetch_assoc($result);

$start_date = $_SESSION['start_date'];
$end_date = $_SESSION['end_date'];
$product_price = $_SESSION['price'];
$diff = date_diff(date_create($start_date), date_create($end_date));
$total_days = $diff->format("%a");


$total_price = 0;
$total_price = $product_price * $total_days;

//zapisanie w zmiennej sesyjnej
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
</head>
<body>
<div id="container">
    <form action="login_form.php" method="post">
        <div class="box">
            <div class="box-left">
                <img src="<?php echo $_SESSION['image']; ?>" alt="Zdjęcie" class="box-image">
            </div>
            <div class="box-center-left">
                <br><br>
                <p><b><?php echo $_SESSION['bike_name']; ?></b></p>
                <p>Okres wypożyczenia</p>
                <p>od: <?php echo $_SESSION['start_date']; ?></p>
                <p>do: <?php echo $_SESSION['end_date']; ?></p>
            </div>
            <div class="box-center-right">
                <p>Cena/dzień: <?php echo $_SESSION['price']; ?> PLN</p>
                <p>Ilość dni: <?php echo $_SESSION['diff_days']; ?></p>
                <p>Cena całkowita: <?php echo $_SESSION['total_price']; ?> PLN</p>
            </div>
            <div class="box-right">
                <p><input type="submit" name="add" class="box-button" value="Zatwierdź zamówienie"></p>
                <p><a href="bikes.php" class="box-button">Powrót do wyboru roweru</a></p>
            </div>
        </div>
    </form>
</div>
</body>
</html>
<?php
footer();
?>

