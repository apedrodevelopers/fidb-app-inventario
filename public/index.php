<?php
session_start();

use Bramus\Router\Router;

require "../vendor/autoload.php";

$r = new Router;

$r->get("/", "\App\Controllers\AuthController@index");
$r->post("/login", "\App\Controllers\AuthController@autenticar");
$r->get("/logout", "\App\Controllers\AuthController@sair");

$r->get("/admin/dashboard", "\App\Controllers\DashboardController@index");

$r->get("/admin/produtos/lista", "\App\Controllers\ProdutoController@index");
$r->get("/admin/produtos/novo", "\App\Controllers\ProdutoController@create");
$r->post("/admin/produtos", "\App\Controllers\ProdutoController@store");
$r->get("/admin/produtos/{id}/confirmar-apagar", "\App\Controllers\ProdutoController@showDeletePage");
$r->get("/admin/produtos/{id}/apagar", "\App\Controllers\ProdutoController@delete");
$r->get("/admin/produtos/{id}/editar", "\App\Controllers\ProdutoController@edit");
$r->post("/admin/produtos/{id}/editar", "\App\Controllers\ProdutoController@update");

$r->before("GET|POST", "/admin/.*", "\App\Controllers\AuthController@verificarAutenticacao");

$r->run();
