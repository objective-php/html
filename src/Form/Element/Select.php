<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

namespace ObjectivePHP\Html\Form\Element;


use ObjectivePHP\Html\Form\Element\Input\SelectInput;
use ObjectivePHP\Html\Form\Element\Renderer\ElementRenderer;
use ObjectivePHP\Primitives\Collection\Collection;

class Select extends AbstractElement
{
    
    protected $defaultRenderer = ElementRenderer::class;
    
    protected $options;
    
    /**
     * Select constructor.
     *
     * @param array $options
     */
    public function __construct($id, $label = null, array $options)
    {
        parent::__construct($id, $label);
        
        $input = new SelectInput($id);
        $this->options = $options;
        $this->setInput($input);
    }
    
    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }
    
    /**
     * @param $this $options
     *
     * @return $this
     */
    public function setOptions($options)
    {
        $this->options = $options;
        
        return $this;
    }
    
}
