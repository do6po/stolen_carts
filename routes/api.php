<?php
/** @var Laravel\Lumen\Routing\Router $router */

$router->group(
    [
        'prefix' => 'api',
    ],
    function () use ($router) {
        $router->get(
            '/',
            [
                'as' => 'api',
                function () {
                    return [];
                }
            ]
        );

        $router->group(
            [
                'namespace' => 'Cars',
                'prefix' => 'cars',
                'as' => 'api.cars'
            ],
            function () use ($router) {
                $router->post('', ['as' => 'create', 'uses' => 'CarController@create']);
            }
        );
    }
);
