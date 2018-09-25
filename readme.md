<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>


# Auth

user authentication:

## 1 - Model User
	#import
		use Tymon\JWTAuth\Contracts\JWTSubject;
	
	#implements JWTSubject
		class User extends Authenticatable implements JWTSubject

	#functions
		function getJWTIdentifier();
		function getJWTCustomClaims();

## 2 - config/auth.php
	'defaults' => [
        'guard' => 'api',
        'passwords' => 'users',
    ],

    'guards' => [
        'api' => [
            'driver' => 'jwt',
            'provider' => 'users',
        ],
    ],

## 3 - routes/api.php
	Route::group([
	    'middleware' => 'api',
	    'prefix' => 'auth'
	], function() {
	    Route::post('/register', 'AuthController@register');
	    Route::post('/login', 'AuthController@login');
	    Route::get('/me', 'AuthController@me');
	});

## 4 - config Exceptions
	namespace Illuminate\Foundation\Exceptions;
	Handler.php

	protected function unauthenticated($request, AuthenticationException $exception)
    {
        return response()->json(['message' => $exception->getMessage()], 401);
    }

## 5 - AuthController
	function __construct();

	function login(Request $request);

	function guard();

	function respondWithToken($token);

	function me();


# 6 - TEST

	#URL
		http://127.0.0.1:8000/api/auth/register
	#BULK EDIT
		firstName:Smythy
		lastName:costa
		email:smythy.costa@email.com
		password:123456


	#URL
		http://127.0.0.1:8000/api/auth/login
	#BULK EDIT
		//firstName:Smythy
		//lastName:costa
		email:smythy.costa@email.com
		password:123456
	#RESPONSE
		{
		    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE1Mzc4ODc4ODMsImV4cCI6MTUzNzg5MTQ4MywibmJmIjoxNTM3ODg3ODgzLCJqdGkiOiJGajRMRUxKTEIxY2JwTXJyIiwic3ViIjo0LCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.iFLo4W0cysfmO16z-Go-cuGNDQP-dYjzkMgjYquHu_Y",
		    "token_type": "bearer",
		    "expires_in": 3600
		}


	#URL
		http://127.0.0.1:8000/api/auth/me
	#BULK EDIT
		//Content-Type:application/x-www-form-urlencoded
		Authorization:bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE1Mzc4ODc4ODMsImV4cCI6MTUzNzg5MTQ4MywibmJmIjoxNTM3ODg3ODgzLCJqdGkiOiJGajRMRUxKTEIxY2JwTXJyIiwic3ViIjo0LCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.iFLo4W0cysfmO16z-Go-cuGNDQP-dYjzkMgjYquHu_Y
