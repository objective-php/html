<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

namespace ObjectivePHP\Html\Form;


use ObjectivePHP\Html\Form\Element\ElementInterface;
use ObjectivePHP\Html\Form\Renderer\FormRenderingHandler;
use ObjectivePHP\Html\Tag\Attributes\AttributesHandler;
use ObjectivePHP\Notification\Stack;
use ObjectivePHP\Primitives\Collection\Collection;

class Form implements FormInterface
{
    use FormRenderingHandler;
    use AttributesHandler;
    use ValidationHandler;
    
    protected $name;
    
    protected $elements;
    
    protected $action = '';
    
    public function __construct($name)
    {
        $this->setName($name);
        
        $this->elements = (new Collection())->restrictTo(ElementInterface::class);
    }
    
    /**
     * @return mixed
     */
    public function getAction() : string
    {
        return $this->action;
    }
    
    /**
     * @param mixed $action
     *
     * @return $this
     */
    public function setAction(string $action) : FormInterface
    {
        $this->action = $action;
        
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * @param mixed $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        
        return $this;
    }
    
    
    public function addElement(ElementInterface $element)
    {
        $this->getElements()->add($element);
    }
    
    public function getElements() : Collection
    {
        return $this->elements;
    }
    
    public function setValues($values) : FormInterface
    {
        foreach ($values as $element => $value)
        {
            if ($this->getElements()->has($element))
            {
                $this->getElements()->get($element)->setValues($value);
            }
        }
        
        return $this;
    }
    
    public function getValues() : array
    {
        $values = [];
        
        /** @var ElementInterface $element */
        foreach ($this->getElements() as $element)
        {
            $values[$element->getId()] = $element->getValue();
        }
        
        return $values;
    }
    
    public function setDefaultValues($defaultValues) : FormInterface
    {
        foreach ($defaultValues as $element => $value)
        {
            if ($this->getElements()->has($element))
            {
                $this->getElements()->get($element)->setValues($value);
            }
        }
        
        return $this;
    }
    
    public function getDefaultValues() : array
    {
        $defaultValues = [];
        
        /** @var ElementInterface $element */
        foreach ($this->getElements() as $element)
        {
            $defaultValues[$element->getId()] = $element->getDefaultValue();
        }
        
        return $defaultValues;
    }
    
    public function validate() : Stack
    {
        $messages = new Stack();
        
        /** @var ElementInterface $element */
        foreach ($this->getElements() as $element)
        {
            $messages->merge($element->validate());
        }
        
        return $messages;
    }
    
    
}
