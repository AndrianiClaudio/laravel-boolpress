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
