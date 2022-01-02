<?php

namespace App\Model;

require dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "vendor/autoload.php";

use App\Utils\Text;
use \DateTime;


/**
* Class  Product
* @author yourname
*/
class Product {
	private $id;
	private $name;
	private $price;
	private $registred_date;
	private $slug;
	private $image;
	private $description;

	/**
	 * Getter for id
	 *
	 * @return string
	 */
	public function getId() {
	    return htmlentities($this->id);
	}

	/**
	 * Getter for name
	 *
	 * @return string
	 */
	public function getName() {
	    return htmlentities($this->name);
	}

	/**
	 * Getter for price
	 *
	 * @return string
	 */
	public function getPrice() {
	    return htmlentities($this->price);
	}

	/**
	 * Getter for registred_date
	 *
	 * @return DateTime
	 */
	public function getRegistred_date():DateTime {
	    return new DateTime($this->registred_date);
	}

	/**
	 * Getter for slug
	 *
	 * @return string
	 */
	public function getSlug() {
	    return htmlentities($this->slug);
	}

	/**
	 * Getter for image
	 *
	 * @return string
	 */
	public function getImage() {
	    return htmlentities($this->image);
	}

	/**
	 * Getter for description
	 *
	 * @return string
	 */
	public function getDescription() {
	    return htmlentities($this->description);
	}

	/**
	 * Get a short description from Description member
	 *
	 * @return string
	 */
	public function getShortDescription()
	{
		$shortDescription = Text::getShorText('😀' . nl2br(htmlentities($this->description)));
	    return $shortDescription;
	}
}
