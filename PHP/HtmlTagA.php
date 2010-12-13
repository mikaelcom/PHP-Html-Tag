<?php
/**
 * Classe mère pour toute classe permettant de générer des champs de type a
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 28/06/2010
 */
/**
 * Classe mère pour toute classe permettant de générer des champs de type a
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 28/06/2010
 */
class HtmlTagA extends HtmlTag
{
	/**
	 * Constructeur de la classe
	 * @see parent::__construct()
	 * 
	 * @uses HtmlTagA::__tagName()
	 * @return HtmlTagA
	 */
	public function __construct()
	{
		parent::__construct(HtmlTagA::__tagName());
	}
	/**
	 * Méthode permettant de définir l'attribut 'href' de l'élément HtmlTag
	 *
	 * @uses HtmlTag::addAttribute()
	 * @param string la valeur de href
	 * @return bool true|false
	 */
	public function setHref($_href)
	{
		return $this->addAttribute('href',trim($_href),true);
	}
	/**
	 * Méthode permettant de récupérer l'attribut 'href' de l'élément HtmlTag
	 *
	 * @uses HtmlTag::getAttribute()
	 * @return string|null
	 */
	public function getHref()
	{
		return $this->getAttribute('href');
	}
	/**
	 * Méthode permettant de supprimer l'attribut 'href' de l'élément HtmlTag
	 *
	 * @uses HtmlTag::removeAttribute()
	 * @return bool true|false
	 */
	public function unsetHref()
	{
		return $this->removeAttribute('href');
	}
	/**
	 * L'id et le name doivent avoir la même valeur
	 * 
	 * @param string
	 * @param bool définir l'attribut name
	 * @return bool true|false
	 */
	public function setId($_id,$_defineName = true)
	{
		$setId = parent::setId($_id);
		if($setId && $_defineName)
			$this->setName($this->getId(),false);
		return $setId;
	}
	/**
	 * L'id et le name doivent avoir la même valeur
	 * 
	 * @uses HtmlTagA::setId()
	 * @uses HtmlTag::setName()
	 * @param string
	 * @param bool définir l'attribut id
	 * @return bool true|false
	 */
	public function setName($_name,$_defineId = true)
	{
		$setName = parent::setName($_name);
		if($setName && $_defineId)
			$this->setId($this->getName(),false);
		return $setName;
	}
	/**
	 * Méthode permettant de définir que le lien doit s'ouvrir dans une autre fenêtre
	 * 
	 * @uses HtmlTag::addAttribute()
	 * @uses HtmlTag::getAttribute()
	 * @param string nom de la fenêtre
	 * @return bool true|false
	 */
	public function blank($_windowName = null)
	{
		$onclick = $this->getAttribute('onclick');
		return $this->addAttribute('onclick',$onclick . (substr($onclick,-1) == ';'?'':';') . 'return !window.open(this.href,\'' . (preg_replace('/(\s+)/','_',!empty($_windowName)?$_windowName:uniqid('link_to_window_'))) . '\');');
	}
	/**
	 * Méthode retournant le nom du tag de la classe
	 *
	 * @return string a
	 */
	public static function __tagName()
	{
		return 'a';
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