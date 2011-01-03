<?php
/**
 * Classe mère permettant de générer un élément HTML de type col
 * Root class to generate a col element
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 05/11/2010
 */
/**
 * Classe mère permettant de générer un élément HTML de type col
 * Root class to generate a col element
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 05/11/2010
 */
class HtmlTagCol extends HtmlTag
{
	/**
	 * Constructeur de la classe / Class constructor
	 * @see parent::__construct()
	 * 
	 * @uses HtmlTagCol::__tagName()
	 * @return HtmlTagCol
	 */
	public function __construct()
	{
		parent::__construct(HtmlTagCol::__tagName());
	}
	/**
	 * Méthode retournant le nom du tag de la classe
	 * Method returning the tag name
	 *
	 * @return string col
	 */
	public static function __tagName()
	{
		return 'col';
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