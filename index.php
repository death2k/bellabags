<?php
session_start();
use Codemy\Repositories\UserRepository as UserRepository;
use Codemy\Filters\AuthFilter as AuthFilter;  
use Codemy\DB\Sql as Sql;
use Slim\Slim;
use Codemy\Models\Page;
use Codemy\Models\PageAdmin;
use Codemy\Models\User;
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
	$app->get('/admin', function() {

		User::verifyLogin();

		$page = new PageAdmin();
		$page->setTpl("index");
	});

	$app->get('/admin/login', function() {
		$page = new PageAdmin([
			"header"=>false,
			"footer"=>false
		]);
		$page->setTpl("login");
	});
	$app->post('/admin/login', function() {
		User::login($_POST["login"], $_POST["password"]); 
		header("Location: /admin");
		exit;
	});

	$app->get('/admin/logout', function(){

		User::logout();

		header("Location: /admin/login");

		exit;

	});

// CRUD CREATE UPDATE DELL - USERS
	$app->get('/admin/users', function() {
		User::verifyLogin();
		$user = User::listAll();
		$page = new PageAdmin();
		$page->setTpl("users", array(
			'user'=>$user
		));
		
	});

	$app->get('/admin/users/create', function() {
		User::verifyLogin();
		$page = new PageAdmin();
		$page->setTpl("users-create");
	});
	$app->get('/admin/users/:iduser/delete ', function($iduser) {
		User::verifyLogin();
	});
	$app->get('/admin/users/:iduser', function($iduser) {
		User::verifyLogin();
		$page = new PageAdmin();
		$page->setTpl("users-update");
	});
	$app->post('/admin/users/create', function() {
		User::verifyLogin();
	});
	$app->post('/admin/users/:iduser', function($iduser) {
		User::verifyLogin();
	});
	


$app->run();



 ?> 