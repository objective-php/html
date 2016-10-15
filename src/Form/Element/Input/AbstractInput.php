<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

namespace ObjectivePHP\Html\Form\Element\Input;


use ObjectivePHP\Html\Form\Renderer\RenderingHandler;
use ObjectivePHP\Html\Form\ValidationHandler;
use ObjectivePHP\Html\Tag\Attributes\AttributesHandler;
use ObjectivePHP\Notification\Stack;

class AbstractInput implements InputInterface
{
    
    use AttributesHandler;
    use RenderingHandler;
    use ValidationHandler;
    
    protected $name;
    
    protected $id;
    
    protected $value;
    
    protected $defaultValue;
    
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
        // TODO: Implement setValue() method.
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
    
}
