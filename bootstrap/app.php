<?php

require_once __DIR__ . '/../vendor/autoload.php';

(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(dirname(__DIR__)))
    ->bootstrap();

date_default_timezone_set(env('APP_TIMEZONE', 'UTC'));

$app = new Laravel\Lumen\Application(dirname(__DIR__));

$app->withFacades();

$app->withEloquent();

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->configure('app');

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/

$app->middleware(
    [
        App\Http\Middleware\JsonMiddleware::class
    ]
);

// $app->routeMiddleware([
//     'auth' => App\Http\Middleware\Authenticate::class,
// ]);

/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

$app->register(App\Providers\AppServiceProvider::class);
$app->register(App\Providers\AuthServiceProvider::class);
$app->register(App\Providers\EventServiceProvider::class);
$app->register(Illuminate\Redis\RedisServiceProvider::class);
$app->register(Pearl\RequestValidate\RequestServiceProvider::class);
$app->register(EloquentFilter\LumenServiceProvider::class);

/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
|
| Next we will include the routes file so that they can all be added to
| the application. This will provide all of the URLs the application
| can respond to, as well as the controllers that may handle them.
|
*/

$app->router->group(
    [
        'namespace' => 'App\Http\Controllers',
    ],
    function ($router) {
        require __DIR__ . '/../routes/web.php';
    }
);

$app->router->group(
    [
        'namespace' => 'App\Http\Controllers\Api',
    ],
    function ($router) {
        require __DIR__ . '/../routes/api.php';
    }
);

return $app;
