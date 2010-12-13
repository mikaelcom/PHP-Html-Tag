<?php
/**
 * Classe mère pour toute classe permettant de générer des champs de type dl
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 07/07/2010
 */
/**
 * Classe mère pour toute classe permettant de générer des champs de type dl
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 07/07/2010
 */
class HtmlTagDl extends HtmlTag
{
	/**
	 * Constructeur de la classe
	 * @see parent::__construct()
	 * 
	 * @uses HtmlTagDl::__tagName()
	 * @return HtmlTagDl
	 */
	public function __construct()
	{
		parent::__construct(HtmlTagDl::__tagName());
	}
	/**
	 * Méthode retournant le nom du tag de la classe
	 *
	 * @return string dl
	 */
	public static function __tagName()
	{
		return 'dl';
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