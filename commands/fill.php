<?php
require dirname(__DIR__) . DIRECTORY_SEPARATOR . "assets/etc/sql.php";

$pdo = new PDO("$dbsm:dbname=$dbname;host=$host", $username, $password, [
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

$pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
$pdo->exec('TRUNCATE TABLE product_category');
$pdo->exec('TRUNCATE TABLE product');
$pdo->exec('TRUNCATE TABLE category');
$pdo->exec('TRUNCATE TABLE user');
$pdo->exec('SET FOREIGN_KEY_CHECKS = 1');

$products = [];
$categories = [];

for ($i = 0; $i < 50; ++$i) {
	$price = rand(1000, 10000);
	$pdo->exec("INSERT INTO product SET name='product #$i', slug='product-$i', registred_date='2021-12-17 08:57:33', price=$price, description='Lorem
	ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam
	voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.'");
	$products[] = $pdo->lastInsertId();
}

for ($i = 0; $i < 50; ++$i) {
	$price = rand(1000, 10000);
	$pdo->exec("INSERT INTO category SET name='category #$i', slug='category-$i', description='Lorem
	ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam
	voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.'");
	$categories[] = $pdo->lastInsertId();
}

foreach ($products as $product) {
	$randomCategories = array_rand($categories, rand(1, 4));
	if (!is_array($randomCategories)) {
		$randomCategories = array($randomCategories);
	}
	foreach ($randomCategories as $category) {
		if ($category === 0) {
			$category = 1;
		}
		$pdo->exec("INSERT INTO product_category SET product_id='$product', category_id='$category'");
	}
}

$password = password_hash('admin', PASSWORD_BCRYPT);
$pdo->exec("INSERT INTO user SET username='admin', password='$password'");
