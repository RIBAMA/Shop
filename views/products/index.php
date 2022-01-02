<?php
require dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "vendor/autoload.php";

use App\BD;
use App\Model\Product;
use App\URL;

$title = 'Products';

$pdo = BD::getPDO();

$currentPage = URL::getPositiveInt('page', 1);


$numberOfArticles = $pdo->query('SELECT COUNT(id) FROM product')->fetch(PDO::FETCH_NUM)[0];
$perPage = 12;
$numberOfPages = ceil($numberOfArticles / $perPage);

if ($currentPage > $numberOfPages) {
	throw new Exception("invalid page number: current page it's higher than the number of page");
}

$offset = ($currentPage - 1) * $perPage;
$query = $pdo->query("SELECT * FROM product ORDER BY name ASC LIMIT $perPage OFFSET $offset");
$products = $query->fetchAll(PDO::FETCH_CLASS, Product::class);

function url($routeName, $params)
{
	return $routeName . "/" . $params["slug"] . "-" . $params["id"];
}

?>

<div class="d-flex justify-content-between my-4">
	<?php if ($currentPage > 1) : ?>
		<a href="<?= $router->url("products") ?>?page=<?= $currentPage - 1 ?>" class="btn btn-primary">&laquo previous</a>
	<?php endif ?>
	<?php if ($currentPage < $numberOfPages) : ?>
		<a href="<?= $router->url("products") ?>?page=<?= $currentPage + 1 ?>" class="btn btn-primary ml-auto">next &raquo</a>
	<?php endif ?>
</div>

<?php
ob_start();
$paginationControl = ob_get_clean();
$paginationControl = ob_get_contents();
?>

<h1>List of products</h1>
<div class="row">
	<?php foreach ($products as $product) : ?>
		<div class="col-md-6 col-lg-4 my-2">
			<?php require "card.php" ?>
		</div>
	<?php endforeach ?>
</div>

<?= $paginationControl ?>
