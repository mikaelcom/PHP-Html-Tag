<?php
/**
 * Classe mère pour toute classe permettant de générer des éléments d'un ul/ol HtmlTag
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 16/12/2009
 */
/**
 * Classe mère pour toute classe permettant de générer des éléments d'un ul/ol HtmlTag
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 16/12/2009
 */
class HtmlTagLi extends HtmlTag
{
	/**
	 * Constructeur de la classe
	 * @see parent::__construct()
	 * 
	 * @uses HtmlTagLi::__tagName()
	 * @return HtmlTagLi
	 */
	public function __construct()
	{
		parent::__construct(HtmlTagLi::__tagName());
	}
	/**
	 * Méthode retournant le nom du tag de la classe
	 *
	 * @return string li
	 */
	public static function __tagName()
	{
		return 'li';
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