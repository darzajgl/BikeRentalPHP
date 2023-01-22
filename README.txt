Dane logowania administratora
login: administrator
hasło: administrator

Polski
 Wypożyczalnia rowerowa

Aplikacja webowa stworzona w ramach nauki języka PHP, obsługi sesji oraz obsługi bazy danych MySQL, jako projekt w ramach  "Techniki Internetu". W projekcie zostały wykorzystane technologie: PHP, HTML, SQL i CSS.

Składa się ona z trzech głownych części:
-panelu obługi zamówienia
-panelu klienta
-panelu administratora

Panel obsługi zamówienia:
- wybór terminu wypożyczenia
- wybór produktu
- podsumowanie zamówienia

Panel klienta:
-szczegóły konta
-formularz logowania
-formularz rejestracji
-historia zamówień

Panel administratora:
-formualrz logowania
-panel administratora

Opisy niektórych procesów i funkcji aplikacji.
Składanie zamówienia:
- użytkownik może wybrać datę początkową i końcową okresu zamówienia, okres zamówienia nie może być dłuższy niż 3 miesiące
- użytkownik może wybrać jeden z dostępnych produktów, użytkownik może dokonać korekty wyboru
- użytkownik może podejrzeć podsumowanie zamówienia: nazwę produktu, okres wypożyczenia, koszt jednostkowy, koszt całkowity
- po wybraniu niezbędnych danych użytkownik zostaje przeniesiony do strony logowania lub do strony konta jeśli jest już zalogowany w celu sprawdzenia swoich danych
- użytkownik potwierdzając zamówienia zostaje przeniesiony na stronę potwierdzenia, mail z potwierdzeniem zostaje wysłany na mail przypisany do konta, informacja o zamówieniu jest 	zapisywana w bazie danych
- użytkownik może przejść do złożenia kolejnego zamówienia lub wylogować się

Konto:
- użytkownik może zalogować się na swoje konto po podaniu prawidłowych danych: loginu i hasła
- użytkownik może zarejestrować się wypełniając formularz
- użytkownik może podejrzeć swoje dane na stronie konta
- użytkownik może podejrzeć historię swoich zamówień

Panel administratora:
- administrator może korzystać z paneu administratora tylko po uwierzytelnieniu się prawidłowym loginem oraz hasłem
- W panelu administratora wyświetlane są tabele zamówień oraz produktów
- administrator może usunąć i edytować dowolne zamówienie lub dowolny produkt
- administrator możę dodać ręcznie zamówienie lub produkt
- tabela wypożyczeń może zostać posortowana wg dowolnej kolumny

Aplikacja wykorzystuje sesję do przechowywania wprowadzonych danych. Połączenie z bazą danych MySQL umożliwia operacje na danych.
W projekcie został wykorzystany interfejs PDO oraz została wykonane zabezpieczenia przed iniekcją SQL.
Do poprawnego funkcjonowania aplikacji niezbędna jest poprawna konfiguracja plików sendmail.ini oraz php.ini.

