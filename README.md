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
    -   Colleghiamo una category “generic” alla cancellazione di una category a tutti i post associati.

## MILESTONE 4

    -   Creazione tabella tag(migration+seeder+model)
    -   Relazione NaN tra tag e post
        -   (on delete set null)
    -   TagController
    -   CRUD di tag

# TO-DO

    -   Post edit: modifica dei tag
