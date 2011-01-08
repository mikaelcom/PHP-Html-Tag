<?php
/**
 * Classe mère permettant de générer un élément HTML de type script
 * Root class to generate a script element
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 29/06/2010
 */
/**
 * Classe mère permettant de générer un élément HTML de type script
 * Root class to generate a script element
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 29/06/2010
 */
class HtmlTagScript extends HtmlTag
{
	/**
	 * Constructeur de la classe / Class constructor
	 * @see parent::__construct()
	 * 
	 * @uses HtmlTagScript::__tagName()
	 * @uses HtmlTag::setValue()
	 * @uses HtmlTag::setType()
	 * @uses HtmlTagScript::setCharset()
	 * @return HtmlTagScript
	 */
	public function __construct()
	{
		parent::__construct(HtmlTagScript::__tagName());
		$this->setType('text/javascript');
		$this->setCharset('ISO-8859-1');
	}
	/**
	 * Méthode permettant de définir l'attribut 'src' de l'élément HtmlTag
	 * Method to set src attribute value
	 *
	 * @uses HtmlTag::addAttribute()
	 * @param string la valeur de src
	 * @return bool true|false
	 */
	public function setSrc($_src)
	{
		return $this->addAttribute('src',trim($_src),true);
	}
	/**
	 * Méthode permettant de récupérer l'attribut 'src' de l'élément HtmlTag
	 * Method to get src attribute value
	 *
	 * @uses HtmlTag::getAttribute()
	 * @return string|null
	 */
	public function getSrc()
	{
		return $this->getAttribute('src');
	}
	/**
	 * Méthode permettant de supprimer l'attribut 'src' de l'élément HtmlTag
	 * Method to unset src attribute value
	 *
	 * @uses HtmlTag::unsetAttribute()
	 * @return string|null
	 */
	public function unsetSrc()
	{
		return $this->unsetAttribute('src');
	}
	/**
	 * Méthode permettant de définir l'attribut 'charset' de l'élément HtmlTag
	 * Method to set charset attribute value
	 *
	 * @uses HtmlTag::addAttribute()
	 * @param string la valeur de charset
	 * @return bool true|false
	 */
	public function setCharset($_charset)
	{
		return $this->addAttribute('charset',trim($_charset),true);
	}
	/**
	 * Méthode permettant de récupérer l'attribut 'charset' de l'élément HtmlTag
	 * Method to get charset attribute value
	 *
	 * @uses HtmlTag::getAttribute()
	 * @return string|null
	 */
	public function getCharset()
	{
		return $this->getAttribute('charset');
	}
	/**
	 * Méthode permettant de supprimer l'attribut 'charset' de l'élément HtmlTag
	 * Method to unset charset attribute value
	 *
	 * @uses HtmlTag::unsetAttribute()
	 * @return string|null
	 */
	public function unsetCharset()
	{
		return $this->unsetAttribute('charset');
	}
	/**
	 * Méthode retournant le nom du tag de la classe
	 * Method returning the tag name
	 *
	 * @return string script
	 */
	public static function __tagName()
	{
		return 'script';
	}
	/**
	 * Surcharge de la méthode car le code JS ne doit pas être encodé en entités HTML
	 * Override method to ensure JS code is not HTML encoded
	 * @see HtmlTag::_setValue()
	 * 
	 * @return bool true|false
	 */
	public function _setValue($_value)
	{
		return parent::_setValue(is_string($_value)?html_entity_decode($_value,ENT_QUOTES,HtmlTag::getEncoding()):$_value,false);
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