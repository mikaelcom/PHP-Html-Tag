<?php
/**
 * Classe mère permettant de générer un élément HTML de type map
 * Root class to generate a map element
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 07/07/2010
 */
/**
 * Classe mère permettant de générer un élément HTML de type map
 * Root class to generate a map element
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 07/07/2010
 */
class HtmlTagMap extends HtmlTag
{
	/**
	 * Constructeur de la classe / Class constructor
	 * @see parent::__construct()
	 * 
	 * @uses HtmlTagMap::__tagName()
	 * @return HtmlTagMap
	 */
	public function __construct()
	{
		parent::__construct(HtmlTagMap::__tagName());
	}
	/**
	 * Méthode permettant de définir un élément area de la map par ses attributs
	 * Method to create HtmlTagArea item
	 * 
	 * @uses HtmlTag::addAttributes()
	 * @uses HtmlTagMap::setValue()
	 * @param array les attributs de l'élément map à ajouter à la map / Attributes for the HtmlTagArea item
	 * @return bool true|false
	 */
	public function addArea(array $_attributes)
	{
		$area = new HtmlTagArea();
		return $area->addAttributes($_attributes)?$this->setValue($area):false;
	}
	/**
	 * On s'assure que les éléments passés à la map soient bien du type area
	 * Override method to secure the elements added to the current element
	 * @see parent::setValue()
	 * 
	 * @param HtmlTagArea
	 * @return bool true|false
	 */
	public function setValue(HtmlTagArea $_area)
	{
		return parent::setValue($_area);
	}
	/**
	 * Méthode retournant le nom du tag de la classe
	 * Method returning the tag name
	 *
	 * @return string map
	 */
	public static function __tagName()
	{
		return 'map';
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