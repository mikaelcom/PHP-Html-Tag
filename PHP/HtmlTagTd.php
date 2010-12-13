<?php
/**
 * Classe mère pour toute classe permettant de générer des champs de type td
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 06/07/2010
 */
/**
 * Classe mère pour toute classe permettant de générer des champs de type td
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 06/07/2010
 */
class HtmlTagTd extends HtmlTagTableCell
{
	/**
	 * Constructeur de la classe
	 * @see parent::__construct()
	 * 
	 * @uses HtmlTagTd::__tagName()
	 * @return HtmlTagTd
	 */
	public function __construct()
	{
		parent::__construct(HtmlTagTd::__tagName());
	}
	/**
	 * Méthode retournant le nom du tag de la classe
	 *
	 * @uses HtmlTagTableCell::TD
	 * @return string HtmlTagTableCell::TD
	 */
	public static function __tagName()
	{
		return HtmlTagTableCell::TD;
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