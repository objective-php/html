<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

namespace ObjectivePHP\Html\Form\Element\Input\Renderer;


use ObjectivePHP\Html\Form\Element\Input\SubmitInput;
use ObjectivePHP\Html\Form\Renderer\RenderableInterface;
use ObjectivePHP\Html\Form\Renderer\RendererInterface;
use ObjectivePHP\Html\Tag\Input\Input;

class SubmitInputRenderer implements RendererInterface
{
    /**
     * @param SubmitInput $input
     * @param null                $content
     *
     * @return mixed
     */
    public function render(RenderableInterface $input, $content = null)
    {
        $tag = Input::submit($input->getValue());
        $tag->getAttributes()->merge($input->getAttributes());
        
        return (string) $tag;
    }
    
}
