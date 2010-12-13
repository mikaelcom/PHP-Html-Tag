<?php
/**
 * Classe mère pour toute classe permettant de générer des champs de type thead
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 06/07/2010
 */
/**
 * Classe mère pour toute classe permettant de générer des champs de type thead
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 06/07/2010
 */
class HtmlTagThead extends HtmlTagTableTPart
{
	/**
	 * Constructeur de la classe
	 * @see parent::__construct()
	 * 
	 * @uses HtmlTagThead::__tagName()
	 * @return HtmlTagThead
	 */
	public function __construct()
	{
		parent::__construct(HtmlTagThead::__tagName());
	}
	/**
	 * Méthode retournant le nom du tag de la classe
	 *
	 * @uses HtmlTagTableTPart::THEAD
	 * @return string HtmlTagTableTPart::THEAD
	 */
	public static function __tagName()
	{
		return HtmlTagTableTPart::THEAD;
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