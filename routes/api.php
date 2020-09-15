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
                    'makes/search',
                    [
                        'as' => 'makes.search',
                        'uses' => 'MakeController@search'
                    ]
                );

                $router->get(
                    'makes/{id}/models/search',
                    [
                        'as' => 'models.search',
                        'uses' => 'ModelController@search'
                    ]
                );
            }
        );

        $router->group(
            [
                'namespace' => 'Stolen',
                'prefix' => 'stolen',
                'as' => 'api.stolen'
            ],
            function () use ($router) {
                $router->post(
                    '',
                    [
                        'as' => 'create',
                        'uses' => 'StolenCarController@store'
                    ]
                );
            }
        );
    }
);
