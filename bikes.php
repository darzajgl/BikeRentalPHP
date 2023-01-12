<?php
session_start();

include_once 'functions.php';
require_once "db_config.php";

// Połączenie z bazą danych przy użyciu PDO
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $_SESSION['error_server'] = $e->getMessage();
    header('Location:index.php');
}

// Zabezpieczenie przed SQL injection poprzez użycie prepared statements
if (isset($_POST['product_id'])) {
    $query = $pdo->prepare("SELECT * FROM bikes WHERE bike_id = :id");
    $query->bindValue(':id', $_POST['product_id'], PDO::PARAM_INT);
    $query->execute();
    $product = $query->fetch();

    //Zapisywanie informacji o rowerze do zmiennych sesyjnych
    $_SESSION['bike_id'] = $product['bike_id'];
    $_SESSION['bike_name'] = $product['name'];
    $_SESSION['price'] = $product['price'];
    $_SESSION['description'] = $product['description'];
    $_SESSION['image'] = $product['image'];

    header('Location: order_summary.php');
    exit;
}


//if(isset($_POST['product_id'])) {
//    $_SESSION['bike_id'] = $_POST['product_id'];
//    header('Location: order_summary.php');
//    exit;
//}

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
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            element($row['name'], $row['price'], $row['description'], $row['image'],$row['bike_id']);
        }
        ?>
    </div>
    </body>
    </html>
<?php
footer();
// Zamknięcie połączenia z bazą danych ustawiając wartość NULL
$pdo = null;
?>