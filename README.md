Start projektu

Composer Install
Stworzenie i wypełnienie env'a 
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan passport:install
php artisan serve

Projekt zawiera 2 publiczne endpointy Listę produktów (z parametrami orderBy, maxPrice oraz 'phrase' (wyszukiwaniem po nazwie) oraz szczegółami produktu.
Ponadto dla zalogowanego usera dostępne są edycja, dodawanie oraz usuwanie produktów.
Do systemu logujemy się uzywając passportowego routa /oauth/token 

Dane do endpointa logowania :
grant_type = password
client_secret = 'sekret id z clienta z bazy danych
client_id = 2 (domyślnie nalezy pobrać z bazy danych)
username = nazwa uzytkownika
password = 'password'

