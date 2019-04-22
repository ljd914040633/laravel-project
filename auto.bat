@echo off
php artisan make:controller Admin/StreamController
php artisan make:controller Admin/LiveController
php artisan make:model Model/Stream
php artisan make:model Model/Live
pause