<?php
session_start();
include_once 'functions.php';
require_once "db_config.php";

$rental_id = $_GET['rental_id'];

// Połączenie z bazą danych przy użyciu PDO
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
} catch (PDOException $error) {
    $_SESSION['error_server'] = $error->getMessage();
    header('Location:index.php');
}

// Pobieranie danych o wypożyczeniu z bazy danych na podstawie rental_id
$stmt = $pdo->prepare("SELECT * FROM rentals WHERE rental_id = :rental_id");
$stmt->bindValue(':rental_id', $rental_id, PDO::PARAM_INT);
$stmt->execute();
$rental = $stmt->fetch();

// Pobieranie danych o użytkowniku z bazy danych na podstawie user_id
$stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = :user_id");
$stmt->bindValue(':user_id', $rental['user_id'], PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch();

// Pobieranie danych o rowerze z bazy danych na podstawie bike_id

$stmt = $pdo->prepare("SELECT * FROM bikes WHERE bike_id = :bike_id");
$stmt->bindValue(':bike_id', $rental['bike_id'], PDO::PARAM_INT);
$stmt->execute();
$bike = $stmt->fetch();

// Tworzenie zmiennych z danych pobranych z bazy danych
$user_name = $user['name'];
$user_surname = $user['surname'];
$bike_name = $bike['name'];
$start_date = $rental['start_date'];
$end_date = $rental['end_date'];

// Jeśli formularz zostanie wysłany
if (isset($_POST['submit'])) {
// Pobranie danych z formularza
    $user_id = $_POST['user_id'];
    $bike_id = $_POST['bike_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

// Walidacja danych
    $errors = [];
    if (empty($user_id)) {
        $errors[] = 'Wybierz użytkownika';
    }
    if (empty($bike_id)) {
        $errors[] = 'Wybierz rower';
    }
    if (empty($start_date)) {
        $errors[] = 'Podaj datę wypożyczenia';
    }
    if (empty($end_date)) {
        $errors[] = 'Podaj datę zwrotu';
    }
    if (strtotime($start_date) > strtotime($end_date)) {
        $errors[] = 'Data zwrotu musi być późniejsza niż data wypożyczenia';
    }
    if (empty($errors)) {
        // Aktualizacja danych w bazie danych
        $stmt = $pdo->prepare("UPDATE rentals SET user_id = :user_id, bike_id = :bike_id, start_date = :start_date, end_date = :end_date WHERE rental_id = :rental_id");
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':bike_id', $bike_id, PDO::PARAM_INT);
        $stmt->bindValue(':start_date', $start_date, PDO::PARAM_STR);
        $stmt->bindValue(':end_date', $end_date, PDO::PARAM_STR);
        $stmt->bindValue(':rental_id', $rental_id, PDO::PARAM_INT);
        $stmt->execute();

        // Przekierowanie do panelu administratora
        header('Location: admin_panel.php');
    } else {
        // Wyświetlenie błędów
        echo '<ul>';
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo '</ul>';
    }
}

menu('Edycja wypożyczenia');
?>
    <!DOCTYPE html>
    <html lang="pl-PL">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        <title>Edycja wypożyczenia</title>
        <link rel="stylesheet" href="style.css">
    </head>
<body>
<div id="container">
    <form method="post">
    <label>
        Użytkownik:
        <select name="user_id">
            <?php
            // Pobieranie danych o użytkownikach z bazy danych
            $stmt = $pdo->query("SELECT * FROM users");
            $users = $stmt->fetchAll();
            // Iteracja po kolejnych użytkownikach
            foreach ($users as $user) {
                $selected = '';
                if ($user['user_id'] == $rental['user_id']) {
                    $selected = 'selected';
                }
                echo "<option value='" . $user['user_id'] . "' $selected>" . $user['name'] . ' ' . $user['surname'] . "</option>";
            }
            ?>
        </select>
    </label>
    <br><br>
    <label>
        Rower:
        <select name="bike_id">
<?php
// Pobieranie danych o rowerach z bazy danych
$stmt = $pdo->query("SELECT * FROM bikes");
$bikes = $stmt->fetchAll();
// Iteracja po kolejnych rowerach
foreach ($bikes as $bike) {
    $selected = '';
    if ($bike['bike_id'] == $rental['bike_id']) {
        $selected = 'selected';
    }
    echo '<option value="' . $bike['bike_id'] . '"';
    if ($bike['bike_id'] == $rental['bike_id']) {
        echo ' selected';
    }
    echo '>' . $bike['name'] . '</option>';
}
echo '</select>';
echo '</div>';

echo '<div class="form-group">';
echo '<label for="start_date">Data wypożyczenia:</label>';
echo '<input type="date" class="form-control" name="start_date" id="start_date" value="' . $rental['start_date'] . '">';
echo '</div>';

echo '<div class="form-group">';
echo '<label for="end_date">Data zwrotu:</label>';
echo '<input type="date" class="form-control" name="end_date" id="end_date" value="' . $rental['end_date'] . '">';
echo '</div>';

echo '<button type="submit" name="submit" class="btn btn-primary">Aktualizuj</button>';
echo '</form>';

// Zamknięcie połączenia z bazą danych
$pdo = null;

footer();
?>