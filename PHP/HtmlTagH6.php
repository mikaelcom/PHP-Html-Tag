<?php
/**
 * Classe mère pour toute classe permettant de générer des champs de type h6
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 06/07/2010
 */
/**
 * Classe mère pour toute classe permettant de générer des champs de type h6
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 06/07/2010
 */
class HtmlTagH6 extends HtmlTagH
{
	/**
	 * Constructeur de la classe
	 * @see parent::__construct()
	 * 
	 * @uses HtmlTagH6::__tagName()
	 * @return HtmlTagH6
	 */
	public function __construct()
	{
		parent::__construct(HtmlTagH6::__tagName());
	}
	/**
	 * Méthode retournant le nom du tag de la classe
	 *
	 * @uses HtmlTagH::H6
	 * @return string HtmlTagH::H6
	 */
	public static function __tagName()
	{
		return HtmlTagH::H6;
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