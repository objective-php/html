<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

namespace ObjectivePHP\Html\Form\Example;

use ObjectivePHP\Html\Form\Element\Description\Description;
use ObjectivePHP\Html\Form\Element\Description\DescriptionInterface;
use ObjectivePHP\Html\Form\Element\Label\Label;
use ObjectivePHP\Html\Form\Element\Label\LabelInterface;
use ObjectivePHP\Html\Form\Element\Text;
use ObjectivePHP\Html\Form\Form;
use ObjectivePHP\Html\Tag\Tag;

require dirname(__DIR__) . '/vendor/autoload.php';

$form = new Form('test');
$text = (new Text('name', 'Your name'))->attr('class', 'toto');
$text->getInput()->attr('class', 'titi');
$text->getLabel()->setPlacement(Label::BEFORE)->attr('class', 'test');
$text->setDescription(new Description('Don\'t worry, you have this helpful description.'));


// replace default label rendering
$text->getLabel()->setRenderer(function(LabelInterface $label) {
   return $label->getText();
});

// replace default description rendering
$text->getDescription()->setRenderer(function(DescriptionInterface $description) {
   return Tag::pre($description->getText());
});

$form->addElement($text);
$form->attr('class', 'form-class');



echo $form;

Tag::br();
Tag::a('back', '/');
