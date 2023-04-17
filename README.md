## Sistema ESQUELETOR2

### Herramientas:

- Laravel 9, Jetstream y TailwindCSS
- vite
- livewire-datatables de MedicOneSystems
- laravel-simple-select
- SweetAlert2
- laravel-flatpickr
- laravel-dompdf
- ChartJs (include desde blade)


### para produccion:

chown -R www-data.www-data /var/www/html

composer.phar install --no-dev --no-interaction --prefer-dist --optimize-autoloader

npm install

npm run build

php artisan storage:link

php artisan optimize:clear


