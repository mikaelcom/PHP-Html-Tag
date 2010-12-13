<?php
/**
 * Classe mère pour toute classe permettant de générer des champs de type optgroup
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 06/07/2010
 */
/**
 * Classe mère pour toute classe permettant de générer des champs de type optgroup
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 06/07/2010
 */
class HtmlTagOptgroup extends HtmlTag
{
	/**
	 * Constructeur de la classe
	 * @see parent::__construct()
	 * 
	 * @uses HtmlTagOptgroup::__tagName()
	 * @return HtmlTagOptgroup
	 */
	public function __construct()
	{
		parent::__construct(HtmlTagOptgroup::__tagName());
	}
	/**
	 * Méthode permettant de définir l'attribut 'label' de l'élément HtmlTag
	 *
	 * @uses HtmlTag::addAttribute()
	 * @param string la valeur de label
	 * @return bool true|false
	 */
	public function setLabel($_label)
	{
		return $this->addAttribute('label',$_label,true);
	}
	/**
	 * Méthode permettant de récupérer l'attribut 'label' de l'élément HtmlTag
	 *
	 * @uses HtmlTag::getAttribute()
	 * @return string|null
	 */
	public function getLabel()
	{
		return $this->getAttribute('label');
	}
	/**
	 * Méthode permettant de supprimer l'attribut 'label' de l'élément HtmlTag
	 *
	 * @uses HtmlTag::removeAttribute()
	 * @return bool true|false
	 */
	public function unsetLabel()
	{
		return $this->removeAttribute('label');
	}
	/**
	 * On s'assure que les éléments passés à l'optgroup soient bien du type option
	 * @see parent::setValue()
	 * 
	 * @param HtmlTagOption
	 * @return bool true|false
	 */
	public function setValue(HtmlTagOption $_option)
	{
		return parent::setValue($_option);
	}
	/**
	 * Méthode retournant le nom du tag de la classe
	 *
	 * @return string optgroup
	 */
	public static function __tagName()
	{
		return 'optgroup';
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