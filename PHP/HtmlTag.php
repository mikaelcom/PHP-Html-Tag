<?php
/**
 * Classe mère permettant de générer des éléments HtmlTag
 * Root class for all html tag elements
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 13/12/2009
 */
/**
 * Classe mère permettant de générer des éléments HtmlTag
 * Root class for all html tag elements
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
	 * Defines the root html tag name
	 * @var string
	 */
	const DOCTYPE_ROOT_TAG = 'html';
	/**
	 * Défini la norme respectée
	 * Defines the W3C norm
	 * @var string
	 */
	const DOCTYPE_DEFINITION = '-//W3C//DTD XHTML 1.0 Strict//EN';
	/**
	 * Défini l'url de la DTD
	 * Defines the DTD used
	 * @var string
	 */
	const DOCTYPE_URL = 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd';
	/**
	 * Encodage par défaut
	 * Defines the default encoding of the document
	 * @var string
	 */
	const DEFAULT_ENCODING = 'iso-8859-1';
	/**
	 * Valeur du class à définir pour le premier élément d'une liste
	 * Defined a CSS class value for the first element of a list of elements
	 * @var string
	 */
	const CLASS_FIRST = 'first';
	/**
	 * Valeur du class à définir pour le dernier élément d'une liste
	 * Defined a CSS class value for the last element of a list of elements
	 * @var string
	 */
	const CLASS_LAST = 'last';
	/**
	 * Indique si la valeur de l'élément HtmlTag est de type innerHtmlTag ou définie par l'attribut value
	 * Indicates whether the element can contain HTML tag or not
	 * @var bool
	 */
	private $hasInnerHtml;
	/**
	 * Objet de la clase DOMElement
	 * DOMElement Object representing the current HTML tag
	 * @var DOMElement
	 */
	private $domElement;
	/**
	 * Objet de la clase DOMDocument
	 * DOMDocument object representing the current document
	 * @var DOMDocument
	 */
	public static $domDocument;
	/**
	 * Objet de la clase Htmltag
	 * HtmlTag object representing the HTML document
	 * @var Htmltag
	 */
	public static $htmlDocument;
	/**
	 * Objet de la clase Htmltag représentant le body
	 * HtmlTag object representing the body element
	 * @var Htmltag
	 */
	public static $htmlBody;
	/**
	 * Objet de la clase Htmltag représentant le head
	 * HtmlTag object representing the head element
	 * @var Htmltag
	 */
	public static $htmlHead;
	/**
	 * Tabelau des id d'éléments déjà déclarés afin d'éviter tout doublons d'id
	 * ce qui rend la page invalide et pertube l'accès à l'élément par son id en JS
	 * Array containing all elements id attribute values in order to avoid double id declaration in a same document
	 * @var array
	 */
	private static $declaredIds = array();
	/**
	 * Tabelau des tag html valides
	 * Array containing all valid tag name
	 * @var array
	 */
	private static $validTagsName = array('a'=>'','abbr'=>'','acronym'=>'','address'=>'','area'=>'','b'=>'','base'=>'','bdo'=>'','big'=>'','blockquote'=>'','body'=>'','br'=>'','button'=>'','caption'=>'','cite'=>'','code'=>'','col'=>'','colgroup'=>'','dd'=>'','del'=>'','dfn'=>'','div'=>'','dl'=>'','DOCTYPE'=>'','dt'=>'','em'=>'','fieldset'=>'','font'=>'','form'=>'','h1'=>'','h2'=>'','h3'=>'','h4'=>'','h5'=>'','h6'=>'','head'=>'','html'=>'','hr'=>'','i'=>'','img'=>'','input'=>'','ins'=>'','kbd'=>'','label'=>'','legend'=>'','li'=>'','link'=>'','list'=>'','map'=>'','meta'=>'','noscript'=>'','object'=>'','ol'=>'','optgroup'=>'','option'=>'','p'=>'','param'=>'','pre'=>'','q'=>'','samp'=>'','script'=>'','select'=>'','small'=>'','span'=>'','strong'=>'','style'=>'','sub'=>'','sup'=>'','table'=>'','tbody'=>'','td'=>'','textarea'=>'','tfoot'=>'','th'=>'','thead'=>'','title'=>'','tr'=>'','tt'=>'','ul'=>'','var'=>'');
	/**
	 * Tabelau des attributs html valides
	 * Array containing all valid attributes and some specific
	 * @var array
	 */
	private static $validAttributesName = array('abbr'=>'','about'=>'','accesskey'=>'','action'=>'','archive'=>'','alt'=>'','autocomplete'=>'','axis'=>'','charset'=>'','checked'=>'','cite'=>'','class'=>'','cols'=>'','colspan'=>'','content-length'=>'','content'=>'','coords'=>'','datatype'=>'','datetime'=>'','declare'=>'','defaultAction'=>'','dir'=>'','disabled'=>'','edit'=>'','enctype'=>'','encoding'=>'','event'=>'','for'=>'','full'=>'','handler'=>'','headers'=>'','height'=>'','href'=>'','hreflang'=>'','hrefmedia'=>'','hreftype'=>'','http-equiv'=>'','id'=>'','ismap'=>'','key'=>'','label'=>'','layout'=>'','lang'=>'','media'=>'','method'=>'','name'=>'','nextfocus'=>'','observer'=>'','onblur'=>'','onchange'=>'','onclick'=>'','onfocus'=>'','onkeypress'=>'','onkeyup'=>'','onkeydown'=>'','onmousedown'=>'','onmousemove'=>'','onmouseover'=>'','onmouseout'=>'','onmouseup'=>'','onsubmit'=>'','phase'=>'','prevfocus'=>'','propagate'=>'','property'=>'','rel'=>'','repeat-bind'=>'','repeat-model'=>'','repeat-nodeset'=>'','repeat-number'=>'','repeat-startindex'=>'','rev'=>'','readonly'=>'','role'=>'','rows'=>'','rowspan'=>'','scope'=>'','selected'=>'','shape'=>'','span'=>'','src'=>'','srctype'=>'','style'=>'','tabindex'=>'','target'=>'','targetid'=>'','targetrole'=>'','title'=>'','type'=>'','usemap'=>'','value'=>'','valuetype'=>'','version'=>'','width'=>'','xmlns'=>'','xml:base'=>'','xml:id'=>'','xml:lang'=>'','xsi:schemaLocation'=>'');
	/**
	 * Constructeur de la classe / Class constructor
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
	 * @param string nom du tag HtmlTag de l'élément /tag name
	 * @param string lang du document / document language
	 * @param string encodage du document / document encoding
	 * @param string reset du domDocument / allows to reset the DOMDocument and the root HTML element 
	 * @return HtmlTag
	 */
	public function __construct($_tagName,$_lang = null,$_encoding = HtmlTag::DEFAULT_ENCODING,$_reset = false)
	{
		/**
		 * Initialisation dans tous les cas du DOMDocument
		 */
		if(!HtmlTag::$domDocument || $_reset)
		{
			/**
			 * Création du document général
			 * DOMDocument creation
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
			 * Root HTML element creation
			 */
			HtmlTag::$htmlDocument = new HtmlTag('html');
			HtmlTag::$htmlDocument->addAttribute('xml:lang',!empty($_lang)?trim($_lang):'fr',true);
		}
		/**
		 * Si le tag est valide
		 * Tag name is valid
		 */
		if(is_string($_tagName) && HtmlTag::tagIsValid($_tagName))
		{
			/**
			 * Définition du tag
			 */
			$this->setTagName(strtolower($_tagName));
			/**
			 * Définition de l'attribut id
			 * Id attribute value definition if enabled
			 */
			if(defined('HTML_TAG_DEFINE_ID') && HTML_TAG_DEFINE_ID === true)
				$this->setId('tag_' . $_tagName);
		}
	}
	/**
	 * Méthode permettant de charger un document à la place du DOMDocument par défaut.
	 * Cela a pour effet de supprimer tout ce qui aurait pu être créé jusque là !
	 * Method to load a DOMDocument from a existing file. Every objects create until here will be deleted
	 * 
	 * @uses HtmlTag::setHead()
	 * @uses HtmlTag::setBody()
	 * @uses HtmlTag::getHtmlTagFromDOMElement()
	 * @uses DOMDocument::loadXML()
	 * @uses DOMDocument::getElementsByTagName()
	 * @uses DOMNodeList::item()
	 * @uses DOMNode::hasAttributes()
	 * @uses DOMNamedNodeMap::item()
	 * @param string contenu du document / file content
	 * @param bool réinitialise tout le document / reset whole document
	 * @param string encodage du texte / text encoding
	 * @return bool true|false
	 */
	public static function loadDomDocument($_fileContent,$_resetDomDocument = false,$_encodingDocument = HtmlTag::DEFAULT_ENCODING)
	{
		if(trim($_fileContent) != '')
		{
			$fileContent = str_replace(array('&','&amp;amp;'),'&amp;',trim($_fileContent));
			if(strpos($fileContent,'<?xml') !== 0 && strpos($fileContent,'<?xml') <= 0)
				$fileContent = '<?xml version="1.0" encoding="' . $_encodingDocument . '"?>' . "\r\n" . $fileContent;
			if(!empty($fileContent))
			{
				$domDocument = new DOMDocument('1.0',$_encodingDocument);
				if($domDocument->loadXML($fileContent))
				{
					if($_resetDomDocument)
					{
						HtmlTag::$domDocument = null;
						HtmlTag::$htmlDocument = null;
						HtmlTag::$declaredIds = array();
						new HtmlTag('',null,$_encodingDocument);
					}
					/**
					 * Tentative de récupération de la partie head
					 * head element existing in the current file ?
					 */
					if($domDocument->getElementsByTagName('head') && ($head = HtmlTag::getHtmlTagFromDOMElement($domDocument->getElementsByTagName('head')->item(0),true)))
						HtmlTag::setHead($head);
					/**
					 * Tentative de récupération de la partie body
					 * body element existing in the current file ?
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
	 * Method to load a DOMDocument from a file by its path
	 * 
	 * @uses HtmlTag::loadDomDocument()
	 * @param string chemin complet d'accès au fichier / path to file
	 * @param bool réinitialise tout le document / reset whole document
	 * @param string encodage du texte / text encoding
	 * @return bool true|false
	 */
	public static function loadDomDocumentFile($_fileName,$_resetDomDocument = false,$_encodingDocument = HtmlTag::DEFAULT_ENCODING)
	{
		return is_file($_fileName)?HtmlTag::loadDomDocument(file_get_contents($_fileName),$_resetDomDocument,$_encodingDocument):false;
	}
	/**
	 * Méthode permettant de facilement créer une élément de type script/javascript
	 * Facility method to generate a script tag
	 *
	 * @uses HtmlTagScript::setSrc()
	 * @uses HtmlTagScript::setCharset()
	 * @uses HtmlTag::setValue()
	 * @uses HtmlTag::addAttributes()
	 * @uses HtmlTag::addValue()
	 * @param string l'url du fichier javascript à charger / JS File url
	 * @param array les attributs de l'élément / tag attributes
	 * @param HtmlTag l'élément auquel ajouté la balise script si nécessaire / existing element that will contain the script element crated
	 * @param string contenu de la balise script si nécessaire / JS code
	 * @param string le charset du contenu/script / charset value
	 * @return HtmlTag la balise script
	 */
	public static function createScript($_src = '',$_attributes = null,$_addtoHtml = null,$_content = '',$_charset = '')
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
	 * Facility method to generate a "css" tag
	 *
	 * @uses HtmlTagLink::setHref()
	 * @uses HtmlTagLink::setRel()
	 * @uses HtmlTag::setType()
	 * @uses HtmlTag::addAttributes()
	 * @uses HtmlTag::addValue()
	 * @param string l'url du fichier css à charger / CSS file url
	 * @param array les attributs de l'élément / tag attributes
	 * @param HtmlTag l'élément auquel ajouté la balise link si nécessaire / existing element that will contain the script element crated
	 * @return HtmlTag la balise link
	 */
	public static function createCssLink($_href,$_attributes = null,$_addtoHtml = null)
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
	 * Facility method to generate a "meta" tag
	 *
	 * @uses HtmlTagMeta::define()
	 * @uses HtmlTag::addAttributes()
	 * @uses HtmlTag::addValue()
	 * @param string nom identifiant le type de la meta / meta type name
	 * @param string valeur du type de la meta / meta type value
	 * @param string valeur de la meta / meta value
	 * @param array les attributs de l'élément / tag attributes
	 * @param HtmlTag l'élément auquel ajouté la balise link si nécessaire / existing element that will contain the script element crated
	 * @return HtmlTag la balise meta
	 */
	public static function createMeta($_type,$_typeName,$_value,$_attributes = null,$_addtoHtml = null)
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
	 * Facility method to generate a "title" tag
	 *
	 * @uses HtmlTag::setValue()
	 * @uses HtmlTag::addAttributes()
	 * @uses HtmlTag::addValue()
	 * @param string valeur du title / title value
	 * @param array les attributs de l'élément / tag attributes
	 * @param HtmlTag l'élément auquel ajouté la balise link si nécessaire / existing element that will contain the script element crated
	 * @return HtmlTag la balise meta
	 */
	public static function createTitle($_value,$_attributes = null,$_addtoHtml = null)
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
	 * Facility method to generate a "img" tag
	 *
	 * @uses HtmlTagImg::setSrc()
	 * @uses HtmlTagImg::setAlt()
	 * @uses HtmlTag::setTitle()
	 * @uses HtmlTag::addAttributes()
	 * @uses HtmlTag::addValue()
	 * @param string url de l'image / image url
	 * @param string alt de l'image / image alt value
	 * @param string title de l'image / image title value
	 * @param array les attributs de l'élément / tag attributes
	 * @param HtmlTag l'élément auquel ajouté la balise link si nécessaire / existing element that will contain the script element crated
	 * @return HtmlTag la balise meta
	 */
	public static function createImg($_src,$_alt,$_title = '',$_attributes = null,$_addtoHtml = null)
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
	 * Facility method to generate a "label" tag
	 *
	 * @uses HtmlTagLabel::setFor()
	 * @uses HtmlTag::setValue()
	 * @uses HtmlTag::addAttributes()
	 * @uses HtmlTag::addValue() 
	 * @param string titre du label / label value
	 * @param string id de l'élément auquel fait référence le label / for attribute value
	 * @param array les attributs de l'élément / tag attributes
	 * @param HtmlTag l'élément auquel ajouté la balise link si nécessaire / existing element that will contain the script element crated
	 * @return HtmlTag la balise label
	 */
	public static function createLabel($_label,$_for = '',$_attributes = null,$_addtoHtml = null)
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
	 * Méthode permettant de facilement créer une élément de type a
	 * Facility method to generate a "a" tag
	 *
	 * @uses HtmlTagA::setHref()
	 * @uses HtmlTag::setValue()
	 * @uses HtmlTag::addAttributes()
	 * @uses HtmlTag::addValue()
	 * @param string url / url
	 * @param string texte du lien anchor text
	 * @param array les attributs de l'élément / tag attributes
	 * @param HtmlTag l'élément auquel ajouté la balise link si nécessaire / existing element that will contain the script element crated
	 * @return HtmlTag la balise label
	 */
	public static function createA($_href,$_anchor,$_attributes = null,$_addtoHtml = null)
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
	 * Generic facility method to generate any html tag
	 *
	 * @uses HtmlTag::__className()
	 * @uses HtmlTag::getTagName()
	 * @uses HtmlTag::addAttributes()
	 * @uses HtmlTag::getDomElement()
	 * @uses HtmlTag::setValue()
	 * @param string nom du tag / tag name
	 * @param array attributs du tag / tag attributes
	 * @param string type de l'attribut (input, ul/ol, etc) / tag type
	 * @param HtmlTag* élément auquel ajouter le nouvel élément / existing element that will contain the script element crated
	 * @return HtmlTag|null
	 */
	public static function &createTag($_tagName,array $_tagAttributes = array(),$_tagType = null,$_addTagTo = null)
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
	 * Method to generate the current element HTML code
	 *
	 * @uses HtmlTag::getDomElement()
	 * @uses DOMDocument::saveXML()
	 * @param bool transmettre le header de type XML ou non / send header or not
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
	 * Method to generate the current element XML code
	 *
	 * @uses HtmlTag::toHtml()
	 * @param bool transmettre le header de type XML ou non / send header or not
	 * @return string le code HtmlTag
	 */
	public function toXml($_sendHeader = false)
	{
		if(HtmlTag::$domDocument)
		{
			if($_sendHeader && !headers_sent())
				header('Content-Type: application/xhtml+xml');
			return '<?xml version="1.0" encoding="' . HtmlTag::getEncoding() . '"?>' . "\r\n" . str_replace(array('&','&amp;amp;'),'&amp;',$this->toHtml(false));
		}
		else
			return '';
	}
	/**
	 * Méthode d'affichage de la page html compléte
	 * Methot to genrate the whole document HTML code
	 *
	 * @uses HtmlTag::addValue()
	 * @uses HtmlTag::getBody()
	 * @uses HtmlTag::getHead()
	 * @uses HtmlTag::getDomElement()
	 * @uses DOMDocument::appendChild()
	 * @uses DOMDocument::saveXML()
	 * @param bool transmettre le header de type XML ou non / send header or not
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
	 * Methot to genrate the whole document XML code
	 *
	 * @uses HtmlTag::displayFullHtml()
	 * @param bool transmettre le header de type XML ou non / send header or not
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
	 * Method to défine an attribute value for the current element
	 *
	 * @uses HtmlTag::attributeIsValid()
	 * @uses HtmlTag::getDomElement()
	 * @uses DOMElement::setAttribute()
	 * @param string valeur de l'attribut HtmlTag / attribute name
	 * @param mixed|HtmlTag valeur de l'élément HtmlTag / attribute value
	 * @param bool appel depuis une méthode de HtmlTag pour définir un attribut spécifique / defines if the calling method is the attribute method or not
	 * @return bool true|false selon la validité de l'attribut / depends of the validity of the attribute
	 */
	public function addAttribute($_attributeName,$_attributeValue,$_specificAttributeMethodCall = false)
	{
		/**
		 * Si nom de l'attribut valide et valeur de type chaine de caractères|tableau de valeurs
		 * If the attribute name is valid and the value also
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
						switch($_attributeName)
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
			 * Calling the attribute method if exist and if it's not this one which is calling the current method
			 */
			$setMethodName = 'set' . ucfirst($_attributeName);
			if(!$_specificAttributeMethodCall && method_exists($this,$setMethodName))
				return $this->$setMethodName($attributeValue);
			/**
			 * Sinon ajout de l'attribut à l'élément
			 */
			else
				return $this->getDomElement()->setAttribute($_attributeName,htmlentities($attributeValue,ENT_QUOTES,HtmlTag::getEncoding(),false));
		}
		else
			return false;
	}
	/**
	 * Alias to addAttribute()
	 * @see HtmlTag::addAttribute()
	 * 
	 * @param string valeur de l'attribut HtmlTag / attribute name
	 * @param mixed|HtmlTag valeur de l'élément HtmlTag / attribute value
	 * @return bool true|false selon la validité de l'attribut
	 */
	public function setAttribute($_attributeName,$_attributeValue)
	{
		return $this->addAttribute($_attributeName,$_attributeValue);
	}
	/**
	 * Méthode permettant de définir les attributs d'un élément HTML à partir d'un tableau
	 * Method to define attributes with an associative array of attribute names and values
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
					 * Calling the attribute method if exist and if it's not this one which is calling the current method
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
	 * Method to add attributes to the current element from a DOMElement object
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
	 * Method to get attribute value
	 *
	 * @uses HtmlTag::getDomElement()
	 * @uses DOMElement::getAttribute()
	 * @uses DOMElement::hasAttribute()
	 * @param string nom de l'attribut / attribute name
	 * @return string
	 */
	public function getAttribute($_attributeName)
	{
		return (is_string($_attributeName) && $this->getDomElement() && $this->getDomElement()->hasAttribute($_attributeName))?$this->getDomElement()->getAttribute($_attributeName):null;
	}
	/**
	 * Méthode permettant de supprimer un attribut de l'élément en cours
	 * Method to unset attribute
	 *
	 * @uses HtmlTag::getDomElement()
	 * @uses DOMElement::removeAttribute()
	 * @param string nom de l'attribut / attribute name
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
	 * @param string nom de l'attribut / attribute name
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
	 * Method to get the current element attributes
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
	 * Static method to get the attributes from a DOMElement object
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
				for($j = 0;;$j++)
				{
					if($attribute = $attributes->item($j))
						$domElementAttributes[$attribute->nodeName] = (HtmlTag::getEncoding() == HtmlTag::DEFAULT_ENCODING)?iconv('UTF-8',HtmlTag::DEFAULT_ENCODING,$attribute->nodeValue):$attribute->nodeValue;
					else
						break;
				}
			}
		}
		return $domElementAttributes;
	}
	/**
	 * Méthode de définition de l'objet DOMElement de l'objet en cours
	 * Method to set current DOMElement object
	 * 
	 * @param DOMElement
	 * @return DOMElement
	 */
	public function setDomElement(DOMElement $_domElement)
	{
		return ($this->domElement = $_domElement);
	}
	/**
	 * Méthode permettant de définir l'attribut 'id' de l'élément HtmlTag
	 * Method to set id attribute value and manage double id declarations
	 *
	 * @uses HtmlTag::addAttribute()
	 * @uses HtmlTag::getId()
	 * @param string l'id / id value
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
	 * Method to get id attribute value
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
	 * Method to unset id attribute value
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
	 * Method to set accesskey attribute value
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
	 * Method to get accesskey attribute value
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
	 * Method to unset accesskey attribute value
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
	 * Method to set tabindex attribute value
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
	 * Method to get tabindex attribute value
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
	 * Method to unset tabindex attribute value
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
	 * Method to set name attribute value
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
	 * Method to get name attribute value
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
	 * Method to unset name attribute value
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
	 * Method to set class attribute value
	 *
	 * @uses HtmlTag::getClass()
	 * @uses HtmlTag::addAttribute()
	 * @param string le class / class value(s)
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
		elseif(is_array($_class))
			return $this->addAttribute('class',$_class);
		else
			return false;
	}
	/**
	 * Méthode permettant de récupérer la valeur de l'attribut class définie
	 * Method to get class attribute value
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
	 * Method to unset class attribute value
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
	 * Method to set style attribute value
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
	 * Method to get style attribute value
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
	 * Method to unset style attribute value
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
	 * Method to set title attribute value
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
	 * Method to set title attribute value
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
	 * Method to unset title attribute value
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
	 * Method to set type attribute value
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
	 * Method to get type attribute value
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
	 * Method to unset type attribute value
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
	 * Method to set readonly attribute value
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
	 * Method to unset readonly attribute value
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
	 * Method to set disabled attribute value
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
	 * Method to unset disabled attribute value
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
	 * Specific method to set onclick attribute value with a specific js event function handler
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
	 * Specific method to set onchange attribute value with a specific js event function handler
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
	 * Specific method to set onsubmit attribute value with a specific js event function handler
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
	 * Specific method to set onmouseout attribute value with a specific js event function handler
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
	 * Specific method to set onmouseover attribute value with a specific js event function handler
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
	 * Specific method to set onkeyup attribute value with a specific js event function handler
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
	 * Specific method to set onkeydown attribute value with a specific js event function handler
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
	 * Specific method to set onfocus attribute value with a specific js event function handler
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
	 * Specific method to set onblur attribute value with a specific js event function handler
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
	 * Generic method to define the specific js event function handler
	 * 
	 * @uses HtmlTag::addAttribute()
	 * @param string nom de l'événement / event name
	 * @param string nom de la fonction de prise en charge de l'événement / js event function handler
	 * @return bool true|false
	 */
	private function setDomEventHandler($_domEvent,$_eventHandler)
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
		switch($_tagName)
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
	 * Method to get valid atribute name
	 * 
	 * @return array
	 */
	public static function getValidAttributesName()
	{
		return HtmlTag::$validAttributesName;
	}
	/**
	 * Méthode permettant de tester la validité d'un attribut
	 * Method to test the validity of the attribute name
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
	 * Method to add valid/specific attribute names
	 * 
	 * @param string nom de l'attribute
	 */
	protected function addValidAttribute($_attributeName)
	{
		return (is_string($_attributeName) && (HtmlTag::$validAttributesName[$_attributeName] = ''));
	}
	/**
	 * Retourne la liste des tags HTML valides
	 * Method to get valid tag names
	 * 
	 * @return array
	 */
	public static function getValidTagsName()
	{
		return HtmlTag::$validTagsName;
	}
	/**
	 * Méthode permettant de tester la validité d'un tag HTML
	 * Method to test the validity of the tag name
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
	 * Methode to set the value/add a value to the current element
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
	 * Méthode principale de gestion de l'ajout de contenu à l'objet en cours
	 * Main method to add content to the current element
	 * 
	 * @uses HtmlTag::getDomElement()
	 * @uses HtmlTag::getValueAttribute()
	 * @uses HtmlTag::addAttribute()
	 * @uses HtmlTag::setValue()
	 * @uses DOMDocument::createElement()
	 * @uses DOMDocument::createTextNode()
	 * @uses DOMNode::appendChild()
	 * @param mixed|HtmlTag
	 * @param bool indique s'il faut ou non encoder les données / indicates if the data has to be html encoded
	 * @return bool
	 */
	protected function _setValue($_value,$_encodeHtmlEntities = true)
	{
		try
		{
			if(is_scalar($_value) && $this->getValueAttribute() != '')
				$this->addAttribute($this->getValueAttribute(),$_encodeHtmlEntities?htmlentities($_value,ENT_QUOTES,HtmlTag::getEncoding(),false):$_value,true);
			elseif(is_scalar($_value) && !empty($_value) && $this->getHasInnerHtml() && $this->getDomElement())
				$this->getDomElement()->appendChild(HtmlTag::$domDocument->createTextNode($_encodeHtmlEntities?htmlentities($_value === ' '?'&nbsp;':$_value,ENT_QUOTES,HtmlTag::getEncoding(),false):$_value));
			elseif(($_value instanceof HtmlTag) && $this->getDomElement())
				$this->getDomElement()->appendChild($_value->getDomElement());
			elseif(($_value instanceof DOMComment) && $this->getDomElement())
				$this->getDomElement()->appendChild(new DOMComment($_value->data));
			elseif(($_value instanceof DOMText) && $this->getDomElement())
				$this->_setValue(HtmlTag::getEncoding() == HtmlTag::DEFAULT_ENCODING?iconv('UTF-8',HtmlTag::DEFAULT_ENCODING,$_value->wholeText):$_value->wholeText);
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
	 * Method to add content to the current element
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
	 * Method to add HTML code to the current element
	 * 
	 * @uses DOMDocument::loadXML()
	 * @uses HtmlTag::addChildren()
	 * @param string code html / HTML code
	 * @return bool
	 */
	public function addHtml($_html)
	{
		if(!is_string($_html) || empty($_html))
			return false;
		$d = new DOMDocument('1.0',HtmlTag::getEncoding());
		/**
		 * Suppression de tout espace de dbut et de fin
		 */
		$html = str_replace(array('&','&amp;amp;'),'&amp;',trim($_html));
		/**
		 * On s'assure d'avoir un code commençant par <?xml ...
		 */
		if(strpos($html,'<?xml') !== 0 && strpos($html,'<?xml') <= 0)
			$html = '<?xml version="1.0" encoding="' . HtmlTag::getEncoding() . '"?>' . "\r\n" . $html;
		if($d->loadXML($html))
			return $this->addChildren($d);
		else
			return false;
	}
	/**
	 * Méthode permettant de charger un fichier HTML
	 * Method to add HTML code from a file
	 * 
	 * @uses HtmlTag::addHtml()
	 * @param string chemin d'accès au fichier / path to the file
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
	 * @param String source HTML / HTML code
	 * @return bool true|false
	 */
	public function loadHtml($_html)
	{
		if(!is_string($_html) || empty($_html))
			return false;
		$d = new DOMDocument('1.0',HtmlTag::getEncoding());
		/**
		 * Suppression de tout espace de dbut et de fin
		 */
		$html = str_replace(array('&','&amp;amp;'),'&amp;',trim($_html));
		/**
		 * On s'assure d'avoir un code commençant par <?xml ...
		 */
		if(strpos($html,'<?xml') !== 0 && strpos($html,'<?xml') <= 0)
			$html = '<?xml version="1.0" encoding="' . HtmlTag::getEncoding() . '"?>' . "\r\n" . $html;
		if($d->loadXML($html))
		{
			if($d->hasChildNodes())
			{
				/**
				 * Recherche du premier noeud correct dans le cas de commentaires en début de template
				 * Find the first valid tag
				 */
				$item = 0;
				while(!($d->childNodes->item($item) instanceof DOMElement))
					$item++;
				/**
				 * Si un noeud est trouvé
				 * If a valid node is found
				 */
				if($d->childNodes->item($item) instanceof DOMElement)
				{
					$domElement = $d->childNodes->item($item);
					if(HtmlTag::tagIsValid($domElement->tagName))
					{
						/**
						 * Définition du tag de l'objet en cours
						 * Defining the current tag name
						 */
						$this->setTagName($domElement->tagName);
						/**
						 * Ajout des attributs
						 * Defining the current tag attributes
						 */
						$this->addDOMElementAttributes($domElement);
						/**
						 * Ajout des enfants
						 * Adding the childnodes
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
	 * Method to add HTML code from a file
	 * 
	 * @uses HtmlTag::loadHtml()
	 * @param string chemin complet d'accès au fichier / path to file
	 * @return bool true|false
	 */
	public function loadHtmlFromFile($_fileName)
	{
		return is_file($_fileName)?$this->loadHtml(file_get_contents($_fileName)):false;
	}
	/**
	 * Méthode utilisée pour récupérer le contenu HTML d'un objet de type DOMNode
	 * et de l'ajouter proprement à l'objet en cours
	 * Method used to add the chilnodes of a DOMNode to current element recursively
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
			for($i = 0;$i < $nbChildNodes;$i++)
			{
				$child = $childNodes->item($i);
				/**
				 * Si le noeud est un tag HTML reconnu
				 * If the current node represents a known HTML tag
				 */
				if(($child instanceof DOMElement) && ($tag = HtmlTag::getHtmlTagFromDOMElement($child,true,false)))
					$this->setValue($tag);
				/**
				 * Sinon si le noeud est un commentaire
				 * Otherwise the current node is a comment
				 */
				elseif(HTML_TAG_KEEP_COMMENTS == true && ($child instanceof DOMComment) && trim($child->data) != '')
					$this->setValue($child);
				/**
				 * Sinon si le noeud est un texte non vide
				 * Otherwise the current node is a text part not empty
				 */
				elseif(($child instanceof DOMText) && trim($child->wholeText) != '')
					$this->setValue($child);
			}
			return true;
		}
		else
			return false;
	}
	/**
	 * Méthode permettant de supprimer un élément par son id ou un attribut et sa valeur définie
	 * Method to delete an element
	 *
	 * @uses HtmlTag::getDomElement()
	 * @uses DOMElement::getAttribute()
	 * @uses DOMElement::hasAttribute()
	 * @uses DOMElement::removeChild()
	 * @uses DOMElement::item()
	 * @param string valeur de l'attribut (id par défaut) / attribute value (id attribute by default)
	 * @param string l'id de l'élément / attribute name to search by (id attribute by default)
	 * @return bool true|false
	 */
	public function delValue($_attributeValue,$_attributeName = 'id')
	{
		if($this->getDomElement() && $this->getDomElement()->childNodes->length > 0)
		{
			$childNodes = $this->getDomElement()->childNodes;
			$nbChildNodes = $childNodes->length;
			$delete = true;
			for($i = 0;$i < $nbChildNodes;$i++)
			{
				if($childNodes->item($i) && $childNodes->item($i)->hasAttribute($_attributeName) && $childNodes->item($i)->getAttribute($_attributeName) == $_attributeValue)
				{
					$delete &= $this->getDomElement()->removeChild($childNodes->item($i))?true:false;
					/**
					 * Lors de la suppression, le nombre d'enfants diminue d'1, de ce fait,
					 * le pointeur $i pointe sur l'objet suivant n'existant plus, on le décrémente
					 * Decremeting the pointer as the number of children has been decreased by one due to the removeChild call
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
	 * Method to set body element
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
	 * Method to get body element
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
	 * Method to add element to the body element
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
	 * Method to set head element
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
	 * Method to get head element
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
	 * Method to add element to the head element
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
	 * Method to get the current DOMDocument
	 * 
	 * @return DOMDocument
	 */
	public static function getDomDocument()
	{
		return HtmlTag::$domDocument;
	}
	/**
	 * Méthode retournant l'encodage du document en cours
	 * Méthod to get current document encoding
	 * 
	 * @uses HtmlTag::getDomDocument()
	 * @return string
	 */
	public static function getEncoding()
	{
		return HtmlTag::getDomDocument()?HtmlTag::getDomDocument()->encoding:HtmlTag::DEFAULT_ENCODING;
	}
	/**
	 * Méthode permettant de récupérer un objet de la classe HtmlTag par son id
	 * représentant un élément existant dans le document en cours
	 * Method to get an HtmlTag object by its id attribute value in the whole document
	 * 
	 * @uses HtmlTag::getDomElement()
	 * @uses HtmlTag::getHead()
	 * @uses HtmlTag::getBody()
	 * @uses HtmlTag::findElementBy()
	 * @uses HtmlTag::getHtmlTagFromDOMElement()
	 * @param string id de l'élément HTML / id attribute value
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
	 * Method to get an HtmlTag object by its id attribute value contained by the current element
	 * 
	 * @uses HtmlTag::getDomElement()
	 * @uses HtmlTag::findElementBy()
	 * @uses HtmlTag::getHtmlTagFromDOMElement()
	 * @param string la valeur de l'attribut id de l'élément / id attribute value
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
	 * Method to create a HtmlTag from a DOMElement
	 * 
	 * @uses HtmlTag::createTag()
	 * @uses HtmlTag::setDomElement()
	 * @uses HtmlTag::addChildren()
	 * @uses HtmlTag::getDomElementAttributes()
	 * @param DOMElement DOMElement to use
	 * @param bool force l'ajout des enfants du noeud / enables the addition of the DOMElement children to the created tag
	 * @param bool force la redéfinition de l'attribut DomElement de l'objet créé / force the DOMElement object to the created element with the one passed in parameter
	 * @return HtmlTag
	 */
	public static function getHtmlTagFromDOMElement(DOMElement $_domElement,$_addChildren = false,$_setDomElement = true)
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
	 * Method to find an element by its id attribute value or any other attribute 
	 * 
	 * @uses HtmlTag::findElementBy()
	 * @uses HtmlTag::getHtmlTagFromDOMElement()
	 * @uses DomNode::hasAttribute()
	 * @uses DomNode::getAttribute()
	 * @uses DOMElement::hasChildNodes()
	 * @uses DOMNamedNodeMap::item()
	 * @uses DOMNodeList::item()
	 * @param DOMElement the DOMElement
	 * @param string valeur de l'attribute de l'élément recherché / attribute value to search
	 * @param string nom de l'attribut / attribute value to search by
	 * @param bool|array si tableau=>va contenir tous les éléments répondant au critère / reference to the array which will contain all the results
	 * @return DOMElement|array array of HtmlTag or DOMElement
	 */
	public static function findElementBy(DOMElement $_domElement,$_value = '*',$_attributeName = 'id',&$_multiples = false)
	{
		if($_domElement->hasChildNodes())
		{
			$childNodes = $_domElement->childNodes;
			$nbChildNodes = $childNodes->length;
			$forMultiples = is_array($_multiples);
			if($nbChildNodes)
			{
				for($i = 0;$i < $nbChildNodes;$i++)
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
	 * Method to know if the element has a specific attribute to contain its value or not 
	 *
	 * @uses HtmlTag::getTagName()
	 * @return string
	 */
	private function getValueAttribute()
	{
		$valueAttribute = '';
		switch($this->getTagName())
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
	 * Method to get tag name
	 *
	 * @return string html
	 */
	public static function __tagName()
	{
		return 'html';
	}
	/**
	 * Méthode retournant l'objet au format string
	 * Method returning the string reprentation of the current object
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
		{}
		return '';
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