<?php
/**
 * Classe mère pour toute classe permettant de générer des champs de type del
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 07/07/2010
 */
/**
 * Classe mère pour toute classe permettant de générer des champs de type del
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 07/07/2010
 */
class HtmlTagDel extends HtmlTag
{
	/**
	 * Constructeur de la classe
	 * @see parent::__construct()
	 * 
	 * @uses HtmlTagDel::__tagName()
	 * @return HtmlTagDel
	 */
	public function __construct()
	{
		parent::__construct(HtmlTagDel::__tagName());
	}
	/**
	 * Méthode retournant le nom du tag de la classe
	 *
	 * @return string del
	 */
	public static function __tagName()
	{
		return 'del';
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