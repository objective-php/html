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
use ObjectivePHP\Html\Form\Element\Input\InputInterface;
use ObjectivePHP\Html\Form\Element\Label\Label;
use ObjectivePHP\Html\Form\Element\Label\LabelInterface;
use ObjectivePHP\Html\Form\Element\Select;
use ObjectivePHP\Html\Form\Element\Submit;
use ObjectivePHP\Html\Form\Element\Text;
use ObjectivePHP\Html\Form\Form;
use ObjectivePHP\Html\Form\FormInterface;
use ObjectivePHP\Html\Tag\Input\Input;
use ObjectivePHP\Html\Tag\Tag;

require dirname(__DIR__) . '/vendor/autoload.php';


class MyForm extends Form
{
    /**
     *
     */
    protected function init()
    {
        $this->setName('myForm');
        
        // add name field
        $text = (new Text('name', 'Username'))->attr('class', 'toto');
        $text->getInput()->attr('class', 'titi');
        $text->getLabel()->setPlacement(Label::BEFORE)->attr('class', 'test');

        // replace default label rendering for Text element
        $text->getLabel()->setRenderer([$this, 'nameLabelRenderer']);
        $this->addElement($text);
    
        
        $select = new Select('list', 'Make a choice', ['first' => 'first', 'second' => 'second', 'third' => 'third']);
        $select->setDescription(new Description('Please note that first come before second and, of course, third come last.'));
        $this->addElement($select);
        
        // add submit button
        $submit = (new Submit('submit', 'Send'));
        $submit->getInput()->addClass('submit-button')->attr('test', 'value')->data('test', 'data-value');
        $this->addElement($submit);
        
        // customize form itself
        $this->attr('class', 'my-form-class');
        
    }
    
    public function nameLabelRenderer(LabelInterface $label)
    {
        return $label->getText();
    }
}

$form = new MyForm();

echo $form;

Tag::br();
Tag::a('back', '/');
