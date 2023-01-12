<?php
session_start();

include_once 'functions.php';
require_once "db_config.php";
mysqli_report(MYSQLI_REPORT_STRICT);

/// Połączenie z bazą danych przy użyciu PDO
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
} catch (PDOException $error) {
    $_SESSION['error_server'] = $error->getMessage();
    header('Location:index.php');
}


if (isset($_POST['delete'])) {
    $rental_id = $_POST['rental_id'];
    delete_rental($rental_id, $pdo);
//    $stmt = $pdo->prepare('DELETE FROM rentals WHERE rental_id = :rental_id');
//    $stmt->bindParam(':rental_id', $rental_id, PDO::PARAM_INT);
//    $stmt->execute();
//    header('Location: ' . $_SERVER['PHP_SELF']);
    //echo '<meta http-equiv="refresh" content="0">';
//    exit;
}


//if (isset($_POST['add'])) {
//    try {
//        date_check($_POST['start_date'], $_POST['end_date']);
//        header('Location: bikes.php');
//    } catch (Exception $e) {
//        $error_message = $e->getMessage();
//    }
//}


menu('Panel Administratora');
?>
    <!DOCTYPE html>
    <html lang="pl-PL">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        <title>Panel Administratora</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <div id="container">
        <?php
        //Tworzenie obiektu PDO
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
        //Konfiguracja PDO
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        //Zapytanie do bazy danych
        $stmt = $pdo->prepare("SELECT users.name, users.surname, bikes.name as 'bike', rentals.start_date, rentals.end_date, rentals.rental_id
        FROM rentals
        JOIN users ON rentals.user_id=users.user_id
        JOIN bikes ON rentals.bike_id=bikes.bike_id");
        $stmt->execute();
        //Pobieranie danych z bazy danych
        $result = $stmt->fetchAll();
        ?>
        <table border="1">
            <tr>
                <th>Imię</th>
                <th>Nazwisko</th>
                <th>Rower</th>
                <th>Data wypożyczenia</th>
                <th>Data zwrotu</th>
                <th>Usuń</th>
                <th>Edytuj</th>
            </tr>
            <?php
            //iteracja po kolejnych wierszach
            foreach($result as $row) {
                echo "<tr>
                      <td>" . $row['name'] . "</td>";
                echo "<td>" . $row['surname'] . "</td>";
                echo "<td>" . $row['bike'] . "</td>";
                echo "<td>" . $row['start_date'] . "</td>";
                echo "<td>" . $row['end_date'] . "</td>";
                echo "<td>
                            <form action='' method='post'>
                            <input type='hidden' name='rental_id' value='" . $row['rental_id'] . "'>
                            <input type='submit' name='delete' value='Usuń'
                            onclick='return confirm(\"Czy na pewno chcesz usunąć rekord?\");'>
                            </form>
                            </td>";
                echo "<td><a href='edit_rental.php?rental_id=" . $row['rental_id'] . "'>LINK DO NIKĄD</a></td>";
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