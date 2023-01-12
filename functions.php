<?php
function menu($page_title)
{
    echo '
 <html lang="pl-PL">
  <body>
  <div id="container">
      </div>
      <div id="logo">
          ' . $page_title . '
      </div>
      <div id="menu">
          <div class="option" onclick="location.href=\'index.php\'">Wypożycz</div>
          <div class="option" onclick="location.href=\'bikes.php\'">Rowery</div>
          <div class="option" onclick="location.href=\'order_summary.php\'">Podsumowanie zamówienia</div>
          <div class="option" onclick="location.href=\'account.php\'">Konto</div>
          <div class="option" onclick="location.href=\'login_form.php\'">Logowanie</div>
          <div class="option" onclick="location.href=\'register_form.php\'">Rejestracja</div>
          <div class="option" onclick="location.href=\'admin_form.php\'">Administracja</div>
          <div class="option" onclick="location.href=\'about.php\'">Informacje</div>
          <div class="option" onclick="location.href=\'cart.php\'">Koszyk:
          <a href="cart.php" class="logo-item active">
          (';
    if (isset($_SESSION['cart'])) {
        $count = count($_SESSION['cart']);
        echo "<span id='cart_count' class='text-warning bg-light'>$count</span>";
    } else {
        echo "<span id='cart_count' class='text-warning bg-light'>0</span>";
    }
    echo ')  </a>
              </div>
          </div>          
          <div style="clear:both;"></div>
      </div>
  </div>
  </body>
  </html>';
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

function delete_rental($rental_id, $pdo)
{
    try {
        $stmt = $pdo->prepare("DELETE FROM rentals WHERE rental_id = :rental_id");
        $stmt->bindParam(':rental_id', $rental_id, PDO::PARAM_INT);
        $stmt->execute();
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}


?>



