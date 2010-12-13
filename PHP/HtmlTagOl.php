<?php
/**
 * Classe mère pour toute classe permettant de générer un élément ul/ol HtmlTag
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 16/12/2009
 */
/**
 * Classe mère pour toute classe permettant de générer un élément ul/ol HtmlTag
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 16/12/2009
 */
class HtmlTagOl extends HtmlTagList
{
	/**
	 * Constructeur de la classe
	 * @see parent::__construct()
	 * 
	 * @uses HtmlTagOl::__tagName()
	 * @return HtmlTagOl
	 */
	public function __construct()
	{
		parent::__construct(HtmlTagOl::__tagName());
	}
	/**
	 * Méthode retournant le nom du tag de la classe
	 *
	 * @uses HtmlTagList::OL
	 * @return string HtmlTagList::OL
	 */
	public static function __tagName()
	{
		return HtmlTagList::OL;
	}
	/**
	 * Méthode retournant le nom de la classe telle quelle
	 *
	 * @return string __CLASS__
	 */
	public static function __className()
	{
		return __CLASS__;
	}
}
?>