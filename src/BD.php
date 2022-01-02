<?php

namespace App;
use \PDO;

/**
* Class BD
* @author Abama
*/
class BD
{
	public static function getPDO() {
		return new PDO("mysql:dbname=shop;host=127.0.0.1", 'root', 'Fullmetal@1994', [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		]);
	}
}
