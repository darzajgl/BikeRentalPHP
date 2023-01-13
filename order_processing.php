<?php
session_start();

include_once 'functions.php';
require_once "db_config.php";

// Połączenie z bazą danych przy użyciu PDO
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
} catch (PDOException $error) {
    $_SESSION['error_server'] = $error->getMessage();
    header('Location:index.php');
}

// sprawdzenie czy daty i produkt zostały wybrane
if (!isset($_SESSION['start_date']) || !isset($_SESSION['end_date']) || (!isset($_SESSION['bike_id']))) {
    header('Location: index.php');
}

//dane użytkownika
$user_id = $_SESSION['user_id'];
$name = $_SESSION['name'];
$surname = $_SESSION['surname'];
$login = $_SESSION['login'];
$email = $_SESSION['email'];

$street = $_SESSION['street'];
$house_number = $_SESSION['house_number'];
$zip_code = $_SESSION['zip_code'];
$city = $_SESSION['city'];

//dane o produkcie
$product_id = $_SESSION['bike_id'];
$product_price = $_SESSION['price'];
$product_name = $_SESSION['bike_name'];

//dane o wypożyczeniu
$start_date = $_SESSION['start_date'];
$end_date = $_SESSION['end_date'];
$diff_days = $_SESSION['diff_days'];

//informacja o cenie sumarycznej
$total_price = $_SESSION['total_price'];



$user_id = $_SESSION['user_id'];

$start_date = $_SESSION['start_date'];
$end_date = $_SESSION['end_date'];

//przygotowanie zapytanie zabezpieczone przed sql injection
$stmt = $pdo->prepare('INSERT INTO `rentals`( `user_id`, `bike_id`, `start_date`, `end_date`) VALUES (:user_id, :product_id, :start_date, :end_date)');
$stmt->bindParam(':user_id', $user_id);
$stmt->bindParam(':product_id', $product_id);
$stmt->bindParam(':start_date', $start_date);
$stmt->bindParam(':end_date', $end_date);

//wykonanie zapytanie
$stmt->execute();

// Tworzenie wiadomości
$to = $_SESSION['email'];
$from = 'Wypożyczalnia - TI Zajglic no-reply@localhost';
$replyTo = 'Biuro biuro@localhost';
$subject = 'Potwierdzenie zamówienia';

$message = '
<html lang="pl-PL">
  <head>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <h1>Witaj ' . $name . ' ' . $surname . ',</h1>
    <p>Poniżej przedstawiamy szczegóły Twojego zamówienia:</p>
    <hr>
    <h2>Twój adres:</h2>
    <p>' . $street . ' ' . $house_number . '<br>
    ' . $zip_code . ' ' . $city . '</p>
    <hr>
<h2>Zamówienie:</h2>
   
 
<table style="border: 2px solid black; border-collapse: collapse;">
<thead>
  <tr>
    <th style="text-align: left; border: 1px solid black">Nazwa produktu</th>
    <th style="text-align: left; border: 1px solid black">' .$product_name. '</th>
  </tr>
</thead>
<tbody>
  <tr>
    <td style="border-left: 1px solid black;">data wypożyczenia</td>
    <td style="border-left: 1px solid black;">' . $start_date . '</td>
  </tr>
  <tr>
    <td style="border-left: 1px solid black;">data zwrotu</td>
    <td style="border-left: 1px solid black;">' . $end_date . '</td>
  </tr>
  <tr>
    <td style="border-left: 1px solid black;">ilość dni</td>
    <td style="border-left: 1px solid black;">' . $diff_days . '</td>
  </tr>
  <tr>
    <td style="border-left: 1px solid black;">opłata dzienna</td>
    <td style="border-left: 1px solid black;">' . $product_price . '</td>
  </tr>
  <tr>
    <td style="border-left: 1px solid black;">należność całkowita</td>
    <td style="border-left: 1px solid black;">' . $total_price . '</td>
  </tr>
</tbody>
</table>
 <p>Dziękujemy za dokonanie zamówienia. Zapraszamy po odbiór w dniu ' . $start_date . '.</p>
  <p>Z poważaniem</p>
  <p>Zespół wypożyczalni</p>
  </body>
</html>
';
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-Type: text/html; charset=utf-8' . "\r\n";
$headers .= 'From: ' . $from . "\r\n";
$headers .= 'Reply-To: ' . $replyTo . "\r\n";

if (mail($to, $subject, $message, $headers)) {
    header('Location: order_confirmation.php');

} else {
    "NIEPOWODZENIE WYSYŁANIA WIADOMOŚCI";
}


