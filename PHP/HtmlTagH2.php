<?php
/**
 * Classe mère permettant de générer un élément HTML de type h2
 * Root class to generate a h2 element
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 06/07/2010
 */
/**
 * Classe mère permettant de générer un élément HTML de type h2
 * Root class to generate a h2 element
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 06/07/2010
 */
class HtmlTagH2 extends HtmlTagH
{
	/**
	 * Constructeur de la classe / Class constructor
	 * @see parent::__construct()
	 * 
	 * @uses HtmlTagH2::__tagName()
	 * @return HtmlTagH2
	 */
	public function __construct()
	{
		parent::__construct(HtmlTagH2::__tagName());
	}
	/**
	 * Méthode retournant le nom du tag de la classe
	 * Method returning the tag name
	 *
	 * @uses HtmlTagH::H2
	 * @return string HtmlTagH::H2
	 */
	public static function __tagName()
	{
		return HtmlTagH::H2;
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