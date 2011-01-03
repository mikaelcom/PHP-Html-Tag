<?php
/**
 * Classe mère permettant de générer un élément HTML de type param
 * Root class to generate a param element
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 07/07/2010
 */
/**
 * Classe mère permettant de générer un élément HTML de type param
 * Root class to generate a param element
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
	 * Constructeur de la classe / Class constructor
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
	 * Method to define a couple information for the current object
	 * 
	 * @uses HtmlTag::setName()
	 * @uses HtmlTag::setValue()
	 * @param string nom du paramètre / parameter name
	 * @param scalar valeur du paramètre / parameter value
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
	 * Method returning the tag name
	 *
	 * @return string param
	 */
	public static function __tagName()
	{
		return 'param';
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