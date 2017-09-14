# warsztat_3_rest_api

Cel warsztatów: napisanie pełnej i funkcjonalnej aplikacji do wprowadzania książek
metodą REST.

Projekt składa się z dwóch części:       
- Serwer – napisany w PHP, implementujący funkcjonalność REST,       
- Klient – napisany w HTML-u i JavaScripcie, komunikujący się z serwerem za pomocą AJAX.       
Serwer implementuje klasę Book mającą swój identyfikator, nazwę, autora i opis.


Założenia:       
- Klient ma implementować tylko stronę główną.       
- Strona ta ma pokazać wszystkie książki stworzone w systemie. Dane mają być
wczytane AJAX-em z api/books.php.         
- Na górze tej strony ma być też formularz do tworzenia nowych książek wysyłający dane
AJAX-em (metoda POST).         
- Gdy użytkownik kliknie na nazwę książki, pod nią ma się rozwijać div z informacjami na temat tej
książki wczytane za pomocą AJAX (GET) z endpointu api/books.php?id=....         
- Div ten ma też zawierać formularz służący do edycji tej książki (AJAX, metoda PUT na endpoincie
api/books.php?id=1&Name=""&autor="").             
- Obok nazwy ma się znajdować guzik służący do usuwania książki (AJAX, metoda DELETE na
endpoint api/books.php?id=1).        

#

Roboczy zrzut ekranu:
![Alt text](https://images86.fotosik.pl/111/0dc84d49b14f6e5a.png "work_screen")
