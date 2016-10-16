<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

namespace ObjectivePHP\Html\Form\Element\Input;


use ObjectivePHP\Html\Form\Element\ElementInterface;
use ObjectivePHP\Html\Form\Renderer\RenderableInterface;
use ObjectivePHP\Notification\Stack;
use ObjectivePHP\Html\Tag\Attributes\AttributesProvider;

interface InputInterface extends RenderableInterface, AttributesProvider
{
    public function setName($name) : InputInterface;
    
    public function getName();
    
    public function setId($id) : InputInterface;
    
    public function getId();
    
    public function setValue($value) : InputInterface;
    
    public function getValue();
    
    public function setDefaultValue($defaultValue) : InputInterface;
    
    public function getDefaultValue();
    
    public function getMessages() : Stack;
    
    public function validate() : Stack;
    
    public function setElement(ElementInterface $element);
    
    public function getElement() : ElementInterface;
}
