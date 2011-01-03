<?php
/**
 * Classe mère permettant de générer des tableaux HtmlTag
 * Root class to generate a table element
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 15/12/2009
 */
/**
 * Classe mère permettant de générer des tableaux HtmlTag
 * Root class to generate a table element
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 15/12/2009
 */
class HtmlTagTable extends HtmlTag
{
	/**
	 * Constructeur de la classe / Class constructor
	 * @see parent::__construct()
	 * 
	 * @uses HtmlTagTable::__tagName()
	 * @return HtmlTagTable
	 */
	public function __construct()
	{
		parent::__construct(HtmlTagTable::__tagName());
	}
	/**
	 * Méthode pour définir le caption du tableau
	 * Method to set caption element
	 * 
	 * @uses Htmltag::addvalue()
	 * @param HtmlTag
	 */
	public function setCaption(HtmlTagCaption $_caption)
	{
		return $this->addvalue($_caption);
	}
	/**
	 * Méthode pour définir le tbody du tableau
	 * Method to set tbody element
	 * 
	 * @uses Htmltag::addvalue()
	 * @param HtmlTagTableTPart
	 */
	public function setTbody(HtmlTagTbody $_tbody)
	{
		return $this->addvalue($_tbody);
	}
	/**
	 * Méthode pour définir le tfoot du tableau
	 * Method to set tfoot element
	 * 
	 * @uses Htmltag::addvalue()
	 * @param HtmlTagTableTPart
	 */
	public function setTfoot(HtmlTagTfoot $_tfoot)
	{
		return $this->addvalue($_tfoot);
	}
	/**
	 * Méthode pour définir le thead du tableau
	 * Method to set thead element
	 * 
	 * @uses Htmltag::addvalue()
	 * @param HtmlTagTableTPart
	 */
	public function setThead(HtmlTagThead $_thead)
	{
		return $this->addvalue($_thead);
	}
	/**
	 * Méthode retournant le nom du tag de la classe
	 * Method returning the tag name
	 *
	 * @return string table
	 */
	public static function __tagName()
	{
		return 'table';
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