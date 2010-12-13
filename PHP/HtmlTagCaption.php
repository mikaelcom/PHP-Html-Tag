<?php
/**
 * Classe mère pour toute classe permettant de générer des champs de type caption
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 06/07/2010
 */
/**
 * Classe mère pour toute classe permettant de générer des champs de type caption
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 06/07/2010
 */
class HtmlTagCaption extends HtmlTag
{
	/**
	 * Constructeur de la classe
	 * @see parent::__construct()
	 *
	 * @uses HtmlTagCaption::__tagName()
	 * @return HtmlTagCaption
	 */
	public function __construct()
	{
		parent::__construct(HtmlTagCaption::__tagName());
	}
	/**
	 * Méthode retournant le nom du tag de la classe
	 *
	 * @return string caption
	 */
	public static function __tagName()
	{
		return 'caption';
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