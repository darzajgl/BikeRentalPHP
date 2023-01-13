<?php
session_start();

include_once 'functions.php';
require_once "db_config.php";

// Połączenie z bazą danych
//try {
//    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
//} catch (PDOException $error) {
//    $_SESSION['error_server'] = $error->getMessage();
//    header('Location:index.php');
//    exit;
//}

if (isset($_POST['add'])) {
    try {
        date_check($_POST['start_date'], $_POST['end_date']);
        header('Location: bikes.php');
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}

menu('Wybierz daty');
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>Wybór daty</title>
    <link rel="stylesheet" href="style.css">
    <link href='http://fonts.googleapis.com/css?family=Pacifico&subset=latin,latin-ext' rel='stylesheet'
          type="text/css">
</head>

<body>
<div id="container">
    <form action="index.php" method="post">
        <div class="box">
            <div class="box-left">
                <label for="start_date">Data początkowa:</
                </label>
                <input type="date" name="start_date" min="<?= date('Y-m-d'); ?>"
                       max="<?= date('Y-m-d', strtotime('+1 year')); ?>" required>
            </div>
            <div class="box-center">
                <label for="end_date">Data końcowa:</label>
                <input type="date" name="end_date" min="<?= date('Y-m-d', strtotime('+1 day')); ?>"
                       max="<?= date('Y-m-d', strtotime('+1 year')); ?>" required>
            </div>
            <div class="box-center-right">
                <?php
                if (isset($error_message)) {
                    echo '<span style="color: red">' . $error_message . '</span><br>';
                }
                ?>
            </div>
            <div class="box-right">
                <p><input type="submit" name="add" class="box-button" value="Wybierz"></p>
            </div>
        </div>
    </form>
</div>
</body>
</html>
<?php
footer();
?>
