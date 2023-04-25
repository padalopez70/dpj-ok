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

////////////////////////////////////////
ERROR UPLOAD DE ARCHIVO CON LIVEWIRE

editar:
1- editar app/Http/Middleware/TrustProxies.php
cambiar linea a: 
> protected $proxies = "*";

2- editar vendor/livewire/livewire/src/Controllers/FileUploadHandler.php
comentar linea:
> //abort_unless(request()->hasValidSignature(), 401);
