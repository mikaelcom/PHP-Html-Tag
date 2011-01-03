<?php
/**
 * Classe mère de gestion de templates à l'aide de la classe HtmlTag.
 * Elle permet de charger un fichier de template HTML/XML et d'en remplacer les valeurs dynamiques
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 01/12/2010
 */
/**
 * Classe mère de gestion de templates à l'aide de la classe HtmlTag.
 * Elle permet de charger un fichier de template HTML/XML et d'en remplacer les valeurs dynamiques
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 01/12/2010
 */
class HtmlTagTpl extends HtmlTag
{
	/**
	 * Tableau des variables du template
	 * @var array
	 */
	private $variables;
	/**
	 * Constructeur de la classe / Class constructor
	 * @see parent::__construct()
	 * 
	 * @uses HtmlTagTpl::setVariables()
	 * @uses HtmlTagTpl::getVariables()
	 * @param string nom du tag HTML principale de l'objet en cours / tag name (OPTIONAL)
	 * @return HtmlTagP
	 */
	public function __construct($_tagName = '')
	{
		parent::__construct($_tagName);
		/**
		 * Non redéfinition des variables si déjà définies
		 */
		if(!is_array($this->getVariables()))
			$this->setVariables();
	}
	/**
	 * Méthode de génération du contenu HTML avec remplacement des variables par leur valeur
	 * Method to call when all variables have been set
	 * 
	 * @uses HtmlTagTpl::getVariablesKeys()
	 * @uses HtmlTagTpl::getVariablesValues()
	 * @uses HtmlTag::displayFullHtml()
	 * @uses HtmlTag::loadHtml()
	 * @uses HtmlTag::loadDomDocument()
	 * @uses HtmlTag::toHtml()
	 * @return string|null
	 */
	public function fetch($_fileName = '')
	{
		if((!empty($_fileName) && is_file($_fileName)) || empty($_fileName))
		{
			$content = !empty($_fileName)?file_get_contents($_fileName):HtmlTag::displayFullHtml(false);
			$s = microtime(true);
			if(trim($content) != '')
			{
				/**
				 * Récupération des valeurs
				 */
				$keys = $this->getVariablesKeys();
				$values = $this->getVariablesValues();
				/**
				 * Gestion du cas particulier d'un objet du fait de la non reconnaissance des tags
				 * si un contenu HTML est ajouté tel quel
				 */
				foreach($values as $key=>$value)
				{
					if($value instanceof HtmlTag)
						$values[$key] = "\r\n" . $value->toHtml(false) . "\r\n";
				}
				/**
				 * Mise à jour du contenu
				 */
				$content = str_ireplace($keys,$values,$content);
				/**
				 * Chargement du contenu dans l'objet en cours
				 */
				if(!empty($_fileName))
					$this->loadHtml($content);
				else
					HtmlTag::loadDomDocument($content,true);
			}
			return $this->toHtml() . "\r\n" . '<!-- Fetch Time : ' . round(microtime(true) - $s,5) . ' sec. -->';
		}
		else
			return null;
	}
	/**
	 * @return array
	 */
	public function getVariables()
	{
		return $this->variables;
	}
	/**
	 * Retourne toutes les clefs
	 * Method to get all variable keys
	 * 
	 * @uses HtmlTagTpl::getVariables()
	 * @return array
	 */
	public function getVariablesKeys()
	{
		return array_keys($this->getVariables());
	}
	/**
	 * Retourne toutes les valeurs
	 * Method to get all variable values
	 * 
	 * @uses HtmlTagTpl::getVariables()
	 * @return array
	 */
	public function getVariablesValues()
	{
		return array_values($this->getVariables());
	}
	/**
	 * Méthode pour définir les variables d'un coup
	 * Method to set at once all the variables
	 * 
	 * @param array
	 * @return array
	 */
	public function setVariables(array $_variables = array())
	{
		return ($this->variables = $_variables);
	}
	/**
	 * Méthode permettant de supprimer toutes les variables déjà définies
	 * Method to unset all variables
	 * 
	 * @uses HtmlTagTpl::setVariables()
	 * @param array
	 * @return array
	 */
	public function emptyVariables()
	{
		return $this->setVariables();
	}
	/**
	 * Méthode permettant de définir la valeur d'une variable
	 * L'ajout des sauts de ligne \r\n permet lors d'ajout de contenu d'un autre template dans un nouveau template d'être considéré
	 * comme un contenu à part entière contenant également des balises
	 * Method to add one variable to the variables
	 * 
	 * @param string nom de la variable / variable name
	 * @param mixed valeur de la variable / variable value
	 * @param bool indique qu'il faut ou non ajouter les accolades {} en début et fin de nom de variable / add brackets ({ and}) automatically and the begginning and the end of the variable name
	 * @return mixed
	 */
	public function setVariable($_name, $_value, $_addBrackets = true)
	{
		return ($this->variables[($_addBrackets?'{':'') . $_name . ($_addBrackets?'}':'')] = $_value);
	}
	/**
	 * Méthode permettant d'ajouter un ensemble de clef associées à leur valeur
	 * Method to add an array of vairables at once to the current variables
	 * 
	 * @uses HtmlTagTpl::setVariable()
	 * @param array name=>valuemixed valeur de la variable / associative array of variable names and variables values
	 * @param bool indique qu'il faut ou non ajouter les accolades {} en début et fin de nom de variable / add brackets ({ and}) automatically and the begginning and the end of each variables name
	 * @return bool true
	 */
	public function setVariablesArray(array $_variables, $_addBrackets = true)
	{
		foreach($_variables as $name=>$value)
			$this->setVariable($name,$value,$_addBrackets);
		return true;
	}
	/**
	 * Méthode permettant de récupérer la valeur d'une variable
	 * Method to get a variable value
	 * 
	 * @uses HtmlTagTpl::hasVariable()
	 * @param string nom de la variable / variable name
	 * @param bool indique qu'il faut ou non ajouter les accolades {} en début et fin de nom de variable / add brackets ({ and}) automatically and the begginning and the end of each variables name
	 * @return mixed|null
	 */
	public function getVariable($_name, $_addBrackets = true)
	{
		return $this->hasVariable($_name,$_addBrackets)?$this->variables[($_addBrackets?'{':'') . $_name . ($_addBrackets?'}':'')]:null;
	}
	/**
	 * Méthode permettant de tester l'existence d'une variable
	 * Method to test the variable presence
	 * 
	 * @uses HtmlTagTpl::getVariables()
	 * @param string nom de la variable / variable name
	 * @param bool indique qu'il faut ou non ajouter les accolades {} en début et fin de nom de variable / add brackets ({ and}) automatically and the begginning and the end of each variables name
	 * @return mixed|null
	 */
	public function hasVariable($_name, $_addBrackets = true)
	{
		return array_key_exists(($_addBrackets?'{':'') . $_name . ($_addBrackets?'}':''),$this->getVariables());
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