<?php
session_start();

include_once 'functions.php';
require_once "db_config.php";

/// sprawdź czy admin zalogowany
if (!isset($_SESSION['logged']) || (!$_SESSION['logged'])) {
    header('Location: login_form.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Połączenie z bazą danych przy użyciu PDO
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
} catch (PDOException $error) {
    $_SESSION['error_server'] = $error->getMessage();
    header('Location:index.php');
}

menu('Historia zamówień');
?>

    <!DOCTYPE html>
    <html lang="pl-PL">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        <title>Historia zamówień</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
    <div class="wrapper">

        <?php
        //Zapytanie do bazy danych, które wybierze wszystkie kolumny z retnals
        $stmt = $pdo->prepare("SELECT users.name, users.surname, bikes.name as 'bike', rentals.start_date, rentals.end_date, rentals.rental_id
FROM rentals
JOIN users ON rentals.user_id=users.user_id
JOIN bikes ON rentals.bike_id=bikes.bike_id
WHERE users.user_id = $user_id");
        $stmt->execute();
        //Pobieranie danych z bazy danych
        $result = $stmt->fetchAll();
        ?>
        <br>
        <table border="1">
            <tr>
                <th>Imię</th>
                <th>Nazwisko</th>
                <th>Rower</th>
                <th>Data wypożyczenia</th>
                <th>Data zwrotu</th>

            </tr>
            <?php
            //iteracja po kolejnych wierszach
            foreach ($result as $row) {
                echo "<tr>
<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['surname'] . "</td>";
                echo "<td>" . $row['bike'] . "</td>";
                echo "<td>" . $row['start_date'] . "</td>";
                echo "<td>" . $row['end_date'] . "</td>";
                echo "</tr>";
            }
            ?>
        </table>

     </div>
    </body>
    </html>
<?php
footer();
// Zamknięcie połączenia z bazą danych
$pdo = null;
?>