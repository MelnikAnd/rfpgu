<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/isearch'], function (Router $router) {
    $router->get('/', [
        'as' => 'isearch.api.search.index',
        'uses' => 'IsearchController@search',
        //'middleware' => 'can:page.pages.index',
    ]);
});

