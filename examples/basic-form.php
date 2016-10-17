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
use ObjectivePHP\Html\Form\Element\Label\Label;
use ObjectivePHP\Html\Form\Element\Text;
use ObjectivePHP\Html\Form\Form;
use ObjectivePHP\Html\Tag\Input\Input;
use ObjectivePHP\Html\Tag\Tag;

require dirname(__DIR__) . '/vendor/autoload.php';

$form = new Form('test');
$text = (new Text('name', 'Name'))->attr('class', 'toto');
$text->getInput()->attr('class', 'titi');
$text->getLabel()->setPlacement(Label::BEFORE)->attr('class', 'test');
$text->setDescription(new Description('Please enter your first name and last name.'));
$form->addElement($text);

$form->attr('class', 'form-class');
echo $form;

Tag::br();
Tag::a('back', '/');
