<?php
/**
 * Classe m�re permettant de g�n�rer un �l�ment HTML de type h2
 * Root class to generate a h2 element
 * @package Common
 * @subpackage HtmlTag
 * @author Mika�l DELSOL
 * @copyright Mika�l DELSOL
 * @version 1.0
 * @date 06/07/2010
 */
/**
 * Classe m�re permettant de g�n�rer un �l�ment HTML de type h2
 * Root class to generate a h2 element
 * @package Common
 * @subpackage HtmlTag
 * @author Mika�l DELSOL
 * @copyright Mika�l DELSOL
 * @version 1.0
 * @date 06/07/2010
 */
class HtmlTagH2 extends HtmlTagH
{
	/**
	 * Constructeur de la classe / Class constructor
	 * @see parent::__construct()
	 * 
	 * @uses HtmlTagH2::__tagName()
	 * @return HtmlTagH2
	 */
	public function __construct()
	{
		parent::__construct(HtmlTagH2::__tagName());
	}
	/**
	 * M�thode retournant le nom du tag de la classe
	 * Method returning the tag name
	 *
	 * @uses HtmlTagH::H2
	 * @return string HtmlTagH::H2
	 */
	public static function __tagName()
	{
		return HtmlTagH::H2;
	}
	/**
	 * M�thode retournant le nom de la classe telle quelle
	 * Method returning the class name
	 *
	 * @return string __CLASS__
	 */
	public static function __className()
	{
		return __CLASS__;
	}
}
?>