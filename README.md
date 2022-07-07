# Laravel Shuttle Demo App

This is the demo application for showcasing [Laravel Shuttle](https://github.com/stechstudio/laravel-shuttle).

### Setup

Clone the repository

`https://github.com/stechstudio/laravel-shuttle-demo-app.git`

Setup your `.env` and database

`cp .env.example .env && php artisan key:generate && cd database && touch database.sqlite`

Migrate and seed the database

`php artisan migrate --seed`
