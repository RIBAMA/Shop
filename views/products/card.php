<div class="card">
	<div class="card-body mb-3">
			<div style="background-color: rgb(230, 230, 230); width:250px; height:140px; background-image:url('/images/products/<?= $product->getImage() ?>.jpg');background-size: cover; background-position: center;">
			</div>
		<h5 class="card-title"><?= $product->getName() ?></h5>
		<p class="text-muted"><?= $product->getRegistred_date()->format("d F y H:i") ?></p>
		<p><?= $product->getShortDescription() ?></p>
		<a class="btn btn-primary" href="<?= $router->url('product', ["id" => $product->getId(), "slug" => $product->getSlug()]) ?>" role="button">see more</a>
	</div>
</div>
