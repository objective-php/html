<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

namespace ObjectivePHP\Html\Form\Element;


use ObjectivePHP\Html\Form\Renderer\RenderableInterface;
use ObjectivePHP\Html\Form\Element\Input\InputInterface;
use ObjectivePHP\Html\Form\Element\Label\LabelInterface;
use ObjectivePHP\Html\Tag\Attributes\Attributes;
use ObjectivePHP\Notification\Stack;

interface ElementInterface extends RenderableInterface
{
    public function getId() : string;
    
    public function setId(string $id);
    
    public function setInput(InputInterface $input) : ElementInterface;
    
    public function getInput() : InputInterface;
    
    public function setLabel(LabelInterface $label) : ElementInterface;
    
    public function getLabel() : LabelInterface;
    
    public function setValue($value) : ElementInterface;
    
    public function getValue();
    
    public function setDefaultValue($defaultValue) : ElementInterface;
    
    public function getDefaultValue();
    
    public function getMessages() : Stack;
    
    public function validate() : Stack;
    
    public function getAttributes() : Attributes;
}
