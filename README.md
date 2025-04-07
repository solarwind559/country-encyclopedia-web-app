### Project uses newest Laravel (Laravel 12), Vue.js (Vue 3), Bootstrap 5, MySQL database

#### Make sure you have Git and Composer installed on your computer.

Open the terminal and navigate to the folder where you want to save this project.

Run this command to clone the repository:
```
git clone https://github.com/solarwind559/country-encyclopedia-web-app.git
```
Navigate to the project directory:
```
cd country-encyclopedia-web-app
```
And run commands:
```
composer install
npm install
npm install bootstrap
npm install vue
npm install @vitejs/plugin-vue
```
Create a new empty database locally 

Duplicate the .env.example file in the root directory and rename it to .env

Find and edit this .env file section to match your local database details:
```
DB_CONNECTION=sqlite
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

Run commands:
```
php artisan key:generate
php artisan migrate
npm run dev
php artisan serve
```
Run this command to populate the database:
```
php artisan app:populate-db
```

### Checklist:

+ Command ```php artisan app:populate-db``` populates the database from the https://restcountries.com/v3.1/all API.
+ Homepage contains a Searchbox and a list of Favorites.
+ Country details include: 
   + Common name.
   + Official name.
   + Country code.
   + Population.
   + Population rank.
   + Flag.
   + Area.
   + A list of neighboring countries that link to their details pages.
   + A list of languages that link to a page with other countries with the same language.
+ It is possible to mark and unmark the country as a favorite.

![Screenshot](<public/screenshots/Ekrānuzņēmums 2025-04-06 232225.png>) ![Screenshot](<public/screenshots/Ekrānuzņēmums 2025-04-06 232314.png>) ![Screenshot](<public/screenshots/Ekrānuzņēmums 2025-04-06 232339.png>) ![Screenshot](<public/screenshots/Ekrānuzņēmums 2025-04-06 232444.png>) ![Screenshot](<public/screenshots/Ekrānuzņēmums 2025-04-06 232533.png>) ![Screenshot](<public/screenshots/Ekrānuzņēmums 2025-04-06 232807.png>) ![Screenshot](<public/screenshots/Ekrānuzņēmums 2025-04-06 232848.png>)