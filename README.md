## Finoman

### Requirements
- PHP 7.3 or higher
- MySQL 5.7 or higher
- Composer 2.1.3 or higher
- NodeJS 16.4.2 or higher
- Yarn 1.22.5 or higher
- Vue CLI 4.5.13 or higher
- Quasar CLI 3.0.2 or higher

### Install programs
- `npm install --global yarn`
- `npm install -g vue-cli`
- `npm install -g quasar-cli`

### How to run this project
- `git clone git@github.com:NONstop5/finoman.git`
- `cd finoman/api && composer install`
- `cp .env.example .env`
- `php artisan key:generate`
- `php artisan migrate --seed`
- `cd .. && cd quasarapp && yarn`
- `quasar dev`
  
### Before deploy
- `cd quasarapp && quasar build`

### Debug API
- `php artisan optimize:clear`
