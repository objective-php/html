<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

namespace ObjectivePHP\Html\Form\Element\Label;


use ObjectivePHP\Html\Form\Element\ElementInterface;
use ObjectivePHP\Html\Form\Element\Label\Renderer\LabelRenderer;
use ObjectivePHP\Html\Form\Renderer\RenderingHandler;
use ObjectivePHP\Html\Tag\Attributes\AttributesHandler;

/**
 * Class Label
 *
 * @package ObjectivePHP\Html\Form\Element\Label
 */
abstract class AbstractLabel implements LabelInterface
{
    use RenderingHandler;
    use AttributesHandler;
    
    /**
     * @var string
     */
    protected $placement = self::WRAP;
    
    /**
     * @var mixed
     */
    protected $text;
    
    /** @var  ElementInterface */
    protected $element;
    
    
    /**
     * Label constructor.
     *
     * @param string $placement
     * @param        $text
     */
    public function __construct($text, $placement = self::WRAP)
    {
        $this->placement = $placement;
        $this->text      = $text;
    }
    
    
    /**
     * @return string
     */
    public function getPlacement() : string
    {
        return $this->placement;
    }
    
    /**
     * @param string $placement
     *
     * @return LabelInterface
     */
    public function setPlacement(string $placement) : LabelInterface
    {
        $this->placement = $placement;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getText() : string
    {
        return $this->text;
    }
    
    /**
     * @param mixed $text
     *
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;
        
        return $this;
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
