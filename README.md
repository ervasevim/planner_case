# PLANNING CASE

Requirements
---
- PHP ^7.3|^8.0
- Composer
- Laravel ^8.75

Installation
---
```
git clone git@github.com:ervasevim/planner_case.git
cd planner_case
composer update
```

Create .env file data
---
```
cp .env.example .env
```


Configuration
---
```
php artisan migrate
composer dump-autoload
php artisan db:seed
```
