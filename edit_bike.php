<?php
session_start();

include_once 'functions.php';
require_once "db_config.php";

// sprawdz czy admin zalogowany i czy jest bike_id
if (!isset($_SESSION['admin_logged']) || (!$_SESSION['admin_logged'] == true) || !isset($_GET['bike_id'])) {
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
if (isset($_POST['save_changes'])) {
    $bike_id = $_POST['bike_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];

    //Upewnij się, że folder istnieje i jest dostępny do zapisu
    if (!is_dir('images')) {
        mkdir('images');
    }
    move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $image);

    update_bike($bike_id, $name, $description, $price, $image, $pdo);
    header('Location: admin_panel.php');
}

//pobierz dane o rowerze z bazy danych
$stmt = $pdo->prepare("SELECT * FROM bikes WHERE bike_id = ?");
$stmt->execute([$_GET['bike_id']]);
$bike = $stmt->fetch();

menu('Edytuj Rower');
?>

<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>Edytuj Rower</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<div id="container">
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="bike_id" value="<?php echo $bike['bike_id']; ?>">
        <label for="name">Nazwa:</label>
        <input type="text" id="name" name="name" value="<?php echo $bike['name']; ?>">
        <br>
        <label for="description">Opis:</label>
        <textarea id="description" name="description"><?php echo $bike['description']; ?></textarea>
<br>
<label for="price">Cena:</label>
<input type="number" id="price" name="price" value="<?php echo $bike['price']; ?>">
<br>
<label for="image">Zdjęcie:</label>
<input type="file" id="image" name="image" required>
<br>
<input type="submit" name="save_changes" value="Aktualizuj">
</form>

</div>
</body>
</html>