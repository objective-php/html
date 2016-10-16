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
use ObjectivePHP\Html\Form\Renderer\RenderingHandler;
use ObjectivePHP\Html\Form\ValidationHandler;
use ObjectivePHP\Html\Tag\Attributes\AttributesHandler;
use ObjectivePHP\Notification\Stack;

/**
 * Class AbstractInput
 *
 * @package ObjectivePHP\Html\Form\Element\Input
 */
class AbstractInput implements InputInterface
{
    
    use AttributesHandler;
    use RenderingHandler;
    use ValidationHandler;
    
    /**
     * @var string
     */
    protected $name;
    
    /**
     * @var string
     */
    protected $id;
    
    /**
     * @var mixed
     */
    protected $value;
    
    /**
     * @var mixed
     */
    protected $defaultValue;
    
    /**
     * @var ElementInterface
     */
    protected $element;
    
    /**
     * @var mixed
     */
    protected $defaultRenderer;
    
    /**
     * AbstractInput constructor.
     *
     * @param $name
     * @param $id
     */
    public function __construct($name, $id = null)
    {
        if($id) $this->setId($id);
        $this->setName($name);
    }
    
    
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * @param $name
     *
     * @return InputInterface
     */
    public function setName($name) : InputInterface
    {
        $this->name = $name;
        
        if(is_null($this->id))
        {
            $this->id = $name;
        }
        
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @param $id
     *
     * @return InputInterface
     */
    public function setId($id) : InputInterface
    {
        $this->id = $id;
        
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
    
    /**
     * @param $value
     *
     * @return InputInterface
     */
    public function setValue($value) : InputInterface
    {
        $this->value = $value;
        
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }
    
    /**
     * @param $defaultValue
     *
     * @return InputInterface
     */
    public function setDefaultValue($defaultValue) : InputInterface
    {
        $this->defaultValue = $defaultValue;
    }
    
    /**
     * @return bool
     */
    public function validate() : Stack
    {
        return new Stack();
    }
    
    /**
     * @return ElementInterface
     */
    public function getElement(): ElementInterface
    {
        return $this->element;
    }
    
    /**
     * @param ElementInterface $element
     *
     * @return $this
     */
    public function setElement(ElementInterface $element)
    {
        $this->element = $element;
        
        return $this;
    }
    
}
