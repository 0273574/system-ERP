# Bezpieczny system ERP

##### Cały projekt został zrobiony korzystając z dokumentacją PHP-a i został wykonany w formie edukacyjnej, aby nauczyć się nowych rzeczy
##### Wszystko powinno działać według poleceń gdyż w niektórych miejscach są dodane rzeczy które wizualni poprawiają wygląd plików php które zwracają operacje na danych, lecz gdy są jakieś problemy lub wątpliwości proszę o kontakt

## Sklonuj repozytorium
```
git clone https://github.com/0273574/system-ERP.git
```

# Polecenie

Pracujesz w firmie oferującej rozwiązania dla przedsiębiorstw. Nowy klient zwraca się do ciebie o oprogramowanie ERP, którego potrzebuje do zarządzania codziennymi operacjami. Oczywiście, Twoja firma ma wiele skomplikowanych rozwiązań, które mogą być odpowiednie do tego zadania.

Problem polega na tym, że klient jest niezwykle podejrzliwy wobec technologii chmurowych i ogólnie sieci. Twierdzi, że to, co jest w sieci lub na komputerze podłączonym do Internetu, jest narażone na kradzież, a tajne służby co najmniej czterech krajów regularnie je infiltrują.

Klient chce rozwiązanie, które jest super bezpieczne: krótki i czytelny kod, który działa na lokalnych plikach, na komputerach nie podłączonych do sieci. Zadaniem Twojego zespołu jest stworzenie takiej aplikacji od zera.

Wymaga bardzo modularnej struktury, gdzie kod dla różnych obszarów treści jest oddzielony, a każda operacja użytkownika i operacja wejścia/wyjścia pliku przechodzi przez jeden, i tylko jeden kanał. Postanawiasz stworzyć wariant architektury MVC (model-widok-kontroler) dla terminalu i lokalnych plików danych.

Ponieważ klient nie dostarcza żadnych realnych danych, tylko ogólną strukturę, musisz stworzyć kilka sztucznych danych do celów rozwoju.

## I. Moduł CRM
Zaimplementuj moduł CRM z podstawowymi i specjalnymi operacjami.
1. Po wybraniu modułu CRM, wybranie opcji 1 prosi użytkownika o wpisanie imienia, adresu e-mail i statusu subskrypcji dla nowego klienta. Po wypełnieniu ostatniego pola, nowy klient zostaje dodany z losowym identyfikatorem.
2. Po wybraniu modułu CRM, wybranie opcji 2 wyświetla wszystkich klientów.
3. Po wybraniu modułu CRM, wybranie opcji 3 prosi użytkownika o podanie identyfikatora klienta. Jeśli identyfikator należy do istniejącego klienta, użytkownik wprowadza nowe wartości dla imienia, adresu e-mail i statusu subskrypcji. Po wypełnieniu ostatniego pola, pola klienta są aktualizowane z podanymi wartościami.
4. Po wybraniu modułu CRM, wybranie opcji 4 prosi użytkownika o podanie identyfikatora klienta. Jeśli identyfikator należy do istniejącego klienta, klient zostaje usunięty z bazy danych.
5. Pobierz adresy e-mail zapisanych klientów.

## II. Moduł sprzedaży
Zaimplementuj moduł sprzedaży z podstawowymi i specjalnymi operacjami.
1. Zapewnij podstawowe operacje CRUD.
2. Pobierz transakcję, która przyniosła największe przychody.
3. Pobierz produkt, który przyniósł największe przychody ogółem.
4. Policzyć liczbę transakcji między dwoma datami.
5. Zsumuj cenę transakcji między dwoma datami.

## III. Moduł HR
Zaimplementuj moduł HR z podstawowymi i specjalnymi operacjami.
1. Zapewnij podstawowe operacje CRUD.
2. Zwróć nazwy najstarszego i najmłodszego pracownika jako tablicę.
3. Zwróć średni wiek pracowników.
4. Zwróć nazwy pracowników, którzy mają urodziny w ciągu dwóch tygodni od daty wejściowej.
5. Zwróć liczbę pracowników, którzy mają co najmniej określony poziom uprawnień.
6. Zwróć liczbę pracowników na oddział w formie tablicy asocjacyjnej (np. ['dep1': 5, 'dep2': 11]).






