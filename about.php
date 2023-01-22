<?php
session_start();
include_once 'functions.php';

menu('Informacje');
?>
    <!DOCTYPE html>
    <html lang="pl-PL">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
        <title>Informacje</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <div class="wrapper">
        <div id="about">

            <h3>Dane logowania administratora</h3>
            <p>login: administrator</p>
            <p>hasło: administrator</p>

            <h1>POLSKI</h1>
            <h1>Wypożyczalnia Rowerowa</h1>

            <p>Aplikacja webowa stworzona w celu nauki języka PHP, obsługi sesji oraz obsługi bazy danych MySQL, jako
                projekt w ramach przedmiotu "Techniki Internetu". W projekcie zostały wykorzystane następujące
                technologie: PHP, HTML, SQL i CSS.</p>
            <p>Aplikacja składa się z trzech głównych modułów: panelu obsługi zamówienia, panelu klienta oraz panelu
                administratora.</p>

            <h2>Obsługa zamówienia</h2>
            <p>Użytkownicy mają możliwość wyboru terminu wypożyczenia oraz produktu, a także zobaczenia podsumowania
                zamówienia zawierającego informacje takie jak: nazwa produktu, okres wypożyczenia, koszt jednostkowy i
                całkowity.</p>

            <h2>Panel klienta</h2>
            <p>Użytkownicy mogą zalogować się do swojego konta, zarejestrować się, zobaczyć szczegóły swojego konta oraz
                historię swoich zamówień.</p>

            <h2>Panel administratora</h2>
            <p>Użytkownicy posiadający uprawnienia administratora mogą zalogować się do panelu administratora, w którym
                mają dostęp do funkcji takich jak: dodawanie, edycja i usuwanie produktów oraz zarządzanie
                zamówieniami.
            </p>

            <h2>Składanie zamówienia</h2>
            <p>Użytkownicy mają możliwość wyboru daty początkowej i końcowej okresu zamówienia, jednakże okres
                zamówienia nie może być dłuższy niż 3 miesiące. Po wybraniu niezbędnych danych, użytkownicy są
                przenoszeni do strony logowania w celu potwierdzenia swoich danych. Po potwierdzeniu zamówienia,
                użytkownik otrzymuje potwierdzenie na swój adres e-mail, a informacja o zamówieniu jest zapisywana w
                bazie danych. Użytkownicy mogą również przejść do złożenia kolejnego zamówienia lub wylogować się z
                aplikacji.</p>

            <h2>Wymagania systemowe</h2>
            <p>Aby skorzystać z aplikacji, należy posiadać serwer WWW z obsługą PHP oraz bazę danych MySQL. Należy
                również skonfigurować połączenie z bazą danych w pliku konfiguracyjnym aplikacji. Dodatkowo, aby
                aplikacja mogła wysyłać potwierdzenia zamówień na adres e-mail użytkownika, należy skonfigurować serwer
                pod kątem obsługi PHP oraz skonfigurować usługę sendmail, aby umożliwić wysyłanie maili z aplikacji.</p>

            <h2>Instalacja</h2>
            <p>Proces instalacji aplikacji polega na skopiowaniu plików aplikacji na serwer WWW oraz na utworzeniu bazy
                danych i importowanie do niej pliku zawierającego tabele. Należy również skonfigurować połączenie z bazą
                danych w pliku konfiguracyjnym aplikacji.</p>

            <h2>Uwagi</h2>
            <p>Aplikacja jest przykładową aplikacją stworzoną w celach edukacyjnych i może zawierać błędy.</p>


            <p>*****************************************************************************************************</p>
            <h1>ENGLISH</h1>
            <h1>Bike Rental Application</h1>
            <p>A web application created to learn PHP language, handle sessions, and handle MySQL database as a project
                under the subject "Internet Techniques". The following technologies were used in the project: PHP, HTML,
                SQL, and CSS.</p>
            <p>The application consists of three main modules: the order handling panel, the customer panel, and the
                administrator panel.</p>

            <h2>Order Handling</h2>
            <p>Users have the option to choose the rental term and the product, as well as see the order summary that
                contains information such as: product name, rental period, unit cost, and total cost.</p>

            <h2>Customer Panel</h2>
            <p>Users can log in to their account, register, see the details of their account, and view their order
                history.</p>

            <h2>Administrator Panel</h2>
            <p>Users with administrator privileges can log in to the administrator panel, where they have access to
                functions such as: adding, editing, and deleting products and managing orders.</p>

            <h2>Placing an Order</h2>
            <p>Users have the option to choose the start and end date of the order period, however the order period
                cannot be longer than 3 months. After choosing the necessary data, users are redirected to the login
                page to confirm their data. After confirming the order, the user receives a confirmation email and the
                order information is saved in the database. Users can also proceed to place another order or log out of
                the application.</p>

            <h2>System Requirements</h2>
            <p>To use the application, you must have a web server with PHP support and a MySQL database. You must also
                configure the database connection in the application's configuration file. Additionally, to enable the
                application to send order confirmations to the user's email address, you must configure the server for
                PHP support and configure the sendmail service.</p>

            <h2>Installation</h2>
            <p>The installation process for the application involves copying all files to the web server and configuring
                the database connection in the application's configuration file. Additionally, the user must have a web
                server with PHP support and a MySQL database, and must configure the server for PHP and sendmail support
                in order to enable sending emails from the application.
            </p>The installation process of the application involves copying the files to your web server and
            configuring the connection to the MySQL database in the configuration file. Additionally, you will need to
            set up your server to support PHP and configure the sendmail service in order to enable sending emails from
            the application.

            <h2>Notes</h2>
            <p>The application is a sample application created for educational purposes and may contain errors.</p>
        </div>
    </div>
    </div>
    </body>
    </html>

<?php
footer();
?>