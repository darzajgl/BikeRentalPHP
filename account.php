<?php
session_start();
include_once 'functions.php';

//if (!isset($_SESSION['logged'])) {
//    header('Location: index.php');
//}
mysqli_report(MYSQLI_REPORT_STRICT);
menu('Konto');
?>
    <!DOCTYPE html>
    <html lang="pl-PL" xmlns="http://www.w3.org/1999/html">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        <title>Konto</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
    <form>
        <fieldset>
            <?php
            //sprawdzenie czy zalogowany
            if (isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
                //wyświetlenie danych
                echo "<p>Witaj!</p>";
                echo "<p><b>Twoje dane:</b></p>";
                echo "<p>Imię: " . $_SESSION['name'] . "</p>";
                echo "<p>Nazwisko: " . $_SESSION['surname'] . "</p>";
                echo "<p>Login: " . $_SESSION['login'] . "</p>";
                echo "<p>E-mail: " . $_SESSION['email'] . "</p>";
                echo "<p>Ulica: " . $_SESSION['street'] . "</p>";
                echo "<p>Numer domu/mieszkania: " . $_SESSION['house_number'] . "</p>";
                echo "<p>Kod pocztowy: " . $_SESSION['zip_code'] . "</p>";
                echo "<p>Miasto: " . $_SESSION['city'] . "</p>";

                echo "<a href ='logout.php'>Wyloguj się!</a>";
                echo "<br><br>";

            } else {
                echo "Musisz być zalogowany aby podejrzeć swoje dane";
                echo '<hr><a href="login_form.php">Przejdz do strony logowania!</a>';
            }
            ?>
        </fieldset>
            <?php
            // sprawdzenie czy daty i produkt zostały wybrane
            if (isset($_SESSION['start_date']) || isset($_SESSION['end_date']) || (isset($_SESSION['cart']))) {
                echo '<fieldset>
                        <p><a href="order_processing.php" class="box-button">Potwierdz zamowienie!</a></p>
                      </fieldset>';
            }
            ?>
    </form>
    </body>
    </html>

<?php
footer();
?>