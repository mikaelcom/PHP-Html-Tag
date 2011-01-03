<?php
/**
 * Classe mère permettant de générer un élément ul/ol HtmlTag
 * Root class to generate an ul element
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 16/12/2009
 */
/**
 * Classe mère permettant de générer un élément ul/ol HtmlTag
 * Root class to generate an ul element
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 16/12/2009
 */
class HtmlTagUl extends HtmlTagList
{
	/**
	 * Constructeur de la classe / Class constructor
	 * @see parent::__construct()
	 * 
	 * @uses HtmlTagUl::__tagName()
	 * @return HtmlTagUl
	 */
	public function __construct()
	{
		parent::__construct(HtmlTagUl::__tagName());
	}
	/**
	 * Méthode retournant le nom du tag de la classe
	 * Method returning the tag name
	 * 
	 * @uses HtmlTagList::UL
	 * @return string HtmlTagList::UL
	 */
	public static function __tagName()
	{
		return HtmlTagList::UL;
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