<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

namespace ObjectivePHP\Html\Form;


use ObjectivePHP\Html\Form\Renderer\RenderableInterface;
use ObjectivePHP\Html\Form\Element\ElementInterface;
use ObjectivePHP\Html\Tag\Attributes\Attributes;
use ObjectivePHP\Notification\Stack;
use ObjectivePHP\Primitives\Collection\Collection;

interface FormInterface extends RenderableInterface
{
    public function setAction(string $action) : FormInterface;
    
    public function getAction() : string;
    
    public function setAttributes(Attributes $attributes);
    
    public function getAttributes() : Attributes;
    
    public function addElement(ElementInterface $element);
    
    public function getElements() : Collection;
    
    public function setValues($values) : FormInterface;
    
    public function getValues() : array;
    
    public function setDefaultValues($defaultValues) : FormInterface;
    
    public function getDefaultValues() : array;
    
    public function getMessages() : Stack;
    
    public function validate() : Stack;
}
