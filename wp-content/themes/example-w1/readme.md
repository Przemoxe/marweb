/******************************************************************************/
Kompilacja assetów:
/******************************************************************************/

npm run dev - kompikuje assety z watchem

/******************************************************************************/
Struktura aplikacji szablonu
/******************************************************************************/

Główna logika szablonu znajduje się w katalogu application:

-Compsers - w tym katalogu definiujemy klasy odpowiedzialne za tworzenie customowych typów postów,
            customowych taxonomii oraz podstron opcji. W composerach nie powinno być zbyt wiele logiki
            a jedynie zarejestrowanie odpowiednich elementów.

-Extensions - Tutaj definiujemy rozszerzenia. Są to dodatki, które mają wykonać określone działanie
            ale nie są na tyle powiązane z szablonem, że nie warto tworzyć pluginu wordpressowego.  
            Mogą tu się znaleźć np. rozszerzenia które modyfikują którąś wtyczkę wordpressową pod wymagania szablonu.

 -Models -
