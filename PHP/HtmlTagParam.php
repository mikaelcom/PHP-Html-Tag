<?php
/**
 * Classe mère pour toute classe permettant de générer des champs de type param
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 07/07/2010
 */
/**
 * Classe mère pour toute classe permettant de générer des champs de type param
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 07/07/2010
 */
class HtmlTagParam extends HtmlTag
{
	/**
	 * Constructeur de la classe
	 * @see parent::__construct()
	 * 
	 * @uses HtmlTagParam::__tagName()
	 * @return HtmlTagParam
	 */
	public function __construct()
	{
		parent::__construct(HtmlTagParam::__tagName());
	}
	/**
	 * Méthode permettant de définir l'élément param (name/value)
	 * 
	 * @uses HtmlTag::setName()
	 * @uses HtmlTag::setValue()
	 * @param string nom du paramètre
	 * @param scalar valeur du paramètre
	 * @return bool true|false
	 */
	public function defineParamValue($_paramName,$_paramValue)
	{
		$add = true;
		$add .= $this->setName($_paramName)?true:false;
		$add .= $this->setValue($_paramValue)?true:false;
		return $add;
	}
	/**
	 * Méthode retournant le nom du tag de la classe
	 *
	 * @return string param
	 */
	public static function __tagName()
	{
		return 'param';
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