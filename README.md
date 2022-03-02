# laravel-boolpress

## CONSEGNA

-   Creiamo con Laravel la nostra alternativa al più famoso CMS del modo: WordPress.

-   Nel pomeriggio, rifate ciò che abbiamo visto insieme stamattina stilando tutto a vostro piacere utilizzando Sass.

### STEP 1

-   Installiamo laravel/ui

    -   composer require laravel/ui:^2.4

-   Creaiamo lo scaffolding auth con vue

    -   php artisan ui vue --auth

-   Installiamo/aggiorniamo npm

    -   npm install
    -   npm run dev

    -   Avviamo migrazioni

### STEP 2: Back office

    -   Sostituiamo HomeContoller ed aggiungiamo Admin/HomeController

    -   Modifichiamo path in RouteServiceProvider.php

    -   Raggruppiamo rotte di amministrazione

### STEP 3

    -   Creiamo il necessario per gestire dei post
        - Model
        - Controller
        - Migration
        - Seeder
        - Rotte
        - Create.blade.php, index.blade.php

### STEP 4

    -   Creiamo UserInfo: Migration,Model,Seeder
    -   Creiamo 1 to 1 tra users ed user_infos
    -   Creiamo 1 to Many tra users e posts

### 02 Marzo - STEP 5

    -   Aggiungete model, migration, seeder di Category
    -   Aggiungete relazione one to many con Post
    -   Modificate create ed edit per inserire le select con le categorie

    -   abbellite il vostro lavoro con sass
        - Prendete spunto da https://themes.getbootstrap.com/

### TO DO

    -   Autenticazione su tutti i fronti(controllare bene validazione)
        -   Validate in edit
    -   Controllo aggiornamento slug in edit
