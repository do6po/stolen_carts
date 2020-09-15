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
                $router->get(
                    'models/search',
                    [
                        'as' => 'models.search',
                        'uses' => 'ModelController@search'
                    ]
                );

                $router->get(
                    'makes/search',
                    [
                        'as' => 'makes.search',
                        'uses' => 'MakeController@search'
                    ]
                );
            }
        );
    }
);
