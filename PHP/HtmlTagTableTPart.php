<?php
/**
 * Classe mère permettant de générer une partie (thead, tbody, tfoot) d'un tableau HtmlTag
 * Root class to generate a table part element as thead, tbody or tfoot
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 15/12/2009
 */
/**
 * Classe mère permettant de générer une partie (thead, tbody, tfoot) d'un tableau HtmlTag
 * Root class to generate a table part element as thead, tbody or tfoot
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 15/12/2009
 */
class HtmlTagTableTPart extends HtmlTag
{
	/**
	 * Nom du tag pour le thead du tableau
	 * Tag name to the table thead part
	 * @var string
	 */
	const THEAD = 'thead';
	/**
	 * Nom du tag pour le tbody du tableau
	 * Tag name to the table thead part
	 * @var string
	 */
	const TBODY = 'tbody';
	/**
	 * Nom du tag pour le tfoot du tableau
	 * Tag name to the table thead part
	 * @var string
	 */
	const TFOOT = 'tfoot';
	/**
	 * Constructeur de la classe / Class constructor
	 * @see parent::__construct()
	 * 
	 * @return HtmlTagTableTPart
	 */
	public function __construct($_partName)
	{
		if(is_string($_partName) && defined(HtmlTagTableTPart::__className() . '::' . strtoupper($_partName)))
			parent::__construct($_partName);
	}
	/**
	 * Méthode permettant d'ajouter une ligne à la partie HtmlTag du tableau
	 * Method to add a line object
	 *
	 * @uses HtmlTag::addValue()
	 * @param HtmlTagTr
	 */
	public function addLine(HtmlTagTr $_htmlTagTr)
	{
		return $this->addValue($_htmlTagTr);
	}
	/**
	 * Méthode retournant le nom du tag de la classe
	 * Method returning the list of possible tag names
	 *
	 * @uses HtmlTagTableTPart::THEAD
	 * @uses HtmlTagTableTPart::TBODY
	 * @uses HtmlTagTableTPart::TFOOT
	 * @return string HtmlTagTableTPart::THEAD . '|' . HtmlTagTableTPart::TBODY . '|' . HtmlTagTableTPart::TFOOT
	 */
	public static function __tagName()
	{
		return HtmlTagTableTPart::THEAD . '|' . HtmlTagTableTPart::TBODY . '|' . HtmlTagTableTPart::TFOOT;
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