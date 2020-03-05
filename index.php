<?php

use Codemy\Repositories\UserRepository as UserRepository;
use Codemy\Filters\AuthFilter as AuthFilter;  
use Codemy\DB\Sql as Sql;
use Slim\Slim;
use Codemy\Models\Page;
use Codemy\Models\PageAdmin;
require_once 'app/start.php';


$app = new Slim();

$app->config('debug', true); 

	$app->get('/', function() {
		
		$page = new Page();
		$page->setTpl("index");
		//$sql = new Sql();
		//$results = $sql->select("SELECT * FROM tb_users");
		//echo json_encode($results);
	});
	$app->get('/admin/', function() {
		
	
		$page = new PageAdmin();
		$page->setTpl("index");
		//$sql = new Sql();
		//$results = $sql->select("SELECT * FROM tb_users");
		//echo json_encode($results);
	});

$app->run();



 ?> 