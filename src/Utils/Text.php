<?php

namespace App\Utils;

/**
 * Class Text
 * @author Abama
 */
class Text
{
	/**
	 * Getter for 
	 *
	 * @return string
	 */
	public static function getShorText(string $content, int $limit = 72): string
	{
		if (strlen($content) <= $limit) {
			return $content;
		}
		$strPos = strpos($content, ' ', $limit);
		return substr($content, 0, $strPos) . '...';
	}

	public static function listHtml(array $listPhp)
	{
		$list = '<ul>';
		foreach ($listPhp as $element) {
			$list .= '<li class="mr-6>' . $element . '</li>';
		}
		$list .= '</ul>';
		return $list;
	}
}
