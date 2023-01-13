<?php
session_start();

include_once 'functions.php';
require_once "db_config.php";

// sprawdz czy admin zalogowany
if (!isset($_SESSION['admin_logged']) || (!$_SESSION['admin_logged'] == true)) {
    header('Location: admin_panel.php');
    exit();
}

// połącz z bazą PDO
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
} catch (PDOException $error) {
    $_SESSION['error_server'] = $error->getMessage();
    header('Location:index.php');
}

// sprawdź przesłanie formularza
if (isset($_POST['add_bike'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];

    //Upewnij się, że folder istnieje i jest dostępny do zapisu
    if (!is_dir('images')) {
        mkdir('images');
    }
    move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $image);

    add_bike($name, $description, $price, $image, $pdo);
    header('Location: admin_panel.php');
}

menu('Dodaj Rower');
?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>Dodaj Rower</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div id="container">
    <form action="" method="post" enctype="multipart/form-data">
        <label for="name">Nazwa:</label>
        <input type="text" id="name" name="name">
        <br>
        <label for="description">Opis:</label>
        <textarea id="description" name="description"></textarea>
        <br>
        <label for="price">Cena:</label>
        <input type="number" id="price" name="price">
        <br>
        <label for="image">Zdjęcie:</label>
        <input type="file" id="image" name="image">
        <br>
        <input type="submit" name="add_bike" value="Dodaj">
    </form>
    <br>
    <a href="admin_panel.php"><input type="button"  class = "box-button" value="Wróć do Panelu Administratora"></a>
</div>
</body>
</html>