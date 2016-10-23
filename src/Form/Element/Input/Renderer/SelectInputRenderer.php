<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

namespace ObjectivePHP\Html\Form\Element\Input\Renderer;


use ObjectivePHP\Html\Form\Element\Input\SelectInput;
use ObjectivePHP\Html\Form\Renderer\RenderableInterface;
use ObjectivePHP\Html\Form\Renderer\RendererInterface;
use ObjectivePHP\Html\Tag\Input\Input;

class SelectInputRenderer implements RendererInterface
{
    /**
     * @param SelectInput $selectInput
     * @param null        $content
     *
     * @return mixed
     */
    public function render(RenderableInterface $selectInput, $content = null)
    {
        $output = Input::select($selectInput->getId())->disableAutoDump();
        $options = $selectInput->getElement()->getOptions();
        $output->addOptions($options);
        return $output;
    }
    
}
