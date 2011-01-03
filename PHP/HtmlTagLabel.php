<?php
/**
 * Classe mère permettant de générer un élément HTML de type label
 * Root class to generate a label element
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 06/07/2010
 */
/**
 * Classe mère permettant de générer un élément HTML de type label
 * Root class to generate a label element
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 06/07/2010
 */
class HtmlTagLabel extends HtmlTag
{
	/**
	 * Constructeur de la classe / Class constructor
	 * @see parent::__construct()
	 * 
	 * @uses HtmlTagLabel::__tagName()
	 * @return HtmlTagLabel
	 */
	public function __construct()
	{
		parent::__construct(HtmlTagLabel::__tagName());
	}
	/**
	 * Méthode permettant de définir la valeur de l'attribut for
	 * Method to set for attribute value
	 * 
	 * @uses HtmlTag::addAttribute()
	 * @param string
	 * @return bool true|false
	 */
	public function setFor($_for)
	{
		return is_string($_for)?$this->addAttribute('for',$_for,true):false;
	}
	/**
	 * Méthode permettant de récupérer l'attribut 'for' de l'élément HtmlTag
	 * Method to get for attribute value
	 *
	 * @uses HtmlTag::getAttribute()
	 * @return string|null
	 */
	public function getFor()
	{
		return $this->getAttribute('for');
	}
	/**
	 * Méthode permettant de supprimer l'attribut for
	 * Method to unsset for attribute value
	 * 
	 * @uses HtmlTag::removeAttribute()
	 * @return bool true|false
	 */
	public function unsetFor()
	{
		return $this->removeAttribute('for');
	}
	/**
	 * Méthode retournant le nom du tag de la classe
	 * Method returning the tag name
	 *
	 * @return string label
	 */
	public static function __tagName()
	{
		return 'label';
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