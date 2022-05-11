<?php
require 'core/bootstrap.php';

$routes = [
	'/hallo/welt' => 'WelcomeController@index',
	'/borrow' => 'BorrowController@index',
	'/createborrow' => 'BorrowController@new',
	'/create' => 'BorrowController@upsert',
	'/edit' => 'BorrowController@edit',
	'/upsert' => 'BorrowController@upsert',
];

$db = [
	'name'     => 'meinedatenbank',
	'username' => 'root',
	'password' => '',
];

$router = new Router($routes);
$router->run($_GET['url'] ?? '');
