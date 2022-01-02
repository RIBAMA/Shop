<?php
require '../vendor/autoload.php';

use App\Router;

define('DEBUG_TIME', microtime(true));


$page = ($_GET['page'] ?? 1);
if (isset($page) and $page === '1') {
	$uri = explode('?', $_SERVER["REQUEST_URI"])[0];
	$get = $_GET;
	unset($get['page']);
	if (!empty($get)) {
		$uri .= '?' . http_build_query($get);
	}
	header("Location:" . $uri);
	exit();
	http_response_code(301);
}

$uri = (new Router(dirname(__DIR__) . "/views"))
	->get('/store/products', '/products/index', 'products')
	->get('/products', '/products/index')
	->get('/store', '/products/index')
	->get('/', '/products/index')
	->get('/store/[*:slug]-[i:id]', '/products/product', 'product')
	->get('/store/categories', '/categories/index', 'categorie')
	->run();
