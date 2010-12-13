<?php
/**
 * Classe mère pour toute classe permettant de générer des champs de type h*
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 06/07/2010
 */
/**
 * Classe mère pour toute classe permettant de générer des champs de type h*
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 06/07/2010
 */
class HtmlTagH extends HtmlTag
{
	/**
	 * H1
	 * @var string
	 */
	const H1 = 'h1';
	/**
	 * H2
	 * @var string
	 */
	const H2 = 'h2';
	/**
	 * H3
	 * @var string
	 */
	const H3 = 'h3';
	/**
	 * H4
	 * @var string
	 */
	const H4 = 'h4';
	/**
	 * H5
	 * @var string
	 */
	const H5 = 'h5';
	/**
	 * H6
	 * @var string
	 */
	const H6 = 'h6';
	/**
	 * Constructeur de la classe
	 * @see parent::__construct()
	 * 
	 * @uses HtmlTagH::__className()
	 * @return HtmlTagH
	 */
	public function __construct($_tagName)
	{
		if(is_string($_tagName) && defined(HtmlTagH::__className() . '::' . strtoupper($_tagName)))
			parent::__construct($_tagName);
	}
	/**
	 * Méthode retournant le nom du tag de la classe
	 *
	 * @uses HtmlTagH::H1
	 * @uses HtmlTagH::H2
	 * @uses HtmlTagH::H3
	 * @uses HtmlTagH::H4
	 * @uses HtmlTagH::H5
	 * @uses HtmlTagH::H6
	 * @return string HtmlTagH::H1 . '|' . HtmlTagH::H2 . '|' . HtmlTagH::H3 . '|' . HtmlTagH::H4 . '|' . HtmlTagH::H5 . '|' . HtmlTagH::H6
	 */
	public static function __tagName()
	{
		return HtmlTagH::H1 . '|' . HtmlTagH::H2 . '|' . HtmlTagH::H3 . '|' . HtmlTagH::H4 . '|' . HtmlTagH::H5 . '|' . HtmlTagH::H6;
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