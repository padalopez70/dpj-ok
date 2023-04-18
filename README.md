## Sistema DPJ FESGO

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

composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

npm install

npm run build

php artisan storage:link

php artisan optimize:clear


chown -R www-data.www-data /var/www/html
