<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

namespace ObjectivePHP\Html\Form\Example;

use ObjectivePHP\Html\Css;
use ObjectivePHP\Html\Form\Element\Description\Description;
use ObjectivePHP\Html\Form\Element\Label\LabelInterface;
use ObjectivePHP\Html\Form\Element\Select;
use ObjectivePHP\Html\Form\Element\Submit;
use ObjectivePHP\Html\Form\Element\Text;
use ObjectivePHP\Html\Form\Form;
use ObjectivePHP\Html\Tag\Tag;

require dirname(__DIR__) . '/vendor/autoload.php';


class MyForm extends Form
{
    public function nameLabelRenderer(LabelInterface $label)
    {
        return $label->getText();
    }

    /**
     *
     */
    protected function init()
    {
        $this->setName('myForm');

        // add name field
        $text = (new Text('name', 'Username'))->attr('class', 'toto');
        $text->getInput()->attr('class', 'titi');
        $text->setDescription(new Description('This is the text field description'));
        //$text->getLabel()->setPlacement(Label::BEFORE)->attr('class', 'test');
        $text->setRequired();
        $this->addElement($text);


        $select = new Select('list', 'Make a choice', ['first' => 'first', 'second' => 'second', 'third' => 'third']);
        $select->setDescription(new Description('Please note that first come before second and, of course, third come last.'));
        // replace default label rendering for Text element
        $select->getLabel()->setPlacement(LabelInterface::BEFORE)->setRenderer([$this, 'nameLabelRenderer']);

        $this->addElement($select);

        // add submit button
        $submit = (new Submit('submit', 'Send'));
        $submit->getInput()->addClass('submit-button')->attr('test', 'value')->data('test', 'data-value');
        $this->addElement($submit);

        // customize form itself
        $this->attr('class', 'my-form-class');

    }
}

$form = new MyForm();

echo $form->render();
Css::embed('/css/styles.css');
Css::dump();
Tag::br();
Tag::a('back', '/');
