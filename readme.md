<p align="center"><img src="https://www.contratos.gov.co/puc/comun/images/icono_secop.png"></p>



## Acerca de Secop v 1.0
Secop, es una aplicacion desarrollada con el Framework [Laravel 5.5](https://laravel.com/docs/5.5) 

## Recomendaciones para instalación en servidor local

## Paso 1 Instalar paquetes 

	composer install

## Paso 2 dar permisos a las carpetas de storage y storage/logs (linux)
	
	sudo chmod 777 -R storage

	cd storage

	sudo chmod 777 -R logs

## Paso 3 generar .env
	
	Copie y personalice su archivo .env

## Paso 4 generar key
	
	php artisan key:generate

## Paso 5 ejecute la migración y el seeder

	php artisan migrate --seed

	