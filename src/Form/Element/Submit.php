<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

namespace ObjectivePHP\Html\Form\Element;


use ObjectivePHP\Html\Form\Element\Input\SubmitInput;
use ObjectivePHP\Html\Form\Element\Renderer\ElementRenderer;

class Submit extends AbstractElement
{
    
    protected $defaultRenderer = ElementRenderer::class;
    
    /**
     * SubmitInput constructor.
     *
     * @param $id
     */
    public function __construct($id, $label = null)
    {
        parent::__construct($id);
        
        $input = new SubmitInput($id);
        $input->setId($id);
        $input->setValue($label);
        $this->setInput($input);
    }
}
