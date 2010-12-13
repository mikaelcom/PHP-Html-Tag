<?php
/**
 * Classe mère pour toute classe permettant de générer des champs de type var
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 07/07/2010
 */
/**
 * Classe mère pour toute classe permettant de générer des champs de type var
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 07/07/2010
 */
class HtmlTagVar extends HtmlTag
{
	/**
	 * Constructeur de la classe
	 * @see parent::__construct()
	 * 
	 * @uses HtmlTagVar::__tagName()
	 * @return HtmlTagVar
	 */
	public function __construct()
	{
		parent::__construct(HtmlTagVar::__tagName());
	}
	/**
	 * Méthode retournant le nom du tag de la classe
	 *
	 * @return string var
	 */
	public static function __tagName()
	{
		return 'var';
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