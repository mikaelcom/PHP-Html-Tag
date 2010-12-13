<?php
/**
 * Classe mère pour toute classe permettant de générer des options d'un select HtmlTag
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 16/12/2009
 */
/**
 * Classe mère pour toute classe permettant de générer des options d'un select HtmlTag
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 16/12/2009
 */
class HtmlTagOption extends HtmlTag
{
	/**
	 * Constructeur de la classe
	 * @see parent::__construct()
	 * 
	 * @uses HtmlTagOption::__tagName()
	 * @uses HtmlTag::setValue()
	 * @return HtmlTagOption
	 */
	public function __construct()
	{
		parent::__construct(HtmlTagOption::__tagName());
	}
	/**
	 * Méthode permettant de définir la valeur de l'attribut value de l'option
	 * 
	 * @uses HtmlTag::addAttribute()
	 * @param scalar la valeur
	 * @return bool true|false
	 */
	public function setValAttr($_value)
	{
		return $this->addAttribute('value',$_value,true);
	}
	/**
	 * Méthode permettant d'indiquer que l'option est séléctionnée
	 *
	 * @uses HtmlTag::addAttribute
	 * @uses HtmlTagOption::unsetSelected
	 * @param bool selected
	 * @return bool true|false
	 */
	public function setSelected($_selected = true)
	{
		return $_selected?$this->addAttribute('selected','selected',true):$this->unsetSelected();
	}
	/**
	 * Méthode permettant de d'indiquer que l'option n'est plus sélectionnée
	 * 
	 * @uses Htmltag::removeAttribute()
	 * @return bool true|false
	 */
	public function unsetSelected()
	{
		return $this->unsetAttribute('selected');
	}
	/**
	 * Méthode retournant le nom du tag de la classe
	 *
	 * @return string option
	 */
	public static function __tagName()
	{
		return 'option';
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