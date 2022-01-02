<?php

namespace App;

use AltoRouter;

/**
 * Class Router
 * @author Abama
 */
class Router {
	/**
	 *@var string
	 */
	private $viewPath;

	/**
	 *@var AltoRouter
	 */
	private $router;

	public function __construct(string $viewPath) {
		$this->viewPath = $viewPath;
		$this->router = new AltoRouter();
	}

	/**
	 * Getter for 
	 *
	 * @return string
	 */
	public function get(string $url, string $view, ?string $name=null): self {
	    $this->router->map('GET', $url, $view, $name);
		return $this;
	}
	
	public function run(): self {
		$match = $this->router->match();
		$params = $match['params'];
		$router = $this;
		ob_start();
		if($match) {
			$view = $match['target'];
			require $this->viewPath . $view .".php";
		} else {
			require $this->viewPath . "/errors/404.php";
		}
		$content = ob_get_clean();
		require $this->viewPath . "/layouts/default.php";
		unset($content);
		return $this;
	}

	/**
	* generate url from route name and paramaters
	* @param string $routeName, array $params
	* 
	* @return string
	*/
	public function url( string $routeName, array $params = []): string {
		return $this->router->generate($routeName, $params);
	}
}
