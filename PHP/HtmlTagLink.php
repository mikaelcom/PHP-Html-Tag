<?php
/**
 * Classe mère permettant de générer un élément HTML de type link
 * Root class to generate a link element
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 28/06/2010
 */
/**
 * Classe mère permettant de générer un élément HTML de type link
 * Root class to generate a link element
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 28/06/2010
 */
class HtmlTagLink extends HtmlTag
{
	/**
	 * Constructeur de la classe / Class constructor
	 * @see parent::__construct()
	 * 
	 * @uses HtmlTagLink::__tagName()
	 * @return HtmlTagLink
	 */
	public function __construct()
	{
		parent::__construct(HtmlTagLink::__tagName());
	}
	/**
	 * Méthode permettant de définir l'attribut 'href' de l'élément HtmlTag
	 * Method to set rel attribute value
	 *
	 * @uses HtmlTag::addAttribute()
	 * @param string la valeur de rel
	 * @return bool true|false
	 */
	public function setRel($_ref)
	{
		return $this->addAttribute('rel',trim($_ref),true);
	}
	/**
	 * Méthode permettant de récupérer l'attribut 'href' de l'élément HtmlTag
	 * Method to get rel attribute value
	 *
	 * @uses HtmlTag::getAttribute()
	 * @return string|null
	 */
	public function getRel()
	{
		return $this->getAttribute('rel');
	}
	/**
	 * Méthode permettant de supprimer l'attribut 'rel' de l'élément HtmlTag
	 * Method to unset rel attribute value
	 *
	 * @uses HtmlTag::removeAttribute()
	 * @return bool true|false
	 */
	public function unsetRel()
	{
		return $this->removeAttribute('rel');
	}
	/**
	 * Méthode permettant de définir l'attribut 'href' de l'élément HtmlTag
	 * Method to set href attribute value
	 *
	 * @uses HtmlTag::setValue()
	 * @param string la valeur de href
	 * @return bool true|false
	 */
	public function setHref($_href)
	{
		return $this->setValue(trim($_href));
	}
	/**
	 * Méthode permettant de récupérer l'attribut 'href' de l'élément HtmlTag
	 * Method to get href attribute value
	 *
	 * @uses HtmlTag::getAttribute()
	 * @return bool true|false
	 */
	public function getHref()
	{
		return $this->getAttribute('href');
	}
	/**
	 * Méthode permettant de supprimer l'attribut 'href' de l'élément HtmlTag
	 * Method to unset href attribute value
	 *
	 * @uses HtmlTag::removeAttribute()
	 * @return bool true|false
	 */
	public function unsetHref()
	{
		return $this->removeAttribute('href');
	}
	/**
	 * Méthode retournant le nom du tag de la classe
	 * Method returning the tag name
	 *
	 * @return string link
	 */
	public static function __tagName()
	{
		return 'link';
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