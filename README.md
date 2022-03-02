# laravel-boolpress

## MILESTONE 1

    -   creazione tabella post (migration+seeder+model)
    -   CRUD del post + rotta
    -   Installazione auth
    -   Fix delle rotte con middleware('auth')
    -   Fix dello scaffolding di HomeController, della sua index() e di RouteServiceProvider

## MILESTONE 2

    -   Creazione tabella userinfo (migration+seeder+model) e seeder di user
    -   Relazione 1aN tra post e user
    -   Relazione 1a1 tra user e userinfo
    -   Fix delle CRUD di post (tutte!) in modo che lo user veda/modifichi solo i suoi post

## MILESTONE 3

    -   Creazione tabella category (migration+seeder+model)
    -   Relazione 1aN tra post e category
    -   CategoryController (index+show)
    -   Fix delle CRUD di post (tutte!) in modo da aggiungere la categoria
