<!DOCTYPE html>
<html class="h-100">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title><?= $title ?? 'Shop'?></title>
	<link rel="stylesheet" href="/css/bootstrap.min.css" type="text/css" media="screen" title="no title" charset="utf-8">
</head>

<body class="d-flex flex-column h-100">
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
		<a href="" class="navbar-brand">Shop</a>
	</nav>
	<div class="container mt-4">
		<?= $content ?>
	</div>
	<script src="/js/bootstrap.min.js" charset="utf-8"></script>
	<script src="/js/jquery-3.6.0.min.js" charset="utf-8"></script>
	<footer class="bg-light py-4 footer mt-auto">
		<div class="container">
		<?php if(defined('DEBUG_TIME')): ?>
			Page genereted in <?= round(1000 * (microtime(true)-DEBUG_TIME)) ?> ms
		<?php endif ?>
		</div>
	</footer>
</body>

</html>
