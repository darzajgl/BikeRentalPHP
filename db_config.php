<?php

// dane połączenia z bazą danych
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'bike_rental');

// tworzenie połączenia z bazą danych
//try {
//    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
//    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//} catch (PDOException $e) {
//    echo "Połączenie z bazą danych nie powiodło się: " . $e->getMessage();
//}

//  jakieś zapytania do bazy danych??

// zamknięcie połączenia z bazą danych
$pdo = null;

?>