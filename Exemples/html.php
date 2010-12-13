<?php
/**
 * Chargement des classes
 */
require_once realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'autoload.inc');
$t = new HtmlTagTable();
$t->setCaption(HtmlTag::createTag('caption',array('id'=>'caption','value'=>'Caption du tableau')));
$thead = new HtmlTagThead();
$thead->setId('thead');
for($i = 0; $i < 1; $i++)
{
	$tr = new HtmlTagTr();
	$tr->setId('tr_head_' . $i);
	$tr->createCell('Contenu de la cellule du head de la ligne n°' . $i,array('id'=>'th_head_' . $i,'title'=>'Cellule n°' . $i),HtmlTagTableCell::TH);
	$thead->addValue($tr);
}
$t->setThead($thead);
$tbody = new HtmlTagTfoot();
$tbody->setId('tfoot');
for($i = 0; $i < 5; $i++)
{
	$tr = new HtmlTagTr();
	$tr->setId('tr_foot_' . $i);
	$tr->createCell('Contenu de la cellule du footer de la ligne n°' . $i,array('id'=>'td_foot_' . $i,'title'=>'Cellule n°' . $i),HtmlTagTableCell::TH);
	$tbody->addValue($tr);
}
$t->setTfoot($tbody);
$tbody = new HtmlTagTbody();
$tbody->setId('tbody');
for($i = 0; $i < 5; $i++)
{
	$tr = new HtmlTagTr();
	$tr->setId('tr_body_' . $i);
	$tr->createCell('Contenu de la cellule du body de la ligne n°' . $i,array('id'=>'td_body_' . $i,'title'=>'Cellule n°' . $i),HtmlTagTableCell::TH);
	$tbody->addValue($tr);
}
$t->setTbody($tbody);
HtmlTag::getBody()->addValue($t);
/**
 * Code complet de la page
 */
HtmlTag::createTitle('Titre de la page',null,HtmlTag::getHead());
echo HtmlTag::displayFullHtml(true);
?>