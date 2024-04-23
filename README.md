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
enviar cambios a git

git clone git@github.com:padalopez70/dpj-ok dpj-prod

composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

npm install

npm run build

EN CONTAINER php artisan storage:link

EN CONTAINER php artisan optimize:clear


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


### para subir al hosting
 php artisan cache:clear
 php artisan route:clear
 php artisan config:clear
 php artisan view:clear


//---------------------------------------para que funcione el upload tienes:-------------------------------------

1. luego del git clone... cuando hacer el "composer require...." te crea una nueva carpeta vendor (la carpeta que tiene todas las librerias de composer/php) tenes que editar el archivo:

vendor/livewire/livewire/src/Controllers/FileUploadHandler.php 

y comentar la linea:
abort_unless(request()->hasValidSignature(), 401);
[9:05, 5/6/2023] Juan Granda: 2. tienes que hacer si o si el storage:link en el servdior:
php artisan storage:link
[9:05, 5/6/2023] Juan Granda: 3. tienes que cambiar los permisos de storage (obvaimente esto y lo anterior estando en /var/www/html):
 chown -R www-data.www-data storage/

para setear el menu de admilte editar
AuthServiceProvider.php en la carpeta Providers
