Finoman
==============

Requirements
------------
    * PHP 7.3 or higher;
    * MySQL 5.7 or higher
    * Composer 2.1.3 or higher
    * NodeJS 16.4.2 or higher
    * Yarn 1.22.5 or higher
    * Vue CLI 4.5.13 or higher
    * Quasar CLI 3.0.2 or higher


How to install this project
---------------------------
    1. `git clone git@github.com:NONstop5/finoman.git`
    2. `cd finoman/api && composer install`
    3. `php artisan migrate --seed`
    4. `cd .. && cd quasarapp && yarn`
    5. `quasar dev`
  
Before deploy
---------------------------
    1. `cd quasarapp && quasar build`
