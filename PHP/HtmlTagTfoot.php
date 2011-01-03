<?php
/**
 * Classe mère permettant de générer un élément HTML de type tfoot
 * Root class to generate a tfoot element
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 06/07/2010
 */
/**
 * Classe mère permettant de générer un élément HTML de type tfoot
 * Root class to generate a tfoot element
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 06/07/2010
 */
class HtmlTagTfoot extends HtmlTagTableTPart
{
	/**
	 * Constructeur de la classe / Class constructor
	 * @see parent::__construct()
	 * 
	 * @uses HtmlTagTfoot::__tagName()
	 * @return HtmlTagTfoot
	 */
	public function __construct()
	{
		parent::__construct(HtmlTagTfoot::__tagName());
	}
	/**
	 * Méthode retournant le nom du tag de la classe
	 * Method returning the tag name
	 *
	 * @uses HtmlTagTableTPart::TFOOT
	 * @return string HtmlTagTableTPart::TFOOT
	 */
	public static function __tagName()
	{
		return HtmlTagTableTPart::TFOOT;
	}
	/**
	 * Méthode retournant le nom de la classe telle quelle
	 * Method returning the class name
	 *
	 * @return string __CLASS__
	 */
	public static function __className()
	{
		return __CLASS__;
	}
}
?>