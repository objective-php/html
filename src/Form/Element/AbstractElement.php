<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

namespace ObjectivePHP\Html\Form\Element;


use ObjectivePHP\Html\Form\Element\Input\InputInterface;
use ObjectivePHP\Html\Form\Element\Label\LabelInterface;
use ObjectivePHP\Html\Form\Renderer\ElementRenderingHandler;
use ObjectivePHP\Html\Form\ValidationHandler;
use ObjectivePHP\Html\Tag\Attributes\AttributesHandler;
use ObjectivePHP\Notification\Stack;

/**
 * Class AbstractElement
 *
 * @package ObjectivePHP\Form\Element
 */
class AbstractElement implements ElementInterface
{
    use AttributesHandler;
    use ValidationHandler;
    use ElementRenderingHandler;
    
    /**
     * @var
     */
    protected $id;
    
    /**
     * @var InputInterface
     */
    protected $input;
    
    /** @var  LabelInterface */
    protected $label;
    
    
    public function __construct($id)
    {
        $this->setId($id);
    }
    
    /**
     * Proxy to InputInterface::getDefaultValue()
     */
    public function getDefaultValue()
    {
        return $this->getInput()->getDefaultValue();
    }
    
    /**
     * @return InputInterface
     */
    public function getInput() : InputInterface
    {
        return $this->input;
    }
    
    /**
     * @param InputInterface $input
     *
     * @return ElementInterface
     */
    public function setInput(InputInterface $input) : ElementInterface
    {
        $this->input = $input;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getId() : string
    {
        return (string) $this->id;
    }
    
    /**
     * @param string $id
     *
     * @return $this
     */
    public function setId(string $id)
    {
        $this->id = (string) $id;
        
        return $this;
    }
    
    /**
     * @return LabelInterface
     */
    public function getLabel() : LabelInterface
    {
        return $this->label;
    }
    
    /**
     * @param LabelInterface $label
     *
     * @return ElementInterface
     */
    public function setLabel(LabelInterface $label) : ElementInterface
    {
        $this->label = $label;
        
        return $this;
    }
    
    /**
     * Proxy to InputInterface::getValue()
     */
    public function getValue()
    {
        return $this->getInput()->getValue();
    }
    
    /**
     * @param $defaultValue
     *
     * @return ElementInterface
     */
    public function setDefaultValue($defaultValue) : ElementInterface
    {
        $this->getInput()->setDefaultValue($defaultValue);
        
        return $this;
    }
    
    /**
     * Proxy to InputInterface::setValue()
     *
     * @param $value
     *
     * @return ElementInterface
     */
    public function setValue($value) : ElementInterface
    {
        $this->getInput()->setValue($value);
        
        return $this;
    }
    
    /**
     * Proxy to InputInterface::validate()
     *
     * @return Stack
     */
    public function validate() : Stack
    {
        return $this->getInput()->validate();
    }
    
}
