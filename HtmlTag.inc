<?php
/**
 * @package Common
 * @subpackage HtmlTag
 * @author Mikaël DELSOL
 * @copyright Mikaël DELSOL
 * @version 1.0
 * @date 11/12/2009
 */
/**
 * Racine du dossier contenant les classes HtmlTag
 * Root folder constant of HtmlTag classes package
 */
define('ROOT_PATH',realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR);
/**
 * Chemin d'accès au dossier du module HTML
 * Path to HtmlTag folder
 */
define('HTML_TAG_PATH',ROOT_PATH . 'htmltag' . DIRECTORY_SEPARATOR);
/**
 * Chemin d'accès au dossier PHP du module HTML
 * Path to Htmltag PHP classes
 */
define('HTML_TAG_PHP_PATH',HTML_TAG_PATH . 'PHP' . DIRECTORY_SEPARATOR);
/**
 * Force la définition des id sur tout élément HTML généré
 * Enables the definition of the attribute named "id" for every htmltag and avoid double ids 
 */
define('HTML_TAG_DEFINE_ID',false);
/**
 * Force la non suppression des commentaires de templates
 * Enables the fact to keep comments in templates 
 */
define('HTML_TAG_KEEP_COMMENTS',true);
?>