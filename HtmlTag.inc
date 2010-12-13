<?php
/**
 * @package Niouseo
 * @subpackage NiouseoHtmlTag
 * @author Mika�l DELSOL
 * @copyright Mika�l DELSOL
 * @version 1.0
 * @date 11/12/2009
 */
/**
 * Racine du dossier contenant les classes HtmlTag
 */
define('ROOT_PATH',realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR);
/**
 * Chemin d'acc�s au dossier du module HTML
 */
define('HTML_TAG_PATH',ROOT_PATH . 'HtmlTag' . DIRECTORY_SEPARATOR);
/**
 * Chemin d'acc�s au dossier PHP du module HTML
 */
define('HTML_TAG_PHP_PATH',HTML_TAG_PATH . 'PHP' . DIRECTORY_SEPARATOR);
/**
 * Force la d�finition des id sur tout �l�ment HTML g�n�r�
 */
define('HTML_TAG_DEFINE_ID',false);
?>