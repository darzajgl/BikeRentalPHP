<?php
function menu($page_title)
{
    echo '
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
</head>
<body>
<div class="wrapper">
<div id="logo">
    ' . $page_title . '
</div>
    <div class="nav">
        <ol>
            <li><a href="index.php">Strona główna</a></li>
            <li><a>Wypożycz rower</a>
                <ul>
                    <li><a href="date_picker.php">Wybierz Daty</a></li>
                    <li><a href="bikes.php">Wybierz Rower</a></li>
                    <li><a href="order_summary.php">Zamówienie</a></li>
                </ul>
            </li>
            <li><a>Panel klienta</a>
                <ul>
                    <li><a href="account.php">Konto</a></li>
                    <li><a href="login_form.php">Logowanie</a></li>
                    <li><a href="register_form.php">Rejestracja</a></li>
                </ul>
            </li>
            <li><a>Administracja</a>
                <ul>
                    <li><a href="admin_form.php">Logowanie</a></li>
                    <li><a href="admin_panel.php">Panel Administratora</a></li>
                </ul>
            </li>
            <li><a href="about.php">Informacje</a></li>
        </ol>
    </div>
</div>
</body>
</html>

';
}

function footer()
{
    echo '
  <!DOCTYPE html>
  <html lang="pl-PL">
  <body>
       <div id="footer"> *          PROJEKT TI        *</div>
  </div>
  </body>
  </html>
  ';
}


function element($product_name, $product_price, $product_description, $product_image, $product_id)
{
    $element =
        '
<form action="bikes.php" method="POST">
<div class="box">
    <div class="box-left">
        <img src="' . $product_image . '" alt="Zdjęcie" class="box-image">
    </div>
    <div class="box-center">
        <h3 class="box-name">' . $product_name . '</h3>
        <p class="box-description">' . $product_description . '</p>
    </div>
    <div class="box-right">
        <p class="box-price">' . $product_price . ' PLN/dzień</p>
        <button type="submit" class="box-button" name="add">Wybierz</button>
        <input type="hidden" name="product_id" value=' . $product_id . '>
    </div>
</div>
</form>
';
    echo $element;
}


function date_check($start_date, $end_date)
{
    if ($end_date <= $start_date) {
        throw new Exception("Data końcowa jest wcześniejsza lub równa początkowej");
    }
    $diff_days = floor((strtotime($end_date) - strtotime($start_date)) / (60 * 60 * 24));
    if ($diff_days > 90) {
        throw new Exception("Okres wypożyczenia nie może być dłuższy niż 3 miesiące");
    }
    $_SESSION['start_date'] = $start_date;
    $_SESSION['end_date'] = $end_date;
    $_SESSION['diff_days'] = $diff_days;
}


//CRUD
function delete_bike($bike_id, $pdo)
{
    try {
        //Tworzenie zapytania SQL do usunięcia rekordu z tabeli bikes o podanym bike_id
        $stmt = $pdo->prepare("DELETE FROM bikes WHERE bike_id = :bike_id");
        //Podpinanie wartości bike_id do zmiennej :bike_id i ustawienie typu danych jako INT
        $stmt->bindParam(':bike_id', $bike_id, PDO::PARAM_INT);
        //Wykonanie zapytania
        $stmt->execute();
        //przekierowanie na aktualną stronę
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}


function update_bike($bike_id, $name, $description, $price, $image, $pdo)
{
    // Przygotowanie zapytania SQL do aktualizacji rekordu roweru
    $stmt = $pdo->prepare("UPDATE bikes SET name = :name, description = :description, price = :price, image = :image WHERE bike_id = :bike_id");
    // Przypisanie wartości do zmiennych
    // Dodanie prefiksu "images/" ścieżki zdjęcia
    $image = "images/" . $image;
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':bike_id', $bike_id);
    // wykonanie zapytania
    $stmt->execute();
}

function add_bike($name, $description, $price, $image, $pdo)
{
    // Dodanie prefiksu "images/" ścieżki zdjęcia
    $image = "images/" . $image;
    $stmt = $pdo->prepare("INSERT INTO bikes (name, description, price, image) VALUES (?,?,?,?)");
    $stmt->execute([$name, $description, $price, $image]);
}


function delete_rental($rental_id, $pdo)
{
    try {
        //Tworzenie zapytania SQL do usunięcia rekordu z tabeli rentals o podanym rental_id
        $stmt = $pdo->prepare("DELETE FROM rentals WHERE rental_id = :rental_id");
        //Podpinanie wartości rental_id do zmiennej :rental_id i ustawienie typu danych jako INT
        $stmt->bindParam(':rental_id', $rental_id, PDO::PARAM_INT);
        //Wykonanie zapytania
        $stmt->execute();
        //przekierowanie na aktualną stronę
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}


?>



