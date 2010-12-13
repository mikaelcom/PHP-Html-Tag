<?php
/**
 * Classe mère pour toute classe permettant de générer des champs de type img
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 28/06/2010
 */
/**
 * Classe mère pour toute classe permettant de générer des champs de type img
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 28/06/2010
 */
class HtmlTagImg extends HtmlTag
{
	/**
	 * Constructeur de la classe
	 * @see parent::__construct()
	 *
	 * @uses HtmlTagImg::__tagName()
	 * @return HtmlTagImg
	 */
	public function __construct()
	{
		parent::__construct(HtmlTagImg::__tagName());
	}
	/**
	 * Méthode permettant de définir l'attribut 'alt' de l'élément HtmlTag
	 *
	 * @uses HtmlTagImg::addAttribute()
	 * @param string la valeur de alt
	 * @return bool true|false
	 */
	public function setAlt($_alt)
	{
		return $this->addAttribute('alt',$_alt,true);
	}
	/**
	 * Méthode permettant de récupérer l'attribut 'alt' de l'élément HtmlTag
	 *
	 * @uses HtmlTag::getAttribute()
	 * @return string|null
	 */
	public function getAlt()
	{
		return $this->getAttribute('alt');
	}
	/**
	 * Méthode permettant de supprimer l'attribut 'alt' de l'élément HtmlTag
	 *
	 * @uses HtmlTag::unsetAttribute()
	 * @return string|null
	 */
	public function unsetAlt()
	{
		return $this->unsetAttribute('alt');
	}
	/**
	 * Méthode permettant de définir l'attribut 'src' de l'élément HtmlTag
	 *
	 * @uses HtmlTagImg::addAttribute()
	 * @param string la valeur de src
	 * @return bool true|false
	 */
	public function setSrc($_src)
	{
		return $this->addAttribute('src',$_src,true);
	}
	/**
	 * Méthode permettant de récupérer l'attribut 'src' de l'élément HtmlTag
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
	 *
	 * @uses HtmlTag::unsetAttribute()
	 * @return string|null
	 */
	public function unsetSrc()
	{
		return $this->unsetAttribute('src');
	}
	/**
	 * Méthode permettant de définir l'attribut 'width' de l'élément HtmlTag
	 *
	 * @uses HtmlTagImg::addAttribute()
	 * @param string la valeur de width
	 * @return bool true|false
	 */
	public function setWidth($_width)
	{
		return $this->addAttribute('width',$_width,true);
	}
	/**
	 * Méthode permettant de récupérer l'attribut 'width' de l'élément HtmlTag
	 *
	 * @uses HtmlTagImg::getAttribute()
	 * @return string|null
	 */
	public function getWidth()
	{
		return $this->getAttribute('width');
	}
	/**
	 * Méthode permettant de supprimer l'attribut 'width' de l'élément HtmlTag
	 *
	 * @uses HtmlTag::unsetAttribute()
	 * @return string|null
	 */
	public function unsetWidth()
	{
		return $this->unsetAttribute('width');
	}
	/**
	 * Méthode permettant de définir l'attribut 'height' de l'élément HtmlTag
	 *
	 * @uses HtmlTagImg::addAttribute()
	 * @param string la valeur de height
	 * @return bool true|false
	 */
	public function setHeight($_height)
	{
		return $this->addAttribute('height',$_height,true);
	}
	/**
	 * Méthode permettant de récupérer l'attribut 'height' de l'élément HtmlTag
	 *
	 * @uses HtmlTag::getAttribute()
	 * @return string|null
	 */
	public function getHeight()
	{
		return $this->getAttribute('height');
	}
	/**
	 * Méthode permettant de supprimer l'attribut 'height' de l'élément HtmlTag
	 *
	 * @uses HtmlTag::unsetAttribute()
	 * @return string|null
	 */
	public function unsetHeight()
	{
		return $this->unsetAttribute('height');
	}
	/**
	 * Gestion des particuliers d'attributs
	 * @see HtmlTag::addAttribute()
	 *
	 * @param string nom de l'attribut
	 * @param scalar valeur de l'attribut
	 * @param bool appel depuis une méthode de HtmlTag pour définir un attribut spécifique
	 * @return bool true|false
	 */
	public function addAttribute($_attributeName,$_attributeValue,$_specificAttributeMethodCall = false)
	{
		switch($_attributeName)
		{
			case 'height':
			case 'width':
				return parent::addAttribute($_attributeName,intval($_attributeValue),$_specificAttributeMethodCall);
				break;
			default:
				return parent::addAttribute($_attributeName,$_attributeValue,$_specificAttributeMethodCall);
				break;
		}
	}
	/**
	 * Méthode retournant le nom du tag de la classe
	 *
	 * @return string img
	 */
	public static function __tagName()
	{
		return 'img';
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