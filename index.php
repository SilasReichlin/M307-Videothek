<?php
require 'core/bootstrap.php';

$routes = [
	'/hallo/welt' => 'WelcomeController@index',
	'/borrow' => 'BorrowController@index',
	'/createborrow' => 'BorrowController@edit',
];

$db = [
	'name'     => 'meinedatenbank',
	'username' => 'root',
	'password' => '',
];

$router = new Router($routes);
$router->run($_GET['url'] ?? '');