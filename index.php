<?php

use Codemy\Repositories\UserRepository as UserRepository;
use Codemy\Filters\AuthFilter as AuthFilter;
use Codemy\DB\Sql as Sql;
require_once 'app/start.php';


$app = new \Slim\Slim();

$app->config('debug', true);

$app->get('/', function() {
	
	
	$sql = new Sql();

	$results = $sql->select("SELECT * FROM tb_users");

	echo json_encode($results);

});

$app->run();

 ?>