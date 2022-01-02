<?php

use App\BD;
use App\Model\Product;
use App\Utils\Text;

require dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "vendor/autoload.php";

function slugToTitle(string $slug): string
{
	$title = str_replace('-', ' ', $slug);
	$title[0] = strtoupper($title[0]);
	return $title;
}


$id = (int)$params['id'];
$slug = $params['slug'];
$title = slugToTitle($slug);

$pdo = BD::getPDO();
$query = $pdo->prepare("SELECT * FROM product WHERE id=:id");
$query->setFetchMode(PDO::FETCH_CLASS, Product::class);
$query->execute(['id' => $id]);
/** @var Product|false $product */
$product = $query->fetch();
if ($product === false) {
	throw new Exception('zero field matched in database');
}
$slugDB = $product->getSlug();
if ($slugDB !== $slug) {
	$url = $router->url('product', ['slug' => $slugDB, 'id' => $id]);
	header("Location: " . $url);
}

$query = $pdo->prepare("SELECT name FROM category, product_category WHERE product_category.product_id=:id");
$query->execute(['id' => $id]);
$categoriesArray = $query->fetchAll(PDO::FETCH_ASSOC);
$categories = [];
foreach ($categoriesArray as $categoryArray) {
	$categories[] = $categoryArray['name'];
}
$listOfCategories = Text::listHtml($categories);
?>

<div class="card">
	<div class="card-body mb-3">
		<div class="row">
			<div>
				<div style="background-color: rgb(230, 230, 230); width:250px; height:445px; background-image:url('/images/products/<?= $product->getImage() ?>.jpg');background-size: cover; background-position: center">
				</div>
				<style type="text/css" media="screen">
					ul {
						display: flex;
						list-style: none;
					}
					li {
						margin-left: 10px;
					}
				</style>
				<?= $listOfCategories ?>
			</div>
			<div class="col-sm-5 col-md-5 col-lg-7">
				<h5 class="card-title"><?= $product->getName() ?></h5>
				<p class="text-muted"><?= $product->getRegistred_date()->format("d F y H:i") ?></p>
				<p class=""><?= $product->getDescription() ?></p>
				<?php 
				/*
				<a class="btn btn-primary" href="<?= $router->url('product', ["id" => $product->getId(), "slug" => $product->getSlug()]) ?>" role="button">see more</a>
				*/
				?>
			</div>
		</div>
	</div>
</div>
