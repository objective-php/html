<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

namespace ObjectivePHP\Html\Form\Example;

use ObjectivePHP\Html\Form\Element\Text;
use ObjectivePHP\Html\Form\Form;
use ObjectivePHP\Html\Tag\Input\Input;

require '../vendor/autoload.php';

$form = new Form('test');
$text = (new Text('name', 'Saisir votre nom'))->attr('class', 'toto');
//$text->getInput()->attr('class', 'titi');
$form->addElement($text);
echo $form;
