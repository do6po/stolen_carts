<?php

/** @var Laravel\Lumen\Routing\Router $router */

$router->get(
    '/',
    function () use ($router) {
        return redirect(route('api'));
    }
);
