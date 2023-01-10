<?php
session_start();

include_once 'functions.php';
//require_once "db_config.php";
//mysqli_report(MYSQLI_REPORT_STRICT);
//
//// Połączenie z bazą danych
//try {
//    $connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
//
//    if ($connection->connect_errno !== 0) {
//        throw new Exception((mysqli_connect_error()));
//    }
//} catch (Exception $error) {
//    $_SESSION['error_server'] = $error->getMessage();
//    header('Location:index.php');
//}
//
//if (!$connection) {
//    echo "Błąd podczas łączenia z bazą danych: " . mysqli_connect_error();
//}


if (isset($_POST['add'])) {
    try {
        data_check($_POST['start_date'], $_POST['end_date']);
        header('Location: bikes.php');
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>Strona główna</title>
    <link rel="stylesheet" href="style.css">
    <link href='http://fonts.googleapis.com/css?family=Pacifico&subset=latin,latin-ext' rel='stylesheet'
          type="text/css">
</head>
<?php
menu('Strona główna');
?>
<body>
<div id="container">
    <form action="index.php" method="post">
        <label for="start_date">Data początkowa:</
        </label>
        <input type="date" name="start_date" min="<?= date('Y-m-d'); ?>"
               max="<?= date('Y-m-d', strtotime('+1 year')); ?>" required>
        <label for="end_date">Data końcowa:</label>
        <input type="date" name="end_date" min="<?= date('Y-m-d', strtotime('+1 day')); ?>"
               max="<?= date('Y-m-d', strtotime('+1 year')); ?>" required>
        <br>
        <?php
        if (isset($error_message)) {
            echo '<span style="color: red">' . $error_message . '</span><br>';
        }
        ?>
        <p><input type="submit" name="add" value="Przejdź do wyboru roweru"></p>
    </form>
</div>
</body>
</html>
<?php
footer();
?>

