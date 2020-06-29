<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/isearch'], function (Router $router) {
    $router->get('modules', [
        'as' => 'admin.isearch.modules.index',
        'uses' => 'IsearchController@index',
        //'middleware' => 'can:page.pages.index',
    ]);
});

