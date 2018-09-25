<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>


# Register

Install JWT and user registry:

# 1 - JWT

## Install jwt
	composer require tymon/jwt-auth:dev-develop --prefer -source

## declare in app 
	config/app.php
		providers[]/ aliases[]
		
		#providers[]
			Tymon\JWTAuth\Providers\LaravelServiceProvider::class

		#aliases[]
			'JWTAuth' => Tymon\JWTAuth\Facades\JWTAuth::class, 
        	'JWTFactory' => Tymon\JWTAuth\Facades\JWTFactory::class,

## declare in kernel
	app/Http/Kernel.php
		$routeMiddleware 
			'jwt.auth' => 'Tymon\JWTAuth\Middleware\GetUserFromToken',
        	'jwt.refresh' => 'Tymon\JWTAuth\Middleware\RefreshToken',




# 2 - Auth Controller
	AuthController.php




# 3 - Install cors
	composer require barryvdh/laravel-cors

## declare in kernel
	app/Http/Kernel.php
	$middleware 
		\Barryvdh\Cors\HandleCors::class,

## publication at the provider
	php artisan vendor:publish --provider="Barryvdh\Cors\ServiceProvider"