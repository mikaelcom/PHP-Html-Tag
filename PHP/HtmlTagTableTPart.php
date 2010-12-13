<?php
/**
 * Classe mère pour toute classe permettant de générer une partie (thead, tbody, tfoot) d'un tableau HtmlTag
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 15/12/2009
 */
/**
 * Classe mère pour toute classe permettant de générer une partie (thead, tbody, tfoot) d'un tableau HtmlTag
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
	 * @var string
	 */
	const THEAD = 'thead';
	/**
	 * Nom du tag pour le tbody du tableau
	 * @var string
	 */
	const TBODY = 'tbody';
	/**
	 * Nom du tag pour le tfoot du tableau
	 * @var string
	 */
	const TFOOT = 'tfoot';
	/**
	 * Constructeur de la classe
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
	 *
	 * @return string __CLASS__
	 */
	public static function __className()
	{
		return __CLASS__;
	}
}
?>