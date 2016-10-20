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
use ObjectivePHP\Html\Form\Renderer\RenderingHandler;
use ObjectivePHP\Html\Tag\Attributes\AttributesHandler;
use ObjectivePHP\Notification\Stack;
use ObjectivePHP\Primitives\Collection\Collection;

/**
 * Class AbstractForm
 * @package ObjectivePHP\Html\Form
 */
abstract class AbstractForm implements FormInterface
{
    use RenderingHandler;
    use AttributesHandler;
    use ValidationHandler;

    /**
     * @var
     */
    protected $name;

    /**
     * @var $this
     */
    protected $elements;

    /**
     * @var string
     */
    protected $action = '';

    /**
     * AbstractForm constructor.
     */
    public function __construct()
    {
        $this->elements = (new Collection())->restrictTo(ElementInterface::class);
        
        $this->init();
    }

    /**
     * Delegated constructor
     *
     * This method is intended to be overridden by inherited classes
     */
    protected function init()
    {
        
    }

    /**
     * Elements on-the-fly customization
     *
     * This method is intended to be overridden by inherited classes
     *
     */
    protected function prepareElement(ElementInterface $element)
    {
        $element->setForm($this);
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


    /**
     * @param ElementInterface $element
     */
    public function addElement(ElementInterface $element)
    {
        // prepare element
        $this->prepareElement($element);

        $this->getElements()->append($element);
    }

    /**
     * @return Collection
     */
    public function getElements() : Collection
    {
        return $this->elements;
    }

    /**
     * @param $values
     * @return FormInterface
     */
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

    /**
     * @return array
     */
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

    /**
     * @param $defaultValues
     * @return FormInterface
     */
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

    /**
     * @return array
     */
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

    /**
     * @return Stack
     */
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
