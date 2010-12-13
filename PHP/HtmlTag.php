<?php
/**
 * Classe mère pour toute classe permettant de générer des éléments HtmlTag
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 13/12/2009
 */
/**
 * Classe mère pour toute classe permettant de générer des éléments HtmlTag
 * @link http://tmldog.com/reference/
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 13/12/2009
 */
class HtmlTag
{
	/**
	 * Défini le nom de la balise utilisé pour déifnir le contenu du doctype
	 * @var string
	 */
	const DOCTYPE_ROOT_TAG = 'html';
	/**
	 * Défini la norme respectée
	 * @var string
	 */
	const DOCTYPE_DEFINITION = '-//W3C//DTD XHTML 1.0 Strict//EN';
	/**
	 * Défini l'url de la DTD
	 * @var string
	 */
	const DOCTYPE_URL = 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd';
	/**
	 * Encodage par défaut
	 * @var string
	 */
	const DEFAULT_ENCODING = 'iso-8859-1';
	/**
	 * Valeur du class à définir pour le premier élément d'une liste
	 * @var string
	 */
	const CLASS_FIRST = 'first';
	/**
	 * Valeur du class à définir pour le dernier élément d'une liste
	 * @var string
	 */
	const CLASS_LAST = 'last';
	/**
	 * Indique si la valeur de l'élément HtmlTag est de type innerHtmlTag ou définie par l'attribut value
	 * @var bool
	 */
	private $hasInnerHtml;
	/**
	 * Objet de la clase DOMElement
	 * @var DOMElement
	 */
	private $domElement;
	/**
	 * Objet de la clase DOMDocument
	 * @var DOMDocument
	 */
	public static $domDocument;
	/**
	 * Objet de la clase Htmltag
	 * @var Htmltag
	 */
	public static $htmlDocument;
	/**
	 * Objet de la clase Htmltag représentant le body
	 * @var Htmltag
	 */
	public static $htmlBody;
	/**
	 * Objet de la clase Htmltag représentant le head
	 * @var Htmltag
	 */
	public static $htmlHead;
	/**
	 * Tabelau des id d'éléments déjà déclarés afin d'éviter tout doublons d'id
	 * ce qui rend la page invalide et pertube l'accès à l'élément par son id en JS
	 * @var array
	 */
	private static $declaredIds = array();
	/**
	 * Tabelau des tag html valides
	 * @var array
	 */
	private static $validTagsName = array('a'=>'','abbr'=>'','acronym'=>'','address'=>'','area'=>'','b'=>'','base'=>'','bdo'=>'','big'=>'','blockquote'=>'','body'=>'','br'=>'','button'=>'','caption'=>'','cite'=>'','code'=>'','col'=>'','colgroup'=>'','dd'=>'','del'=>'','dfn'=>'','div'=>'','dl'=>'','DOCTYPE'=>'','dt'=>'','em'=>'','fieldset'=>'','font'=>'','form'=>'','h1'=>'','h2'=>'','h3'=>'','h4'=>'','h5'=>'','h6'=>'','head'=>'','html'=>'','hr'=>'','i'=>'','img'=>'','input'=>'','ins'=>'','kbd'=>'','label'=>'','legend'=>'','li'=>'','link'=>'','list'=>'','map'=>'','meta'=>'','noscript'=>'','object'=>'','ol'=>'','optgroup'=>'','option'=>'','p'=>'','param'=>'','pre'=>'','q'=>'','samp'=>'','script'=>'','select'=>'','small'=>'','span'=>'','strong'=>'','style'=>'','sub'=>'','sup'=>'','table'=>'','tbody'=>'','td'=>'','textarea'=>'','tfoot'=>'','th'=>'','thead'=>'','title'=>'','tr'=>'','tt'=>'','ul'=>'','var'=>'');
	/**
	 * Tabelau des attributs html valides
	 * @var array
	 */
	private static $validAttributesName = array('abbr'=>'','about'=>'','accesskey'=>'','action'=>'','archive'=>'','alt'=>'','autocomplete'=>'','axis'=>'','charset'=>'','checked'=>'','cite'=>'','class'=>'','cols'=>'','colspan'=>'','content-length'=>'','content'=>'','coords'=>'','datatype'=>'','datetime'=>'','declare'=>'','defaultAction'=>'','dir'=>'','disabled'=>'','edit'=>'','enctype'=>'','encoding'=>'','event'=>'','for'=>'','full'=>'','handler'=>'','headers'=>'','height'=>'','href'=>'','hreflang'=>'','hrefmedia'=>'','hreftype'=>'','http-equiv'=>'','id'=>'','ismap'=>'','key'=>'','label'=>'','layout'=>'','lang'=>'','media'=>'','method'=>'','name'=>'','nextfocus'=>'','observer'=>'','onblur'=>'','onchange'=>'','onclick'=>'','onfocus'=>'','onkeypress'=>'','onkeyup'=>'','onkeydown'=>'','onmousedown'=>'','onmousemove'=>'','onmouseover'=>'','onmouseout'=>'','onmouseup'=>'','onsubmit'=>'','phase'=>'','prevfocus'=>'','propagate'=>'','property'=>'','rel'=>'','repeat-bind'=>'','repeat-model'=>'','repeat-nodeset'=>'','repeat-number'=>'','repeat-startindex'=>'','rev'=>'','readonly'=>'','role'=>'','rows'=>'','rowspan'=>'','scope'=>'','selected'=>'','shape'=>'','span'=>'','src'=>'','srctype'=>'','style'=>'','tabindex'=>'','target'=>'','targetid'=>'','targetrole'=>'','title'=>'','type'=>'','usemap'=>'','value'=>'','valuetype'=>'','version'=>'','width'=>'','xmlns'=>'','xml:base'=>'','xml:id'=>'','xml:lang'=>'','xsi:schemaLocation'=>'');
	/**
	 * Constructeur de la classe
	 *
	 * @uses HtmlTag::tagIsValid()
	 * @uses HtmlTag::setTagName()
	 * @uses HtmlTag::setId()
	 * @uses HtmlTag::addAttribute()
	 * @uses DOMImplementation::createDocumentType()
	 * @uses DOMImplementation::createDocument()
	 * @uses HtmlTag::DEFAULT_ENCODING
	 * @uses HtmlTag::DOCTYPE_DEFINITION
	 * @uses HtmlTag::DOCTYPE_ROOT_TAG
	 * @uses HtmlTag::DOCTYPE_URL
	 * @param string nom du tag HtmlTag de l'élément
	 * @param string lang du document
	 * @param string encodage du document
	 * @param string reset du domDocument
	 * @return HtmlTag
	 */
	public function __construct($_tagName, $_lang = null, $_encoding = HtmlTag::DEFAULT_ENCODING, $_reset = false)
	{
		/**
		 * Initialisation dans tous les cas du DOMDocument
		 */
		if(!HtmlTag::$domDocument || $_reset)
		{
			/**
			 * Création du document général
			 */
			$doctype = DOMImplementation::createDocumentType(HtmlTag::DOCTYPE_ROOT_TAG,HtmlTag::DOCTYPE_DEFINITION,HtmlTag::DOCTYPE_URL);
			HtmlTag::$domDocument = DOMImplementation::createDocument(null,null,$doctype);
			HtmlTag::$domDocument->preserveWhiteSpace = false;
			HtmlTag::$domDocument->formatOutput = true;
			HtmlTag::$domDocument->substituteEntities = true;
			HtmlTag::$domDocument->resolveExternals = true;
			HtmlTag::$domDocument->validateOnParse = true;
			HtmlTag::$domDocument->encoding = $_encoding;
			/**
			 * Création de la zone HTML
			 */
			HtmlTag::$htmlDocument = new HtmlTag('html');
			HtmlTag::$htmlDocument->addAttribute('xml:lang',!empty($_lang)?trim($_lang):'fr',true);
		}
		/**
		 * Si le tag est valide
		 */
		if(is_string($_tagName) && HtmlTag::tagIsValid($_tagName))
		{
			/**
			 * Définition du tag
			 */
			$this->setTagName(strtolower($_tagName));
			/**
			 * Définition de l'attribut id
			 */
			if(defined('HTML_TAG_DEFINE_ID') && HTML_TAG_DEFINE_ID === true)
				$this->setId('tag_' . $_tagName);
		}
	}
	/**
	 * Méthode permettant de charger un document à la place du DOMDocument par défaut.
	 * Cela a pour effet de supprimer tout ce qui aurait pu être créé jusque là !
	 * 
	 * @uses HtmlTag::setHead()
	 * @uses HtmlTag::setBody()
	 * @uses HtmlTag::getHtmlTagFromDOMElement()
	 * @uses DOMDocument::loadXML()
	 * @uses DOMDocument::getElementsByTagName()
	 * @uses DOMNodeList::item()
	 * @uses DOMNode::hasAttributes()
	 * @uses DOMNamedNodeMap::item()
	 * @param string contenu du document
	 * @return bool true|false
	 */
	public static function loadDomDocument($_fileContent, $_resetDomDocument = false)
	{
		if(trim($_fileContent) != '')
		{
			$fileContent = str_replace(array('&','&amp;amp;'),'&amp;',trim($_fileContent));
			if(strpos($fileContent,'<?xml') !== 0 && strpos($fileContent,'<?xml') <= 0)
				$fileContent = '<?xml version="1.0" encoding="ISO-8859-1"?>' . "\r\n" . $fileContent;
			if(!empty($fileContent))
			{
				$domDocument = new DOMDocument('1.0','ISO-8859-1');
				if($domDocument->loadXML($fileContent))
				{
					if($_resetDomDocument)
					{
						HtmlTag::$domDocument = null;
						HtmlTag::$htmlDocument = null;
						HtmlTag::$declaredIds = array();
					}
					/**
					 * Tentative de récupération de la partie head
					 */
					if($domDocument->getElementsByTagName('head') && ($head = HtmlTag::getHtmlTagFromDOMElement($domDocument->getElementsByTagName('head')->item(0),true)))
						HtmlTag::setHead($head);
					/**
					 * Tentative de récupération de la partie body
					 */
					if($domDocument->getElementsByTagName('body') && ($body = HtmlTag::getHtmlTagFromDOMElement($domDocument->getElementsByTagName('body')->item(0),true)))
						HtmlTag::setBody($body);
					return true;
				}
				else
					return false;
			}
			else
				return false;
		}
		else
			return false;
	}
	/**
	 * Méthode permettant de charger un document complet depuis un fichier
	 * 
	 * @uses HtmlTag::loadDomDocument()
	 * @param string chemin complet d'accès au fichier
	 * @return bool true|false
	 */
	public static function loadDomDocumentFile($_fileName)
	{
		return is_file($_fileName)?HtmlTag::loadDomDocument(file_get_contents($_fileName)):false;
	}
	/**
	 * Méthode permettant de facilement créer une élément de type script/jaavscript
	 *
	 * @uses HtmlTagScript::setSrc()
	 * @uses HtmlTagScript::setCharset()
	 * @uses HtmlTag::setValue()
	 * @uses HtmlTag::addAttributes()
	 * @uses HtmlTag::addValue()
	 * @param string l'url du fichier javascript à charger
	 * @param array les attribut de l'élément
	 * @param HtmlTag l'élément auquel ajouté la balise script si nécessaire
	 * @param string contenu de la balise script si nécessaire
	 * @param string le charset du contenu/script
	 * @return HtmlTag la balise script
	 */
	public static function createScript($_src = '', $_attributes = null, $_addtoHtml = null, $_content = '', $_charset = '')
	{
		$s = new HtmlTagScript();
		if(!empty($_src))
			$s->setSrc($_src);
		if(!empty($_content))
			$s->setValue($_content);
		if(!empty($_charset))
			$s->setCharset($_charset);
		if(is_array($_attributes))
			$s->addAttributes($_attributes);
		if($_addtoHtml instanceof HtmlTag)
			$_addtoHtml->addValue($s);
		return $s;
	}
	/**
	 * Méthode permettant de facilement créer une élément de type text/css
	 *
	 * @uses HtmlTagLink::setHref()
	 * @uses HtmlTagLink::setRel()
	 * @uses HtmlTag::setType()
	 * @uses HtmlTag::addAttributes()
	 * @uses HtmlTag::addValue()
	 * @param string l'url du fichier css à charger
	 * @param array les attribut de l'élément
	 * @param HtmlTag l'élément auquel ajouté la balise link si nécessaire
	 * @return HtmlTag la balise link
	 */
	public static function createCssLink($_href, $_attributes = null, $_addtoHtml = null)
	{
		$l = new HtmlTagLink();
		$l->setHref($_href);
		$l->setRel('stylesheet');
		$l->setType('text/css');
		if(is_array($_attributes))
			$l->addAttributes($_attributes);
		if($_addtoHtml instanceof HtmlTagHead)
			$_addtoHtml->addValue($l);
		return $l;
	}
	/**
	 * Méthode permettant de facilement créer une élément de type meta
	 *
	 * @uses HtmlTagMeta::define()
	 * @uses HtmlTag::addAttributes()
	 * @uses HtmlTag::addValue()
	 * @param string nom identifiant le type de la meta
	 * @param string valeur du type de la meta
	 * @param string valeur de la meta
	 * @param array les attribut de l'élément
	 * @param HtmlTag l'élément auquel ajouté la balise link si nécessaire
	 * @return HtmlTag la balise meta
	 */
	public static function createMeta($_type, $_typeName, $_value, $_attributes = null, $_addtoHtml = null)
	{
		$m = new HtmlTagMeta();
		$m->define($_type,$_typeName,$_value);
		if(is_array($_attributes))
			$m->addAttributes($_attributes);
		if($_addtoHtml instanceof HtmlTagHead)
			$_addtoHtml->addValue($m);
		return $m;
	}
	/**
	 * Méthode permettant de facilement créer une élément de type title
	 *
	 * @uses HtmlTag::setValue()
	 * @uses HtmlTag::addAttributes()
	 * @uses HtmlTag::addValue()
	 * @param string nom identifiant le type de la meta
	 * @param string valeur du type de la meta
	 * @param string valeur de la meta
	 * @param array les attribut de l'élément
	 * @param HtmlTag l'élément auquel ajouté la balise link si nécessaire
	 * @return HtmlTag la balise meta
	 */
	public static function createTitle($_value, $_attributes = null, $_addtoHtml = null)
	{
		$t = new HtmlTagTitle();
		$t->setValue($_value);
		if(is_array($_attributes))
			$t->addAttributes($_attributes);
		if($_addtoHtml instanceof HtmlTagHead)
			$_addtoHtml->addValue($t);
		return $t;
	}
	/**
	 * Méthode permettant de facilement créer une élément de type img
	 *
	 * @uses HtmlTagImg::setSrc()
	 * @uses HtmlTagImg::setAlt()
	 * @uses HtmlTag::setTitle()
	 * @uses HtmlTag::addAttributes()
	 * @uses HtmlTag::addValue()
	 * @param string url de l'image
	 * @param string alt de l'image
	 * @param string title de l'image
	 * @param array les attribut de l'élément
	 * @param HtmlTag l'élément auquel ajouté la balise link si nécessaire
	 * @return HtmlTag la balise meta
	 */
	public static function createImg($_src, $_alt, $_title = '', $_attributes = null, $_addtoHtml = null)
	{
		$i = new HtmlTagImg();
		$i->setSrc($_src);
		$i->setAlt($_alt);
		if(!empty($_title))
			$i->setTitle($_title);
		if(is_array($_attributes))
			$i->addAttributes($_attributes);
		if(($_addtoHtml instanceof HtmlTag) && !($_addtoHtml instanceof HtmlTagHead))
			$_addtoHtml->addValue($i);
		return $i;
	}
	/**
	 * Méthode permettant de facilement créer une élément de type label
	 *
	 * @uses HtmlTagLabel::setFor()
	 * @uses HtmlTag::setValue()
	 * @uses HtmlTag::addAttributes()
	 * @uses HtmlTag::addValue()
	 * @param string url de l'image
	 * @param string titre du label
	 * @param string id de l'élément auquel fait référence le label
	 * @param array les attribut de l'élément
	 * @param HtmlTag l'élément auquel ajouté la balise link si nécessaire
	 * @return HtmlTag la balise label
	 */
	public static function createLabel($_label, $_for = '', $_attributes = null, $_addtoHtml = null)
	{
		$l = new HtmlTagLabel();
		$l->setValue($_label);
		if(!empty($_for))
			$l->setFor($_for);
		if(is_array($_attributes))
			$l->addAttributes($_attributes);
		if(($_addtoHtml instanceof HtmlTag) && !($_addtoHtml instanceof HtmlTagHead))
			$_addtoHtml->addValue($l);
		return $l;
	}
	/**
	 * Méthode permettant de facilement créer une élément de type label
	 *
	 * @uses HtmlTagA::setHref()
	 * @uses HtmlTag::setValue()
	 * @uses HtmlTag::addAttributes()
	 * @uses HtmlTag::addValue()
	 * @param string url
	 * @param string texte du lien
	 * @param string id de l'élément auquel fait référence le label
	 * @param array les attribut de l'élément
	 * @param HtmlTag l'élément auquel ajouté la balise link si nécessaire
	 * @return HtmlTag la balise label
	 */
	public static function createA($_href, $_anchor, $_attributes = null, $_addtoHtml = null)
	{
		$a = new HtmlTagA();
		$a->setValue($_anchor);
		$a->setHref($_href);
		if(is_array($_attributes))
			$a->addAttributes($_attributes);
		if(($_addtoHtml instanceof HtmlTag) && !($_addtoHtml instanceof HtmlTagHead))
			$_addtoHtml->addValue($a);
		return $a;
	}
	/**
	 * Méthode permettant de créer un tag à la volée par son nom si la classe HtmlTag{$_TagName} de ce tag existe
	 *
	 * @uses HtmlTag::__className()
	 * @uses HtmlTag::getTagName()
	 * @uses HtmlTag::addAttributes()
	 * @uses HtmlTag::getDomElement()
	 * @uses HtmlTag::setValue()
	 * @param string nom du tag
	 * @param array attributs du tag
	 * @param string type de l'attribut (input, ul/ol, etc)
	 * @param HtmlTag* élément auquel ajouter le nouvel élément
	 * @return HtmlTag|null
	 */
	public static function &createTag($_tagName, array $_tagAttributes = array(), $_tagType = null, $_addTagTo = null)
	{
		$htmlTagObject = null;
		if(is_string($_tagName) && class_exists(HtmlTag::__className() . ucfirst(strtolower($_tagName))))
		{
			$htmlTagObjectName = HtmlTag::__className() . ucfirst(strtolower($_tagName));
			if(isset($_tagType) && is_scalar($_tagType) && !empty($_tagType))
				$htmlTagObject = new $htmlTagObjectName($_tagType);
			else
				$htmlTagObject = new $htmlTagObjectName();
			if($htmlTagObject->getTagName() == $_tagName)
			{
				if(count($_tagAttributes) > 0)
					$htmlTagObject->addAttributes($_tagAttributes);
				if($htmlTagObject->getDomElement() && ($_addTagTo instanceof HtmlTag))
					$_addTagTo->setValue($htmlTagObject);
			}
			else
				$htmlTagObject = null;
		}
		return $htmlTagObject;
	}
	/**
	 * Méthode permettant de générer le code HtmlTag de l'élément
	 * Génération du code XHTML de l'élément en cours uniquement
	 *
	 * @uses HtmlTag::getDomElement()
	 * @uses DOMDocument::saveXML()
	 * @param bool transmettre le header de type XML ou non
	 * @return string le code HtmlTag
	 */
	public function toHtml($_sendHeader = false)
	{
		if(HtmlTag::$domDocument && $this->getDomElement())
		{
			if($_sendHeader && !headers_sent())
				header('Content-Type: text/html');
			return html_entity_decode(HtmlTag::$domDocument->saveXML($this->getDomElement()),ENT_QUOTES);
		}
		else
			return '';
	}
	/**
	 * Méthode permettant de générer le code HtmlTag de l'élément
	 * Génération du code XML de l'élément en cours uniquement
	 *
	 * @uses HtmlTag::toHtml()
	 * @param bool transmettre le header de type XML ou non
	 * @return string le code HtmlTag
	 */
	public function toXml($_sendHeader = false)
	{
		if(HtmlTag::$domDocument)
		{
			if($_sendHeader && !headers_sent())
				header('Content-Type: application/xhtml+xml');
			return '<?xml version="1.0" encoding="' . HtmlTag::$domDocument->encoding . '"?>' . "\r\n" . str_replace(array('&','&amp;amp;'),'&amp;',$this->toHtml(false));
		}
		else
			return '';
	}
	/**
	 * Méthode d'affichage de la page html compléte
	 *
	 * @uses HtmlTag::addValue()
	 * @uses HtmlTag::getBody()
	 * @uses HtmlTag::getHead()
	 * @uses HtmlTag::getDomElement()
	 * @uses DOMDocument::appendChild()
	 * @uses DOMDocument::saveXML()
	 * @param bool transmettre le header de type XML ou non
	 * @return string
	 */
	public static function displayFullHtml($_sendHeader = false)
	{
		if(HtmlTag::$domDocument && HtmlTag::$htmlDocument->getDomElement())
		{
			$s = microtime(true);
			if($_sendHeader && !headers_sent())
				header('Content-Type: text/html');
			HtmlTag::$htmlDocument->addValue(HtmlTag::getHead());
			HtmlTag::$htmlDocument->addValue(HtmlTag::getBody());
			HtmlTag::$domDocument->appendChild(HtmlTag::$htmlDocument->getDomElement());
			return html_entity_decode(HtmlTag::$domDocument->saveXML(),ENT_QUOTES) . '<!-- HTML Generation Time : ' . round(microtime(true) - $s,5) . ' sec. -->' . "\r\n" . '<!-- Memory Usage : ' . number_format(memory_get_usage(true),0,'.',',') . ' octets -->';
		}
		else
			return '';
	}
	/**
	 * Méthode d'affichage de la page xml compléte
	 *
	 * @uses HtmlTag::displayFullHtml()
	 * @param bool transmettre le header de type XML ou non
	 * @return string
	 */
	public static function displayFullXml($_sendHeader = false)
	{
		if(HtmlTag::$domDocument)
		{
			if($_sendHeader && !headers_sent())
				header('Content-Type: application/xhtml+xml');
			return str_replace(array('&','&amp;amp;'),'&amp;',HtmlTag::displayFullHtml(false));
		}
		else
			return '';
	}
	/**
	 * Méthode permettant de définir un attribut et sa valeur pour l'élément HtmlTag
	 *
	 * @uses HtmlTag::attributeIsValid()
	 * @uses HtmlTag::getDomElement()
	 * @uses DOMElement::setAttribute()
	 * @param string valeur de l'attribut HtmlTag
	 * @param mixed|HtmlTag valeur de l'élément HtmlTag
	 * @param bool appel depuis une méthode de HtmlTag pour définir un attribut spécifique
	 * @return bool true|false selon la validité de l'attribut
	 */
	public function addAttribute($_attributeName, $_attributeValue, $_specificAttributeMethodCall = false)
	{
		/**
		 * Si nom de l'attribut valide et valeur de type chaine de caractères|tableau de valeurs
		 */
		if((is_scalar($_attributeValue) || is_array($_attributeValue) || ($_attributeValue instanceof HtmlTag)) && HtmlTag::attributeIsValid($_attributeName))
		{
			$attributeValue = '';
			if(is_array($_attributeValue))
			{
				while(list($key,$value) = each($_attributeValue))
				{
					if(is_array($value))
						$value = implode(' ',$value);
					if(is_scalar($value) && is_scalar($key))
					{
						$value = preg_replace('/(\s+)/',' ',trim($value));
						switch ($_attributeName)
						{
							case 'style':
								$attributeValue .= trim($key) . ':' . $value . ';';
								break;
							case 'class':
								$attributeValue .= ($attributeValue != ''?' ':'') . $value;
								break;
							case 'onblur':
							case 'onchange':
							case 'onclick':
							case 'onfocus':
							case 'onkeypress':
							case 'onkeyup':
							case 'onkeydown':
							case 'onmousedown':
							case 'onmousemove':
							case 'onmouseover':
							case 'onmouseout':
							case 'onmouseup':
							case 'onsubmit':
								$attributeValue .= ($attributeValue != ''?' ':'') . $value . (substr($value,-1) == ';'?'':';');
								break;
						}
					}
					else
						$this->addAttribute($_attributeName,$value);
				}
			}
			else
				$attributeValue = $_attributeValue;
			/**
			 * Appel de la méthode propre à l'attribut si existante
			 * et si cette méthode n'est pas appelée depuis la méthode propre à l'attribut
			 */
			$setMethodName = 'set' . ucfirst($_attributeName);
			if(!$_specificAttributeMethodCall && method_exists($this,$setMethodName))
				return $this->$setMethodName($attributeValue);
			/**
			 * Sinon ajout de l'attribut à l'élément
			 */
			else
				return $this->getDomElement()->setAttribute($_attributeName,htmlentities($attributeValue,ENT_QUOTES,null,false));
		}
		else
			return false;
	}
	/**
	 * Alias to addAttribute()
	 * @see HtmlTag::addAttribute()
	 * 
	 * @param string valeur de l'attribut HtmlTag
	 * @param mixed|HtmlTag valeur de l'élément HtmlTag
	 * @return bool true|false selon la validité de l'attribut
	 */
	public function setAttribute($_attributeName, $_attributeValue)
	{
		return $this->addAttribute($_attributeName,$_attributeValue);
	}
	/**
	 * Méthode permettant de définir les attributs d'un élément HTML à partir d'un tableau
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
					if(method_exists($this,$setAttr) && (is_scalar($attrValue) || ($setAttr == 'setValue' && ($attrValue instanceof HtmlTag))))
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
	 * Méthode permettant d'ajouter à l'objet en cours les attributs du DOMElement en paramètre
	 * 
	 * @uses HtmlTag::addAttributes()
	 * @uses HtmlTag::_getDomElementAttributes()
	 * @param DOMElement
	 * @return bool true
	 */
	public function addDOMElementAttributes(DOMElement $_domElement)
	{
		return $this->addAttributes(HtmlTag::_getDomElementAttributes($_domElement));
	}
	/**
	 * Méthode permettant de récupérer la valeur d'un attribut
	 *
	 * @uses HtmlTag::getDomElement()
	 * @uses DOMElement::getAttribute()
	 * @uses DOMElement::hasAttribute()
	 * @param string nom de l'attribut
	 * @return string
	 */
	public function getAttribute($_attributeName)
	{
		return (is_string($_attributeName) && $this->getDomElement() && $this->getDomElement()->hasAttribute($_attributeName))?$this->getDomElement()->getAttribute($_attributeName):null;
	}
	/**
	 * Méthode permettant de supprimer un attribut de l'élément en cours
	 *
	 * @uses HtmlTag::getDomElement()
	 * @uses DOMElement::removeAttribute()
	 * @param string nom de l'attribut
	 * @return bool true|false
	 */
	public function removeAttribute($_attributeName)
	{
		return (is_string($_attributeName) && $this->getDomElement() && $this->getDomElement()->hasAttribute($_attributeName))?$this->getDomElement()->removeAttribute($_attributeName):false;
	}
	/**
	 * Alias to removeAttribute
	 *
	 * @uses HtmlTag::removeAttribute()
	 * @param string nom de l'attribut
	 * @return bool true|false
	 */
	public function unsetAttribute($_attributeName)
	{
		return $this->removeAttribute($_attributeName);
	}
	/**
	 * @return DOMElement
	 */
	public function getDomElement()
	{
		return $this->domElement;
	}
	/**
	 * Méthode permettant de récupérer au format tableau les attributs et 
	 * leur valeur de l'élément DOMElement de l'objet en cours
	 * 
	 * @uses HtmlTag::_getDomElementAttributes()
	 * @return array les attributs de l'élément DOMElement
	 */
	public function getDomElementAttributes()
	{
		return $this->getDomElement()?HtmlTag::_getDomElementAttributes($this->getDomElement()):array();
	}
	/**
	 * Méthode satic de récupération des attributs d'un DOMElement
	 * 
	 * @uses DOMElement::hasAttributes()
	 * @uses DOMNamedNodeMap::item()
	 * @uses DOMNodeList::item()
	 * @param DOMElement
	 * @return array les attributs de l'élément DOMElement
	 */
	public static function _getDomElementAttributes(DOMElement $_domElement)
	{
		$domElementAttributes = array();
		if($_domElement instanceof DOMElement)
		{
			if($_domElement->hasAttributes())
			{
				$attributes = $_domElement->attributes;
				for($j = 0;; $j++)
				{
					if($attribute = $attributes->item($j))
						$domElementAttributes[$attribute->nodeName] = iconv('UTF-8','ISO-8859-1',$attribute->nodeValue);
					else
						break;
				}
			}
		}
		return $domElementAttributes;
	}
	/**
	 * @param DOMElement
	 * @return DOMElement
	 */
	public function setDomElement(DOMElement $_domElement)
	{
		return ($this->domElement = $_domElement);
	}
	/**
	 * Méthode permettant de définir l'attribut 'id' de l'élément HtmlTag
	 *
	 * @uses HtmlTag::addAttribute()
	 * @uses HtmlTag::getId()
	 * @param string l'id
	 * @return bool true|false
	 */
	public function setId($_id)
	{
		if(is_scalar($_id))
		{
			if((defined('HTML_TAG_DEFINE_ID') && HTML_TAG_DEFINE_ID === true && !array_key_exists($_id,HtmlTag::$declaredIds)) || (defined('HTML_TAG_DEFINE_ID') && HTML_TAG_DEFINE_ID !== true) || !defined('HTML_TAG_DEFINE_ID'))
			{
				HtmlTag::$declaredIds[$_id] = 0;
				return $this->addAttribute('id',trim($_id),true);
			}
			elseif($this->getId() == $_id)
				return true;
			else
				return $this->addAttribute('id',trim($_id) . '_' . (str_repeat('0',6 - strlen(++HtmlTag::$declaredIds[$_id]))) . (HtmlTag::$declaredIds[$_id]),true);
		}
		else
			return false;
	}
	/**
	 * Méthode permettant de récupérer la valeur de l'attribut id définie
	 *
	 * @uses HtmlTag::getAttribute()
	 * @return string
	 */
	public function getId()
	{
		return $this->getAttribute('id');
	}
	/**
	 * Méthode permettant de supprimer la valeur de l'attribut id définie
	 *
	 * @uses HtmlTag::unsetAttribute()
	 * @return bool true|false
	 */
	public function unsetId()
	{
		return $this->unsetAttribute('id');
	}
	/**
	 * Méthode permettant de définir l'attribut 'accesskey' de l'élément HtmlTag
	 *
	 * @uses HtmlTag::addAttribute()
	 * @param string le accesskey
	 * @return bool true|false
	 */
	public function setAccesskey($_accesskey)
	{
		return $this->addAttribute('accesskey',trim($_accesskey),true);
	}
	/**
	 * Méthode permettant de récupérer la valeur de l'attribut accesskey définie
	 *
	 * @uses HtmlTag::getAttribute()
	 * @return string
	 */
	public function getAccesskey()
	{
		return $this->getAttribute('accesskey');
	}
	/**
	 * Méthode permettant de supprimer la valeur de l'attribut accesskey définie
	 *
	 * @uses HtmlTag::unsetAttribute()
	 * @return bool true|false
	 */
	public function unsetAccesskey()
	{
		return $this->unsetAttribute('accesskey');
	}
	/**
	 * Méthode permettant de définir l'attribut 'tabindex' de l'élément HtmlTag
	 *
	 * @uses HtmlTag::addAttribute()
	 * @param string le tabindex
	 * @return bool true|false
	 */
	public function setTabindex($_tabindex)
	{
		return $this->addAttribute('tabindex',trim($_tabindex),true);
	}
	/**
	 * Méthode permettant de récupérer la valeur de l'attribut tabindex définie
	 *
	 * @uses HtmlTag::getAttribute()
	 * @return string
	 */
	public function getTabindex()
	{
		return $this->getAttribute('tabindex');
	}
	/**
	 * Méthode permettant de supprimer la valeur de l'attribut tabindex définie
	 *
	 * @uses HtmlTag::unsetAttribute()
	 * @return bool true|false
	 */
	public function unsetTabindex()
	{
		return $this->unsetAttribute('tabindex');
	}
	/**
	 * Méthode permettant de définir l'attribut 'name' de l'élément HtmlTag
	 *
	 * @uses HtmlTag::addAttribute()
	 * @param string le name
	 * @return bool true|false
	 */
	public function setName($_name)
	{
		return $this->addAttribute('name',trim($_name),true);
	}
	/**
	 * Méthode permettant de récupérer la valeur de l'attribut name définie
	 *
	 * @uses HtmlTag::getAttribute()
	 * @return string
	 */
	public function getName()
	{
		return $this->getAttribute('name');
	}
	/**
	 * Méthode permettant de supprimer la valeur de l'attribut name définie
	 *
	 * @uses HtmlTag::unsetAttribute()
	 * @return bool true|false
	 */
	public function unsetName()
	{
		return $this->unsetAttribute('name');
	}
	/**
	 * Méthode permettant de définir l'attribut 'class' de l'élément HtmlTag
	 *
	 * @uses HtmlTag::getClass()
	 * @uses HtmlTag::addAttribute()
	 * @param string le class
	 * @return bool true|false
	 */
	public function setClass($_class)
	{
		if(is_scalar($_class))
		{
			$class = preg_replace('/(\s+)/',' ',trim($this->getClass() . ($this->getClass() != ''?' ':'') . $_class));
			$classes = explode(' ',$class);
			$newClasses = array();
			while(list(,$className) = each($classes))
				$newClasses[$className] = trim($className);
			return count($newClasses) > 0?$this->addAttribute('class',implode(' ',$newClasses),true):false;
		}
		else
			return false;
	}
	/**
	 * Méthode permettant de récupérer la valeur de l'attribut class définie
	 *
	 * @uses HtmlTag::getAttribute()
	 * @return string
	 */
	public function getClass()
	{
		return $this->getAttribute('class');
	}
	/**
	 * Méthode permettant de supprimer la valeur de l'attribut class définie
	 *
	 * @uses HtmlTag::unsetAttribute()
	 * @return bool true|false
	 */
	public function unsetClass()
	{
		return $this->unsetAttribute('class');
	}
	/**
	 * Méthode permettant de définir l'attribut 'style' de l'élément HtmlTag
	 *
	 * @uses HtmlTag::addAttribute()
	 * @param string le style
	 * @return bool true|false
	 */
	public function setStyle($_style)
	{
		return $this->addAttribute('style',trim($_style),true);
	}
	/**
	 * Méthode permettant de récupérer la valeur de l'attribut style définie
	 *
	 * @uses HtmlTag::getAttribute()
	 * @return string
	 */
	public function getStyle()
	{
		return $this->getAttribute('style');
	}
	/**
	 * Méthode permettant de supprimer la valeur de l'attribut style définie
	 *
	 * @uses HtmlTag::unsetAttribute()
	 * @return bool true|false
	 */
	public function unsetStyle()
	{
		return $this->unsetAttribute('style');
	}
	/**
	 * Méthode permettant de définir l'attribut 'title' de l'élément HtmlTag
	 *
	 * @uses HtmlTag::addAttribute()
	 * @param string le title
	 * @return bool true|false
	 */
	public function setTitle($_title)
	{
		return $this->addAttribute('title',$_title,true);
	}
	/**
	 * Méthode permettant de récupérer la valeur de l'attribut title définie
	 *
	 * @uses HtmlTag::getAttribute()
	 * @return string
	 */
	public function getTitle()
	{
		return $this->getAttribute('title');
	}
	/**
	 * Méthode permettant de supprimer la valeur de l'attribut title définie
	 *
	 * @uses HtmlTag::unsetAttribute()
	 * @return bool true|false
	 */
	public function unsetTitle()
	{
		return $this->unsetAttribute('title');
	}
	/**
	 * Méthode permettant de définir l'attribut 'type' de l'élément HtmlTag
	 *
	 * @uses HtmlTag::addAttribute()
	 * @param string le title
	 * @return bool true|false
	 */
	public function setType($_type)
	{
		return $this->addAttribute('type',trim($_type),true);
	}
	/**
	 * Méthode permettant de récupérer la valeur de l'attribut type définie
	 *
	 * @uses HtmlTag::getAttribute()
	 * @return string
	 */
	public function getType()
	{
		return $this->getAttribute('type');
	}
	/**
	 * Méthode permettant de supprimer la valeur de l'attribut type définie
	 *
	 * @uses HtmlTag::unsetAttribute()
	 * @return bool true|false
	 */
	public function unsetType()
	{
		return $this->unsetAttribute('type');
	}
	/**
	 * Méthode permettant d'indiquer que le tag HTML est en readonly uniquement
	 *
	 * @uses HtmlTag::addAttribute()
	 * @uses HtmlTag::unsetReadonly()
	 * @param bool readonly
	 * @return bool true|false
	 */
	public function setReadonly($_readonly = true)
	{
		return $_readonly?$this->addAttribute('readonly','readonly',true):$this->unsetReadonly();
	}
	/**
	 * Méthode permettant d'indiquer que le tag HTML n'est pas en readonly uniquement
	 *
	 * @uses HtmlTag::removeAttribute()
	 * @return bool true|false
	 */
	public function unsetReadonly()
	{
		return $this->removeAttribute('readonly');
	}
	/**
	 * Méthode permettant d'indiquer que le tag HTML est désacivé (disabled) uniquement
	 *
	 * @uses HtmlTag::addAttribute()
	 * @uses HtmlTag::unsetDisabled()
	 * @param bool disabled
	 * @return bool true|false
	 */
	public function setDisabled($_disabled = true)
	{
		return $_disabled?$this->addAttribute('disabled','disabled',true):$this->unsetDisabled();
	}
	/**
	 * Méthode permettant d'indiquer que le tag HTML n'est pas désacivé (disabled) uniquement
	 *
	 * @uses HtmlTag::removeAttribute()
	 * @return bool true|false
	 */
	public function unsetDisabled()
	{
		return $this->removeAttribute('disabled');
	}
	/**
	 * Méthode permettant de définir l'événement onclick avec l'appel de la méthode par défaut onClickF
	 * 
	 * @uses HtmlTag::setDomEventHandler()
	 * @return bool true|false
	 */
	public function defineOnclick($_eventHandler = 'onClickF')
	{
		return $this->setDomEventHandler('onclick',$_eventHandler . '(this,event);return false;');
	}
	/**
	 * Méthode permettant de définir l'événement onchange avec l'appel de la méthode par défaut onChangeF
	 * 
	 * @uses HtmlTag::setDomEventHandler()
	 * @return bool true|false
	 */
	public function defineOnchange($_eventHandler = 'onChangeF')
	{
		return $this->setDomEventHandler('onchange',$_eventHandler . '(this,event);return false;');
	}
	/**
	 * Méthode permettant de définir l'événement onsubmit avec l'appel de la méthode par défaut onSubmitF
	 * 
	 * @uses HtmlTag::setDomEventHandler()
	 * @return bool true|false
	 */
	public function defineOnsubmit($_eventHandler = 'onSubmitF')
	{
		return $this->setDomEventHandler('onsubmit',$_eventHandler . '(this,event);return false;');
	}
	/**
	 * Méthode permettant de définir l'événement onmouseout avec l'appel de la méthode par défaut onMouseoutF
	 * 
	 * @uses HtmlTag::setDomEventHandler()
	 * @return bool true|false
	 */
	public function defineOnmouseout($_eventHandler = 'onMouseoutF')
	{
		return $this->setDomEventHandler('onmouseout',$_eventHandler . '(this,event);return false;');
	}
	/**
	 * Méthode permettant de définir l'événement onmouseover avec l'appel de la méthode par défaut onMouseoverF
	 * 
	 * @uses HtmlTag::setDomEventHandler()
	 * @return bool true|false
	 */
	public function defineOnmouseover($_eventHandler = 'onMouseoverF')
	{
		return $this->setDomEventHandler('onmouseover',$_eventHandler . '(this,event);return false;');
	}
	/**
	 * Méthode permettant de définir l'événement onkeyup avec l'appel de la méthode par défaut onKeyupF
	 * 
	 * @uses HtmlTag::setDomEventHandler()
	 * @return bool true|false
	 */
	public function defineOnkeyup($_eventHandler = 'onKeyupF')
	{
		return $this->setDomEventHandler('onkeyup',$_eventHandler . '(this,event);return false;');
	}
	/**
	 * Méthode permettant de définir l'événement onkeydown avec l'appel de la méthode par défaut onKeydownF
	 * 
	 * @uses HtmlTag::setDomEventHandler()
	 * @return bool true|false
	 */
	public function defineOnkeydown($_eventHandler = 'onKeydownF')
	{
		return $this->setDomEventHandler('onkeydown',$_eventHandler . '(this,event);return false;');
	}
	/**
	 * Méthode permettant de définir l'événement onfocus avec l'appel de la méthode par défaut onFocusF
	 * 
	 * @uses HtmlTag::setDomEventHandler()
	 * @return bool true|false
	 */
	public function defineOnfocus($_eventHandler = 'onFocusF')
	{
		return $this->setDomEventHandler('onfocus',$_eventHandler . '(this,event);return false;');
	}
	/**
	 * Méthode permettant de définir l'événement onblur avec l'appel de la méthode par défaut onBlurF
	 * 
	 * @uses HtmlTag::setDomEventHandler()
	 * @return bool true|false
	 */
	public function defineOnblur($_eventHandler = 'onBlurF')
	{
		return $this->setDomEventHandler('onblur',$_eventHandler . '(this,event);return false;');
	}
	/**
	 * Méthode générale utilisée par les méthode de définition des événements DOM
	 * 
	 * @uses HtmlTag::addAttribute()
	 * @param string nom de l'événement
	 * @param string nom de la fonction de prise en charge de l'événement
	 * @return bool true|false
	 */
	private function setDomEventHandler($_domEvent, $_eventHandler)
	{
		return $this->addAttribute($_domEvent,$_eventHandler);
	}
	/**
	 * @return bool
	 */
	public function getHasInnerHtml()
	{
		return $this->hasInnerHtml;
	}
	/**
	 * @param bool
	 * @return bool
	 */
	private function setHasInnerHtml($_hasInnerHtml)
	{
		return ($this->hasInnerHtml = $_hasInnerHtml);
	}
	/**
	 * @uses HtmlTag::getDomElement()
	 * @return string
	 */
	public function getTagName()
	{
		return $this->getDomElement()?$this->getDomElement()->tagName:'';
	}
	/**
	 * @uses HtmlTag::getDomElement()
	 * @uses DOMDocument::createElement()
	 * @uses HtmlTag::setHasInnerHtml()
	 * @param string
	 * @return void
	 */
	private function setTagName($_tagName)
	{
		/**
		 * Création de la balise elle-même
		 */
		HtmlTag::$domDocument?$this->setDomElement(HtmlTag::$domDocument->createElement(trim($_tagName))):null;
		switch ($_tagName)
		{
			case 'a':
			case 'abbr':
			case 'acronym':
			case 'address':
			case 'area':
			case 'b':
			case 'base':
			case 'bdo':
			case 'big':
			case 'blockquote':
			case 'body':
			case 'button':
			case 'caption':
			case 'cite':
			case 'code':
			case 'col':
			case 'colgroup':
			case 'dd':
			case 'del':
			case 'dfn':
			case 'div':
			case 'dl':
			case 'DOCTYPE':
			case 'dt':
			case 'em':
			case 'fieldset':
			case 'form':
			case 'h1':
			case 'h2':
			case 'h3':
			case 'h4':
			case 'h5':
			case 'h6':
			case 'head':
			case 'html':
			case 'i':
			case 'ins':
			case 'kbd':
			case 'label':
			case 'legend':
			case 'li':
			case 'map':
			case 'noscript':
			case 'object':
			case 'ol':
			case 'optgroup':
			case 'option':
			case 'p':
			case 'param':
			case 'pre':
			case 'q':
			case 'script':
			case 'select':
			case 'small':
			case 'span':
			case 'strong':
			case 'style':
			case 'sub':
			case 'sup':
			case 'table':
			case 'tbody':
			case 'td':
			case 'textarea':
			case 'tfoot':
			case 'th':
			case 'thead':
			case 'title':
			case 'tr':
			case 'tt':
			case 'ul':
			case 'samp':
			case 'var':
				$this->setHasInnerHtml(true);
				break;
			case 'br':
			case 'hr':
			case 'img':
			case 'input':
			case 'link':
			case 'meta':
				$this->setHasInnerHtml(false);
				break;
		}
	}
	/** 
	 * Retourne la liste des attributs de tag HTML valides
	 * @return array
	 */
	public static function getValidAttributesName()
	{
		return HtmlTag::$validAttributesName;
	}
	/**
	 * Méthode permettant de tester la validité d'un attribut
	 * 
	 * @uses HtmlTag::getValidAttributesName()
	 * @param string nom de l'attribut
	 * @return bool true|false
	 */
	public static function attributeIsValid($_attributeName)
	{
		return (is_string($_attributeName) && array_key_exists($_attributeName,HtmlTag::getValidAttributesName()));
	}
	/**
	 * Méthode permettant de déclarer des attributs HTML valides en plus de ceux par défaut
	 * 
	 * @param string nom de l'attribute
	 */
	protected function addValidAttribute($_attributeName)
	{
		return (is_string($_attributeName) && (HtmlTag::$validAttributesName[$_attributeName] = ''));
	}
	/**
	 * Retourne la liste des tags HTML valides
	 * @return array
	 */
	public static function getValidTagsName()
	{
		return HtmlTag::$validTagsName;
	}
	/**
	 * Méthode permettant de tester la validité d'un tag HTML
	 * 
	 * @uses HtmlTag::getValidTagsName()
	 * @param string nom du tag
	 * @return bool true|false
	 */
	public static function tagIsValid($_tagName)
	{
		return (is_string($_tagName) && array_key_exists(strtolower($_tagName),HtmlTag::getValidTagsName()));
	}
	/**
	 * Méthode générale d'ajaout de définition de la valeur de l'objet ou d'ajout d'une valeur
	 * 
	 * @uses HtmlTag::_setValue()
	 * @param mixed|HtmlTag
	 * @return bool
	 */
	public function setValue($_value)
	{
		return $this->_setValue($_value);
	}
	/**
	 * @uses HtmlTag::getDomElement()
	 * @uses HtmlTag::getValueAttribute()
	 * @uses HtmlTag::addAttribute()
	 * @uses HtmlTag::setValue()
	 * @uses DOMDocument::createElement()
	 * @uses DOMDocument::createTextNode()
	 * @uses DOMNode::appendChild()
	 * @param mixed|HtmlTag
	 * @param bool indique s'il faut ou non encoder les données
	 * @return bool
	 */
	protected function _setValue($_value, $_encodeHtmlEntities = true)
	{
		try
		{
			$_value = is_scalar($_value)?trim($_value):$_value;
			if(is_scalar($_value) && $this->getValueAttribute() != '')
				$this->addAttribute($this->getValueAttribute(),$_encodeHtmlEntities?htmlentities($_value,ENT_QUOTES,null,false):$_value,true);
			elseif(is_scalar($_value) && !empty($_value) && $this->getHasInnerHtml() && $this->getDomElement())
				$this->getDomElement()->appendChild(HtmlTag::$domDocument->createTextNode($_encodeHtmlEntities?htmlentities($_value === ' '?'&nbsp;':$_value,ENT_QUOTES,null,false):$_value));
			elseif(($_value instanceof HtmlTag) && $this->getDomElement())
				$this->getDomElement()->appendChild($_value->getDomElement());
			elseif(is_array($_value))
				while(list(,$htmlTag) = each($_value))
					$this->_setValue($htmlTag,$_encodeHtmlEntities);
			return true;
		}
		catch(DOMException $exception)
		{
			return false;
		}
	}
	/**
	 * Méthode permettant d'ajouter une valeur à l'élément HtmlTag
	 *
	 * @uses HtmlTag::setValue()
	 * @param mixed|HtmlTag
	 * @return bool
	 */
	public function addValue($_value)
	{
		return $this->setValue($_value);
	}
	/**
	 * Méthode permettant de définir un contenu au format HTML
	 * ou d'ajouter un contenu au format HTML
	 * 
	 * @uses DOMDocument::loadXML()
	 * @uses HtmlTag::addChildren()
	 * @param string code html
	 * @return bool
	 */
	public function addHtml($_html)
	{
		if(!is_string($_html) || empty($_html))
			return false;
		$d = new DOMDocument('1.0','ISO-8859-1');
		/**
		 * Suppression de tout espace de dbut et de fin
		 */
		$html = str_replace(array('&','&amp;amp;'),'&amp;',trim($_html));
		/**
		 * On s'assure d'avoir un code commençant par <?xml ...
		 */
		if(strpos($html,'<?xml') !== 0 && strpos($html,'<?xml') <= 0)
			$html = '<?xml version="1.0" encoding="ISO-8859-1"?>' . "\r\n" . $html;
		if($d->loadXML($html))
			return $this->addChildren($d);
		else
			return false;
	}
	/**
	 * Méthode permettant de charger un fichier HTML
	 * 
	 * @uses HtmlTag::addHtml()
	 * @param string chemin d'accès au fichier
	 * @return bool true[false
	 */
	public function addHtmlFromFile($_fileName)
	{
		return is_file($_fileName)?$this->addHtml(file_get_contents($_fileName)):false;
	}
	/**
	 * Méthode permettant de charger un document HTML et créer notre objet avec le tag HTML et le conteu HTML
	 * 
	 * @uses DOMDocument::loadXML()
	 * @uses DOMNodeList::item()
	 * @uses DOMNOde::hasAttributes()
	 * @uses DOMNamedNodeMap::item()
	 * @uses HtmlTag::__construct()
	 * @uses HtmlTag::addChildren()
	 * @uses HtmlTag::addAttributes()
	 * @param String source HTML
	 * @return bool true|false
	 */
	public function loadHtml($_html)
	{
		if(!is_string($_html) || empty($_html))
			return false;
		$d = new DOMDocument('1.0','ISO-8859-1');
		/**
		 * Suppression de tout espace de dbut et de fin
		 */
		$html = str_replace(array('&','&amp;amp;'),'&amp;',trim($_html));
		/**
		 * On s'assure d'avoir un code commençant par <?xml ...
		 */
		if(strpos($html,'<?xml') !== 0 && strpos($html,'<?xml') <= 0)
			$html = '<?xml version="1.0" encoding="ISO-8859-1"?>' . "\r\n" . $html;
		if($d->loadXML($html))
		{
			if($d->hasChildNodes())
			{
				/**
				 * Recherche du premier noeud correct dans le cas de commentaires en début de template
				 */
				$item = 0;
				while(!($d->childNodes->item($item) instanceof DOMElement))
					$item++;
				/**
				 * Si un noeud est trouvé
				 */
				if($d->childNodes->item($item) instanceof DOMElement)
				{
					$domElement = $d->childNodes->item($item);
					if(HtmlTag::tagIsValid($domElement->tagName))
					{
						/**
						 * Définition du tag de l'objet en cours
						 */
						$this->setTagName($domElement->tagName);
						/**
						 * Ajout des attributs
						 */
						$this->addDOMElementAttributes($domElement);
						/**
						 * Ajout des enfants
						 */
						$this->addChildren($domElement);
						return true;
					}
					else
						return false;
				}
				else
					return false;
			}
			else
				return false;
		}
		else
			return false;
	}
	/**
	 * Méthode permettant de chargerle contenu HTML d'un fichier et d'initialiser l'objet en cours avec le contenu HTML
	 * 
	 * @uses HtmlTag::loadHtml()
	 * @param string chemin complet d'accès au fichier
	 * @return bool true|false
	 */
	public function loadHtmlFromFile($_fileName)
	{
		return is_file($_fileName)?$this->loadHtml(file_get_contents($_fileName)):false;
	}
	/**
	 * Méthode utilisée pour récupérer le contenu HTML d'un objet de type DOMNode
	 * et de l'ajouter proprement à l'objet en cours
	 * 
	 * @uses HtmlTag::getHtmlTagFromDOMElement()
	 * @uses HtmlTag::setValue()
	 * @uses HtmlTag::addChildren()
	 * @uses DOMNode::hasAttributes()
	 * @uses DOMNamedNodeMap::item()
	 * @uses DOMNodeList::item()
	 * @param DOMNode noeud contenant le contenu HTML
	 * @return bool
	 */
	public function addChildren(DOMNode $_node)
	{
		$childNodes = $_node->childNodes;
		$nbChildNodes = $childNodes->length;
		if($nbChildNodes > 0)
		{
			for($i = 0; $i < $nbChildNodes; $i++)
			{
				$child = $childNodes->item($i);
				if(($child instanceof DOMElement) && ($tag = HtmlTag::getHtmlTagFromDOMElement($child,false,false)))
				{
					$this->setValue($tag);
					if($child->hasChildNodes() && $child->childNodes->length == 1 && in_array($childNodes->item(0)->nodeType,array(XML_TEXT_NODE,XML_ATTRIBUTE_CDATA,XML_ELEMENT_NODE)))
						$tag->setValue(iconv('UTF-8','ISO-8859-1',$child->childNodes->item(0)->nodeValue));
					else
						$tag->addChildren($child);
				}
			}
			return true;
		}
		else
			return false;
	}
	/**
	 * Méthode permettant de supprimer un élément par son id ou un attribut et sa valeur définie
	 *
	 * @uses HtmlTag::getDomElement()
	 * @uses DOMElement::getAttribute()
	 * @uses DOMElement::hasAttribute()
	 * @uses DOMElement::removeChild()
	 * @uses DOMElement::item()
	 * @param string l'id de l'élément
	 * @return bool true|false
	 */
	public function delValue($_attributeValue, $_attributeName = 'id')
	{
		if($this->getDomElement() && $this->getDomElement()->childNodes->length > 0)
		{
			$childNodes = $this->getDomElement()->childNodes;
			$nbChildNodes = $childNodes->length;
			$delete = true;
			for($i = 0; $i < $nbChildNodes; $i++)
			{
				if($childNodes->item($i) && $childNodes->item($i)->hasAttribute($_attributeName) && $childNodes->item($i)->getAttribute($_attributeName) == $_attributeValue)
				{
					$delete &= $this->getDomElement()->removeChild($childNodes->item($i))?true:false;
					/**
					 * Lors de la suppression, le nombre d'enfants diminue d'1, de ce fait,
					 * le pointeur $i pointe sur l'objet suivant n'existant plus, on le décrémente
					 */
					$i--;
				}
			}
		}
		else
			$delete = false;
		return $delete;
	}
	/**
	 * @return HtmlTag|null
	 */
	public static function getHtmlDocument()
	{
		return HtmlTag::$htmlDocument;
	}
	/**
	 * Méthode permettant de définir le body de la page
	 *
	 * @param HtmlTagBody le body
	 * @return HtmlTagBody le body
	 */
	public static function setBody(HtmlTagBody $_body)
	{
		return (HtmlTag::$htmlBody = $_body);
	}
	/**
	 * Méthode de récupération du body
	 *
	 * @uses HtmlTag::setBody()
	 * @return Htmltag
	 */
	public static function getBody()
	{
		if(!HtmlTag::$htmlBody)
			HtmlTag::setBody(new HtmlTagBody());
		return HtmlTag::$htmlBody;
	}
	/**
	 * Méthode permettant d'ajouter un élément au body
	 *
	 * @uses HtmlTag::getBody()
	 * @uses HtmlTag::addValue()
	 * @param HtmlTag
	 * @return bool
	 */
	public static function addToBody(HtmlTag $_element)
	{
		return HtmlTag::getBody()->addValue($_element);
	}
	/**
	 * Méthode permettant de définir le head de la page
	 *
	 * @param HtmlTagHead le head
	 * @return HtmlTagHead le head
	 */
	public static function setHead(HtmlTagHead $_head)
	{
		return (HtmlTag::$htmlHead = $_head);
	}
	/**
	 * Méthode de récupération du head
	 *
	 * @uses HtmlTag::setHead()
	 * @return Htmltag
	 */
	public static function getHead()
	{
		if(!HtmlTag::$htmlHead)
			HtmlTag::setHead(new HtmlTagHead());
		return HtmlTag::$htmlHead;
	}
	/**
	 * Méthode permettant d'ajouter un élément au head
	 *
	 * @uses HtmlTag::getHead()
	 * @uses HtmlTag::addValue()
	 * @param HtmlTag
	 * @return bool
	 */
	public static function addToHead(HtmlTag $_element)
	{
		return HtmlTag::getHead()->addValue($_element);
	}
	/**
	 * Méthode retournat l'objet DOMDocument
	 * 
	 * @return DOMDocument
	 */
	public static function getDomDocument()
	{
		return HtmlTag::$domDocument;
	}
	/**
	 * Méthode permettant de récupérer un objet de la classe HtmlTag par son id
	 * représentant un élément existant dans le document en cours
	 * 
	 * @uses HtmlTag::getDomElement()
	 * @uses HtmlTag::getHead()
	 * @uses HtmlTag::getBody()
	 * @uses HtmlTag::findElementBy()
	 * @uses HtmlTag::getHtmlTagFromDOMElement()
	 * @param string id de l'élément HTML
	 * @return HtmlTag|null
	 */
	public static function getHtmlTagById($_elementId)
	{
		$domElement = null;
		if(HtmlTag::getHead())
			$domElement = HtmlTag::findElementBy(HtmlTag::getHead()->getDomElement(),$_elementId);
		if(!$domElement && HtmlTag::getBody())
			$domElement = HtmlTag::findElementBy(HtmlTag::getBody()->getDomElement(),$_elementId);
		if($domElement instanceof DOMElement)
			return HtmlTag::getHtmlTagFromDOMElement($domElement);
		else
			return false;
	}
	/**
	 * Méthode permettant de récupérer un objet de la classe HtmlTag contenu par l'objet en cours
	 * 
	 * @uses HtmlTag::getDomElement()
	 * @uses HtmlTag::findElementBy()
	 * @uses HtmlTag::getHtmlTagFromDOMElement()
	 * @param string la valeur de l'attribut id de l'élément
	 * @return HtmlTag|null
	 */
	public function getElementById($_elementId)
	{
		$domElement = null;
		if($this->getDomElement())
			$domElement = HtmlTag::findElementBy($this->getDomElement(),$_elementId);
		if($domElement instanceof DOMElement)
			return HtmlTag::getHtmlTagFromDOMElement($domElement);
		else
			return false;
	}
	/**
	 * Méthode permettant de créer l'objet HtmlTag à partir d'un objet DOMElement
	 * 
	 * @uses HtmlTag::createTag()
	 * @uses HtmlTag::setDomElement()
	 * @uses HtmlTag::addChildren()
	 * @uses HtmlTag::getDomElementAttributes()
	 * @param DOMElement
	 * @param bool force l'ajout des enfants du noeud
	 * @param bool force la redéfinition de l'attribut DomElement de l'objet créé
	 * @return HtmlTag
	 */
	public static function getHtmlTagFromDOMElement(DOMElement $_domElement, $_addChildren = false, $_setDomElement = true)
	{
		$type = null;
		$attributesArray = HtmlTag::_getDomElementAttributes($_domElement);
		if(is_array($attributesArray) && array_key_exists('type',$attributesArray))
			$type = $attributesArray['type'];
		if($htmlTag = HtmlTag::createTag($_domElement->nodeName,$attributesArray,$type))
		{
			if(!$_addChildren && $_setDomElement)
				$htmlTag->setDomElement($_domElement);
			if($_addChildren)
				$htmlTag->addChildren($_domElement);
			return $htmlTag;
		}
		else
			return null;
	}
	/**
	 * Méthode récursive de recherche d'un élément par son id
	 * 
	 * @uses HtmlTag::findElementBy()
	 * @uses HtmlTag::getHtmlTagFromDOMElement()
	 * @uses DomNode::hasAttribute()
	 * @uses DomNode::getAttribute()
	 * @uses DOMElement::hasChildNodes()
	 * @uses DOMNamedNodeMap::item()
	 * @uses DOMNodeList::item()
	 * @param DOMElement
	 * @param string valeur de l'attribute de l'élément recherché
	 * @param string nom de l'attribut
	 * @param bool|array si tableau=>va contenir tous les éléments répondant au critère
	 * @return DOMElement|null
	 */
	public static function findElementBy(DOMElement $_domElement, $_value = '*', $_attributeName = 'id', &$_multiples = false)
	{
		if($_domElement->hasChildNodes())
		{
			$childNodes = $_domElement->childNodes;
			$nbChildNodes = $childNodes->length;
			$forMultiples = is_array($_multiples);
			if($nbChildNodes)
			{
				for($i = 0; $i < $nbChildNodes; $i++)
				{
					if($childNodes->item($i) instanceof DOMElement)
					{
						/**
						 * Cas d'une recherche d'un ensemble d'éléments
						 */
						if($forMultiples)
						{
							/**
							 * Noeud en cours
							 */
							$valid = false;
							if(is_scalar($_attributeName) && $_domElement->hasAttribute($_attributeName) && in_array($_value,array('*',$_domElement->getAttribute($_attributeName))))
								$valid = true;
							elseif(is_array($_attributeName))
							{
								foreach($_attributeName as $attributeName=>$attributeValue)
									$valid |= ($_domElement->hasAttribute($attributeName) && in_array($attributeValue,array($_value,'*',$_domElement->getAttribute($attributeName))));
							}
							if($valid)
								$_multiples[] = HtmlTag::getHtmlTagFromDOMElement($_domElement);
							/**
							 * Noeud enfant
							 */
							$valid = false;
							if(is_scalar($_attributeName) && $childNodes->item($i)->hasAttribute($_attributeName) && in_array($_value,array('*',$childNodes->item($i)->getAttribute($_attributeName))))
								$valid = true;
							elseif(is_array($_attributeName))
							{
								foreach($_attributeName as $attributeName=>$attributeValue)
									$valid |= ($childNodes->item($i)->hasAttribute($attributeName) && in_array($attributeValue,array($_value,'*',$childNodes->item($i)->getAttribute($attributeName))));
							}
							if($valid)
								$_multiples[] = HtmlTag::getHtmlTagFromDOMElement($childNodes->item($i));
							/**
							 * Recherche sur les sous éléments
							 */
							HtmlTag::findElementBy($childNodes->item($i),$_value,$_attributeName,$_multiples);
						}
						/**
						 * Cas d'une recherche d'un élément en particulier
						 */
						elseif($_domElement->hasAttribute($_attributeName) && $_domElement->getAttribute($_attributeName) == $_value)
							return $_domElement;
						elseif($childNodes->item($i)->hasAttribute($_attributeName) && $childNodes->item($i)->getAttribute($_attributeName) == $_value)
							return $childNodes->item($i);
						elseif($domElement = HtmlTag::findElementBy($childNodes->item($i),$_value,$_attributeName,$_multiples))
							return $domElement;
					}
				}
			}
			else
				return null;
		}
		return null;
	}
	/**
	 * Méthode permettant de récupérer le nom de l'attribut définissant la "valeur" de la balise HtmlTag selon le tag défini
	 *
	 * @uses HtmlTag::getTagName()
	 * @return string
	 */
	private function getValueAttribute()
	{
		$valueAttribute = '';
		switch ($this->getTagName())
		{
			case 'abbr':
			case 'acronym':
			case 'address':
			case 'area':
			case 'b':
			case 'base':
			case 'bdo':
			case 'big':
			case 'blockquote':
			case 'body':
			case 'button':
			case 'caption':
			case 'cite':
			case 'code':
			case 'col':
			case 'colgroup':
			case 'dd':
			case 'del':
			case 'dfn':
			case 'div':
			case 'dl':
			case 'DOCTYPE':
			case 'dt':
			case 'em':
			case 'fieldset':
			case 'form':
			case 'h1':
			case 'h2':
			case 'h3':
			case 'h4':
			case 'h5':
			case 'h6':
			case 'head':
			case 'html':
			case 'i':
			case 'ins':
			case 'kbd':
			case 'label':
			case 'legend':
			case 'li':
			case 'map':
			case 'noscript':
			case 'object':
			case 'ol':
			case 'optgroup':
			case 'option':
			case 'p':
			case 'pre':
			case 'q':
			case 'script':
			case 'select':
			case 'small':
			case 'span':
			case 'strong':
			case 'style':
			case 'sub':
			case 'sup':
			case 'table':
			case 'tbody':
			case 'td':
			case 'textarea':
			case 'tfoot':
			case 'th':
			case 'thead':
			case 'title':
			case 'tr':
			case 'tt':
			case 'ul':
			case 'samp':
			case 'var':
			case 'br':
			case 'a':
			case 'hr':
				$valueAttribute = '';
				break;
			case 'img':
				$valueAttribute = 'src';
				break;
			case 'param':
			case 'input':
				$valueAttribute = 'value';
				break;
			case 'meta':
				$valueAttribute = 'content';
				break;
			case 'link':
				$valueAttribute = 'href';
				break;
		}
		return $valueAttribute;
	}
	/**
	 * Méthode retournant le nom du tag de la classe
	 *
	 * @return string html
	 */
	public static function __tagName()
	{
		return 'html';
	}
	/**
	 * Méthode retournant l'objet au format string
	 * 
	 * @uses HtmlTag::toHtml()
	 * @return string
	 */
	public function __toString()
	{
		try
		{
			$clone = clone ($this);
			$html = $this->toHtml(false);
			unset($clone);
			return $html;
		}
		catch(Exception $e)
		{
		}
		return '';
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