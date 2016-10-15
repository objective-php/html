<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

namespace ObjectivePHP\Html\Form\Element;


use ObjectivePHP\Html\Form\Element\Input\TextInput;
use ObjectivePHP\Html\Form\Element\Label\Label;
use ObjectivePHP\Html\Form\Element\Label\LabelInterface;

class Text extends AbstractElement
{
    /**
     * Text constructor.
     *
     * @param $id
     */
    public function __construct($id, $label)
    {
        parent::__construct($id);
        $input = new TextInput();
        $input->setId($id);
        $this->setInput($input);
        
        if(!$label instanceof LabelInterface)
        {
            $label = new Label($label);
        }
        
        $this->setLabel($label);
    }
    
}
