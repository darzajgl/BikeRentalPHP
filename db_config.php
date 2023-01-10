<?php

// dane połączenia z bazą danych
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'bike_rental');

// tworzenie połączenia z bazą danych
$connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// sprawdzanie, czy połączenie zostało nawiązane
if (!$connection) {
    die("Połączenie z bazą danych nie powiodło się: " . mysqli_connect_error());
}

// tutaj można dodać kod do wykonywania zapytań do bazy danych

// zamknięcie połączenia z bazą danych
mysqli_close($connection);

?>