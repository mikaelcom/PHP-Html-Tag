<?php
/**
 * Classe mère pour toute classe permettant de générer des champs de type bdo
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 05/11/2010
 */
/**
 * Classe mère pour toute classe permettant de générer des champs de type bdo
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 05/11/2010
 */
class HtmlTagBdo extends HtmlTag
{
	/**
	 * Constructeur de la classe
	 * @see parent::__construct()
	 * 
	 * @uses HtmlTagBdo::__tagName()
	 * @return HtmlTagBdo
	 */
	public function __construct()
	{
		parent::__construct(HtmlTagBdo::__tagName());
	}
	/**
	 * Méthode retournant le nom du tag de la classe
	 *
	 * @return string bdo
	 */
	public static function __tagName()
	{
		return 'bdo';
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