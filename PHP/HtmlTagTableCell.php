<?php
/**
 * Classe mère pour toute classe permettant de générer des cellules d'une ligne d'un tableau HtmlTag
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 15/12/2009
 */
/**
 * Classe mère pour toute classe permettant de générer des cellules d'une ligne d'un tableau HtmlTag
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 15/12/2009
 */
class HtmlTagTableCell extends HtmlTag
{
	/**
	 * Nom du tag pour une cellule du thead du tableau
	 * @var string
	 */
	const TH = 'th';
	/**
	 * Nom du tag pour une cellule du tbody/tfoot du tableau
	 * @var string
	 */
	const TD = 'td';
	/**
	 * Constructeur de la classe
	 * @see parent::__construct()
	 *
	 * @uses HtmlTagTableCell::__className()
	 * @param string type de la cellule
	 * @return HtmlTagTableCell
	 */
	public function __construct($_cellType = self::TD)
	{
		if(is_string($_cellType) && defined(HtmlTagTableCell::__className() . '::' . strtoupper($_cellType)))
			parent::__construct($_cellType);
	}
	/**
	 * Méthode permettant de définir l'attribut 'colspan' de l'élément HtmlTag
	 *
	 * @uses HtmlTagTableCell::addAttribute()
	 * @param string la valeur de colspan
	 * @return bool true|false
	 */
	public function setColspan($_colspan)
	{
		return $this->addAttribute('colspan',$_colspan,true);
	}
	/**
	 * Méthode permettant de récupérer l'attribut 'colspan' de l'élément HtmlTag
	 *
	 * @uses HtmlTag::getAttribute()
	 * @return string|null
	 */
	public function getColspan()
	{
		return $this->getAttribute('colspan');
	}
	/**
	 * Méthode permettant de supprimer l'attribut 'colspan' de l'élément HtmlTag
	 *
	 * @uses HtmlTag::unsetAttribute()
	 * @return string|null
	 */
	public function unsetColspan()
	{
		return $this->unsetAttribute('colspan');
	}
	/**
	 * Méthode permettant de définir l'attribut 'rowspan' de l'élément HtmlTag
	 *
	 * @uses HtmlTagTableCell::addAttribute()
	 * @param string la valeur de rowspan
	 * @return bool true|false
	 */
	public function setRowspan($_rowspan)
	{
		return $this->addAttribute('rowspan',$_rowspan,true);
	}
	/**
	 * Méthode permettant de récupérer l'attribut 'rowspan' de l'élément HtmlTag
	 *
	 * @uses HtmlTag::getAttribute()
	 * @return string|null
	 */
	public function getRowspan()
	{
		return $this->getAttribute('rowspan');
	}
	/**
	 * Méthode permettant de supprimer l'attribut 'rowspan' de l'élément HtmlTag
	 *
	 * @uses HtmlTag::unsetAttribute()
	 * @return string|null
	 */
	public function unsetRowspan()
	{
		return $this->unsetAttribute('rowspan');
	}
	/**
	 * Gestion des particuliers d'attributs
	 * @see HtmlTag::addAttribute()
	 *
	 * @param string nom de l'attribut
	 * @param scalar valeur de l'attribut
	 * @param bool appel depuis une méthode de HtmlTag pour définir un attribut spécifique
	 * @return bool true|false
	 */
	public function addAttribute($_attributeName,$_attributeValue,$_specificAttributeMethodCall = false)
	{
		switch($_attributeName)
		{
			case 'colspan':
			case 'rowspan':
				return parent::addAttribute($_attributeName,intval($_attributeValue),$_specificAttributeMethodCall);
				break;
			default:
				return parent::addAttribute($_attributeName,$_attributeValue,$_specificAttributeMethodCall);
				break;
		}
	}
	/**
	 * Méthode retournant le nom du tag de la classe
	 *
	 * @uses HtmlTagTableCell::TH
	 * @uses HtmlTagTableCell::TD
	 * @return string HtmlTagTableCell::TH . '|' . HtmlTagTableCell::TD
	 */
	public static function __tagName()
	{
		return HtmlTagTableCell::TH . '|' . HtmlTagTableCell::TD;
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