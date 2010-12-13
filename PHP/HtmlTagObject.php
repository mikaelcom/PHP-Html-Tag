<?php
/**
 * Classe mère pour toute classe permettant de générer des champs de type object
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 07/07/2010
 */
/**
 * Classe mère pour toute classe permettant de générer des champs de type object
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 07/07/2010
 */
class HtmlTagObject extends HtmlTag
{
	/**
	 * Constructeur de la classe
	 * @see parent::__construct()
	 * 
	 * @uses HtmlTagObject::__tagName()
	 * @return HtmlTagObject
	 */
	public function __construct()
	{
		parent::__construct(HtmlTagObject::__tagName());
	}
	/**
	 * Méthode permettant de définir une valeur d'un paramètre
	 * 
	 * @uses HtmlTagObject::setValue()
	 * @uses HtmlTagParam::defineParamValue()
	 * @uses HtmlTag::addValue()
	 * @param string nom du paramètre
	 * @param scalar valeur du paramètre
	 * @return bool true|false
	 */
	public function addParam($_paramName,$_paramValue)
	{
		if(is_string($_paramName) && is_scalar($_paramValue))
		{
			$param = new HtmlTagParam();
			return $param->defineParamValue($_paramName,$_paramValue)?$this->setValue($param):false;
		}
		else
			return false;
	}
	/**
	 * On s'assure que les éléments passés à l'objet soient bien du type param
	 * @see parent::setValue()
	 * 
	 * @param HtmlTagParam
	 * @return bool true|false
	 */
	public function setValue(HtmlTagParam $_param)
	{
		return parent::setValue($_param);
	}
	/**
	 * Méthode retournant le nom du tag de la classe
	 *
	 * @return string object
	 */
	public static function __tagName()
	{
		return 'object';
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