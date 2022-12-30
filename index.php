<?php
SESSION_START();
include_once 'menu.php';
?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>Strona główna</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://fonts.googleapis.com/css?family=Pacifico&subset=latin,latin-ext' rel='stylesheet'
          type="text/css">
</head>
<?php
menu('Strona główna');
?>
<body>
<div id="container">
<!--    <<img src="images/cyclist_ws.png" alt="Zdjęcie roweru" style="height: calc(100% - 10px);">-->

    <div class="box">
        <div class="box-left">
            <img src="images/gravel1.jpg" alt="Zdjęcie roweru" class="box-image">
        </div>
        <div class="box-center">
            <h3 class="box-name">ROWER111</h3>
            <p class="box-description">Szybki rower</p>
        </div>
        <div class="box-right">
            <p class="box-price">Cena: 6666 PLN</p>
            <button type="submit" class="box-button">Dodaj</button>
        </div>
    </div>
    <div class="box">
        <div class="box-left">
            <img src="images/city1.jpg" alt="Zdjęcie roweru" class="box-image">
        </div>
        <div class="box-center">
            <h3 class="box-name">ROWER111</h3>
            <p class="box-description">Szybki rower</p>
        </div>
        <div class="box-right">
            <p class="box-price">Cena: 6666 PLN</p>
            <button type="submit" class="box-button">Dodaj</button>
        </div>
    </div>
    <div class="box">
        <div class="box-left">
            <img src="images/road1.jpg" alt="Zdjęcie roweru" class="box-image">
        </div>
        <div class="box-center">
            <h3 class="box-name">ROWER111</h3>
            <p class="box-description">Szybki rower</p>
        </div>
        <div class="box-right">
            <p class="box-price">Cena: 6666 PLN</p>
            <button type="submit" class="box-button">Dodaj</button>
        </div>
    </div>

    <div class="box">
        <div class="box-left">
            <img src="images/electric1.jpg" alt="Zdjęcie roweru" class="box-image">
        </div>
        <div class="box-center">
            <h3 class="box-name">ROWER111</h3>
            <p class="box-description">Szybki rower</p>
        </div>
        <div class="box-right">
            <p class="box-price">Cena: 6666 PLN</p>
            <button type="submit" class="box-button">Dodaj</button>
        </div>
    </div>



<!--    <div style="clear:both;"></div>-->

</div>
</body>
<?php
footer();
?>
</html>