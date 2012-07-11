<?php
/**
 * Classe mère permettant de générer un élément HTML de type embed
 * Root class to generate an em element
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 03/09/2011
 */
/**
 * Classe mère permettant de générer un élément HTML de type embed
 * Root class to generate an em element
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 03/09/2011
 */
class HtmlTagEmbed extends HtmlTag
{
	/**
	 * Constructeur de la classe / Class constructor
	 * @see parent::__construct()
	 * 
	 * @uses HtmlTagEmbed::__tagName()
	 * @return HtmlTagEmbed
	 */
	public function __construct()
	{
		parent::__construct(HtmlTagEmbed::__tagName());
	}
	/**
	 * Méthode retournant le nom du tag de la classe
	 * Method returning the tag name
	 *
	 * @return string embed
	 */
	public static function __tagName()
	{
		return 'embed';
	}
	/**
	 * Méthode retournant le nom de la classe telle quelle
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