<?php
/**
 * Classe mère permettant de générer un élément HTML de type style
 * Root class to generate a style element
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 06/07/2010
 */
/**
 * Classe mère permettant de générer un élément HTML de type style
 * Root class to generate a style element
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 06/07/2010
 */
class HtmlTagStyle extends HtmlTag
{
	/**
	 * Constructeur de la classe / Class constructor
	 * @see parent::__construct()
	 * 
	 * @uses HtmlTagStyle::__tagName()
	 * @return HtmlTagStyle
	 */
	public function __construct()
	{
		parent::__construct(HtmlTagStyle::__tagName());
	}
	/**
	 * Méthode retournant le nom du tag de la classe
	 * Method returning the tag name
	 *
	 * @return string style
	 */
	public static function __tagName()
	{
		return 'style';
	}
	/**
	 * Surcharge de la méthode car le code CSS ne doit pas être encodé en entités HTML
	 * Override method to ensure CSS code is not HTML encoded
	 * @see HtmlTag::_setValue()
	 * 
	 * @param mixed|HtmlTag
	 * @param bool indique s'il faut ou non encoder les données / indicates if the data has to be html encoded
	 * @return bool true|false
	 */
	public function _setValue($_value,$_encodeHtmlEntities = true)
	{
		return parent::_setValue(is_string($_value)?html_entity_decode($_value,ENT_QUOTES,HtmlTag::getEncoding()):$_value,$_encodeHtmlEntities && false);
	}
	/**
	 * Surcharge de la méthode afin de conserver les commentaires dans le cas de code JS
	 * @see HtmlTag::keepComments()
	 * 
	 * @return bool true
	 */
	protected function keepComments()
	{
		return true;
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