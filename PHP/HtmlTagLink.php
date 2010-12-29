<?php
/**
 * Classe mère pour toute classe permettant de générer des champs de type link
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 28/06/2010
 */
/**
 * Classe mère pour toute classe permettant de générer des champs de type link
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
	 * Constructeur de la classe
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
	 *
	 * @return string link
	 */
	public static function __tagName()
	{
		return 'link';
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