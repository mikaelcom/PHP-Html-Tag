<?php
/**
 * Classe mère pour toute classe permettant de générer des options d'un select HtmlTag
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 16/12/2009
 */
/**
 * Classe mère pour toute classe permettant de générer des options d'un select HtmlTag
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 16/12/2009
 */
class HtmlTagOption extends HtmlTag
{
	/**
	 * Constructeur de la classe
	 * @see parent::__construct()
	 * 
	 * @uses HtmlTagOption::__tagName()
	 * @uses HtmlTag::setValue()
	 * @return HtmlTagOption
	 */
	public function __construct()
	{
		parent::__construct(HtmlTagOption::__tagName());
	}
	/**
	 * Méthode permettant d'indiquer que l'option est séléctionnée
	 *
	 * @uses HtmlTag::addAttribute
	 * @uses HtmlTagOption::unsetSelected
	 * @param bool selected
	 * @return bool true|false
	 */
	public function setSelected($_selected = true)
	{
		return $_selected?$this->addAttribute('selected','selected',true):$this->unsetSelected();
	}
	/**
	 * Méthode permettant de d'indiquer que l'option n'est plus sélectionnée
	 * 
	 * @uses Htmltag::removeAttribute()
	 * @return bool true|false
	 */
	public function unsetSelected()
	{
		return $this->unsetAttribute('selected');
	}
	/**
	 * Surcharge de la méthode afin de forcer al définition dl'attribut value et non pas la valeur innerHTML
	 * si c'est l'attribut value qui est passé en paramètre
	 * @see HtmlTag::addAttribute()
	 * 
	 * @param string valeur de l'attribut HtmlTag
	 * @param mixed|HtmlTag valeur de l'élément HtmlTag
	 * @param bool appel depuis une méthode de HtmlTag pour définir un attribut spécifique
	 * @return bool true|false selon la validité de l'attribut
	 */
	public function addAttribute($_attributeName,$_attributeValue,$_specificAttributeMethodCall = false)
	{
		return parent::addAttribute($_attributeName,$_attributeValue,$_specificAttributeMethodCall || ($_attributeName == 'value'));
	}
	/**
	 * Surcharge de la méthode afin de forcer al définition dl'attribut value et non pas la valeur innerHTML
	 * si c'est l'attribut value qui est passé en paramètre
	 * @see HtmlTag::addAttributes()
	 *
	 * @uses HtmlTag::addAttribute()
	 * @param array les attributs de l'élément HTML
	 * @return bool true|false selon la validité de l'attribut
	 */
	public function addAttributes(array $_attributes)
	{
		$return = true;
		if(count($_attributes) > 0)
		{
			while(list($attrName,$attrValue) = each($_attributes))
			{
				if(is_scalar($attrName))
				{
					$setAttr = 'set' . ucfirst($attrName);
					/**
					 * Méthode set{Attribute} définie ? => on l'utilise si la valeur est bien une chaine de caractères,
					 * sinon on passe par la méthode générique addAttribute()
					 */
					if(method_exists($this,$setAttr) && $setAttr != 'setValue')
						$return &= $this->$setAttr($attrValue)?true:false;
					/**
					 * Sinon méthode générique d'ajout d'attribut à l'élément
					 */
					else
						$return &= $this->addAttribute($attrName,$attrValue)?true:false;
				}
				else
					$return &= false;
			}
		}
		return $return;
	}
	/**
	 * Méthode retournant le nom du tag de la classe
	 *
	 * @return string option
	 */
	public static function __tagName()
	{
		return 'option';
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