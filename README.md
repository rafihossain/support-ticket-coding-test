# Project Setup Instructions

Follow the steps below to get the project up and running.

---

## 1. Pull the Latest Code from the `afiqur` Branch
```bash
git pull origin afiqur

composer install
npm install
php artisan migrate

## 2. To automatically generate users (Admin & Customer), run the database seeder:
php artisan db:seed
