<?php
session_start();
include_once 'functions.php';
require_once "db_config.php";

// sprawdz czy admin zalogowany i czy jest bike_id
if (!isset($_SESSION['admin_logged']) || (!$_SESSION['admin_logged'] == true)) {
    header('Location: admin_panel.php');
    exit();
}

// Połączenie z bazą danych przy użyciu PDO
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
} catch (PDOException $error) {
    $_SESSION['error_server'] = $error->getMessage();
    header('Location:index.php');
}


// Jeśli formularz zostanie wysłany
if (isset($_POST['add_rental'])) {
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
        // dodanie nowego wpisu do bazy danych
        add_rental($user_id, $bike_id, $start_date, $end_date, $pdo);
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

menu('Dodaj zamówienie ręcznie');
?>

    <!DOCTYPE html>
    <html lang="pl-PL">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        <title>Dodaj zamówienie ręcznie</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <div class="wrapper">
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
                        echo "<option value='" . $user['user_id'] . "' $selected>" . $user['name'] . ' ' . $user['surname'] . "</option>";
                    }
                    ?>
                </select>
                <br>
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
                            echo "<option value='" . $bike['bike_id'] . "' $selected>" . $bike['name'] . "</option>";
                        }
                        ?>
                    </select>
                </label>
                <br>
                <label for="start_date">Data wypożyczenia:</label>
                <input type="date" id="start_date" name="start_date" value="<?php echo $start_date; ?>">
                <br>
                <label for="end_date">Data zwrotu:</label>
                <input type="date" id="end_date" name="end_date" value="<?php echo $end_date; ?>">
                <br>
                <input type="submit" name="add_rental" class="box-button"  value="Dodaj zamówienie">
        </form>
        <br>
        <a href="admin_panel.php"><input type="button" class="box-button" value="Wróć do Panelu Administratora"></a>
    </div>
    </body>
    </html>

<?php
// Zamknięcie połączenia z bazą danych
$pdo = null;
footer();
?>