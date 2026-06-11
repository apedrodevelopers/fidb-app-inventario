<?php

use Bramus\Router\Router;

require "../vendor/autoload.php";

$r = new Router;

$r->get("/", "\App\Controllers\AuthController@index");
$r->post("/login", "\App\Controllers\AuthController@autenticar");
$r->get("/logout", "\App\Controllers\AuthController@sair");

$r->run();
