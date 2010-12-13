<?php
/**
 * Chargement des classes
 */
require_once realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'autoload.inc');
/**
 * Chargement du document complet représentant le template principale
 */
HtmlTag::loadDomDocumentFile(realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'tpl.html'));
/**
 * Instance du gestionnaire de template
 * @var HtmlTagTpl
 */
$tpl = new HtmlTagTpl();
/**
 * Définition des variables
 */
$tpl->setVariablesArray(array('label_value'=>'Label du champ','label_title'=>'Renseigner le champ texte'));
$tpl->setVariable('input_value','Valeur par défaut du champ texte');
$tpl->setVariable('submit_value','&nbsp;Soumettre le formulaire&nbsp;');
/**
 * Génération du code HTML du formulaire
 * @var string
 */
$formContent = $tpl->fetch(realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'form.html'));
/**
 * Instance du gestionnaire de template
 * @var HtmlTagTpl
 */
$tpl = new HtmlTagTpl();
/**
 * Définition des variables
 */
$tpl->setVariable('page_title','Page d\'exemple');
/**
 * Définition du contnu généré pour le formulaire
 */
$tpl->setVariable('form_content',$formContent);
/**
 * Génération du code HTML dynamisé avec le formulaire
 */
$tpl->fetch();
/**
 * Génération du code HTML complet
 */
echo HtmlTag::displayFullHtml(true);
?>