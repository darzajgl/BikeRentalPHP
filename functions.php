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
       <div id="footer"> *********PROJEKT TI********</div>
  </div>
  </body>
  </html>
  ';
}


function elementt($product_name, $product_price, $product_description, $product_image, $product_id, $start_date, $end_date)
{
    $element =
        '

<form action="index.php" method="post">
<div class="box">
<div class="box-left">
<img src="' . $product_image . '" alt="Zdjęcie" class="box-image">
</div>
<div class="box-center">
<h3 class="box-name">' . $product_name . '</h3>
<p class="box-description">' . $product_description . '</p>
</div>
<div class="box-center-right">
<br>
<label for="start_date">Początek wypożyczenia</label>
<input type="date" name="start_date" min="' . date('Y-m-d') . '" max="' . date('Y-m-d', strtotime('+1 year')) . '" required>
<hr>
<label for="end_date">Koniec wypożyczenia</label>
<input type="date" name="end_date" min="' . date('Y-m-d', strtotime('+1 day')) . '" max="' . date('Y-m-d', strtotime('+1 year +3 months')) . '" required>
';

// Calculate the number of rental days
    $start_date = strtotime($_POST['start_date']);
    $end_date = strtotime($_POST['end_date']);
    $days = ($end_date - $start_date) / 60 / 60 / 24;
    echo '<hr>';
    echo '<p class="box-price">Liczba dni wypożyczenia: ' . $days . '</p>';

    $element .= '

</div>
        <div class="box-right">
            <p class="box-price">' . $product_price . ' PLN/dzień</p>
            <button type="submit" class="box-button" name="add">Dodaj</button>
            <input type="hidden" name="product_id" value=' . $product_id . '>
    </div>
</div>
</form>
';
    echo $element;
}

function getDateDifference($start_date, $end_date)
{
    $start_timestamp = strtotime($start_date);
    $end_timestamp = strtotime($end_date);
    $difference = $end_timestamp - $start_timestamp;
    $result = floor($difference / 86400);
    return $result;
}

//function element($product_name, $product_price, $product_description, $product_image, $product_id, $start_date, $end_date)
function elementaa($product_name, $product_price, $product_description, $product_image, $product_id)
{
    $element =
        '

<form action="index.php" method="post">
<div class="box">
<div class="box-left">
<img src="' . $product_image . '" alt="Zdjęcie" class="box-image">
</div>
<div class="box-center">
<h3 class="box-name">' . $product_name . '</h3>
<p class="box-description">' . $product_description . '</p>
</div>
<div class="box-center-right">
<br>
<div class="box-right">
    <p class="box-price">' . $product_price . ' PLN/dzień</p>
    <button type="submit" class="box-button" name="add">Dodaj</button>
    <input type="hidden" name="product_id" value=' . $product_id . '>
</div>
</div>
</form>
';
    echo $element;
}


function element($product_name, $product_price, $product_description, $product_image,$product_id) {
$element =
'
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
        <button type="submit" class="box-button">Wybierz</button>
        <input type="hidden" name="product_id" value=' . $product_id . '>
    </div>
</div>
';
echo $element;
}
function data_check($start_date, $end_date) {
    if($end_date <= $start_date) {
        throw new Exception("Data końcowa jest wcześniejsza lub równa początkowej");
    }
    $diff_days = floor((strtotime($end_date) - strtotime($start_date)) / (60 * 60 * 24));
    if($diff_days > 90) {
        throw new Exception("Okres wypożyczenia nie może być dłuższy niż 3 miesiące");
    }
    $_SESSION['start_date'] = $start_date;
    $_SESSION['end_date'] = $end_date;
    $_SESSION['diff_days'] = $diff_days;
}


?>



