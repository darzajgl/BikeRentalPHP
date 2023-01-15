<?php
session_start();

include_once 'functions.php';
require_once "db_config.php";

/// sprawdź czy admin zalogowany
if (!isset($_SESSION['admin_logged']) || (!$_SESSION['admin_logged'])) {
    header('Location: admin_form.php');
    exit();
}

// Połączenie z bazą danych przy użyciu PDO
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
} catch (PDOException $error) {
    $_SESSION['error_server'] = $error->getMessage();
    header('Location:index.php');
}


if (isset($_POST['delete_rental'])) {
    $rental_id = $_POST['rental_id'];
    delete_rental($rental_id, $pdo);
}
if (isset($_POST['delete_bike'])) {
    $bike_id = $_POST['bike_id'];
    delete_bike($bike_id, $pdo);
}
//sortowanie

//zapytanie
$query = "SELECT users.name, users.surname, bikes.name as 'bike', rentals.start_date, rentals.end_date, rentals.rental_id
FROM rentals
JOIN users ON rentals.user_id=users.user_id
JOIN bikes ON rentals.bike_id=bikes.bike_id";

if (isset($_GET['sort']) && $_GET['sort'] == 'name') {
    $query .= " ORDER BY name";
}
if (isset($_GET['sort']) && $_GET['sort'] == 'surname') {
    $query .= " ORDER BY surname";
}
if (isset($_GET['sort']) && $_GET['sort'] == 'bike') {
    $query .= " ORDER BY bike";
}
if (isset($_GET['sort']) && $_GET['sort'] == 'start_date') {
    $query .= " ORDER BY start_date";
}
if (isset($_GET['sort']) && $_GET['sort'] == 'end_date') {
    $query .= " ORDER BY end_date";
}

$stmt = $pdo->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll();


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
    <div class="wrapper">
        <div style="padding:  10px 100px;">
            <a href="logout.php"><input type="button" class="box-button" value="Wyloguj się"></a>
        </div>
        <hr>

        <?php
        //Zapytanie do bazy danych, które wybierze wszystkie kolumny z retnals
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        //Pobieranie danych z bazy danych
        $result = $stmt->fetchAll();
        ?>
        <h2 style="padding:  0 100px;">Wypożyczenia</h2>
        <div style="padding:  10px 100px;">
            <a href="add_rental.php"><input type="button" class="box-button"  value="Dodaj Zamówienie Ręcznie"></a>
        </div>

        <table border="1">
            <tr>
                <th><a href="?sort=name">Imię</a></th>
                <th><a href="?sort=surname">Nazwisko</a></th>
                <th><a href="?sort=bike">Rower</a></th>
                <th><a href="?sort=start_date">Data wypożyczenia</a></th>
                <th><a href="?sort=end_date">Data zwrotu</a></th>
                <th>Usuń</th>
                <th>Edytuj</th>
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
                echo "<td>
<form action='' method='post'>
<input type='hidden' name='rental_id' value='" . $row['rental_id'] . "'>
<input type='submit' name='delete_rental' value='Usuń' class = 'box-button'
                         onclick='return confirm(\"Czy na pewno chcesz usunąć rekord?\");'>
</form>
</td>";
                echo "<td><form action='edit_rental.php' method='get'>
<input type='hidden' name='rental_id' value='" . $row['rental_id'] . "'>
<input type='submit' value='Edytuj' class = 'box-button'/>
</form></td>";
                echo "</tr>";
            }
            ?>
        </table>
        <hr>
        <h2 style="padding:  0 100px;">Rowery</h2>
        <br>

        <?php

        // Tworzenie zapytania SQL, które wybiera wszystkie kolumny z tabeli bikes
        $stmt = $pdo->prepare("SELECT * FROM bikes");
        $stmt->execute();
        // Pobranie wyniku zapytania
        $result = $stmt->fetchAll();
        ?>
        <a style="padding: 100px;" href="add_bike.php"><input type="button" class="box-button" value="Dodaj Rower"></a>
        <!-- Tabela z danymi z tabeli bikes -->
        <table border="1">
            <tr>
                <th>Nazwa</th>
                <th>Opis</th>
                <th>Obraz</th>
                <th>Cena</th>
                <th>Usuń</th>
                <th>Edytuj</th>
            </tr>
            <?php
            // Iteracja po kolejnych wierszach
            foreach ($result as $row) {
                echo "<tr>
                      <td>" . $row['name'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";
                echo "<td>" . $row['image'] . "</td>";
                echo "<td>" . $row['price'] . "</td>";
                echo "<td>
                        <form action='' method='post'>
<input type='hidden' name='bike_id' value='" . $row['bike_id'] . "'>
<input type='submit' name='delete_bike' value='Usuń' class = 'box-button'
onclick='return confirm(\"Czy na pewno chcesz usunąć rekord?\");'>
                        
</form></td>";

                echo "<td>
                      <form action='edit_bike.php' method='get'>
                        <input type='hidden' name='bike_id' value='" . $row['bike_id'] . "'>
                        <input type='submit' name='edit' value='Edytuj' class = 'box-button' >
                      </form></td>";
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