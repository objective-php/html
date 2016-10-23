<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

namespace ObjectivePHP\Html\Form\Element\Label\Renderer;


use ObjectivePHP\Html\Form\Element\Label\LabelInterface;
use ObjectivePHP\Html\Form\Renderer\RenderableInterface;
use ObjectivePHP\Html\Form\Renderer\RendererInterface;
use ObjectivePHP\Html\Tag\Tag;

class LabelRenderer implements RendererInterface
{
    
    /**
     * @param LabelInterface $label
     * @param null           $content
     *
     * @return mixed
     */
    public function render(RenderableInterface $label, $content = null)
    {
        $output = Tag::label(Tag::span($label->getText()), $label->getElement()->getInput()->getName());
        $output->getAttributes()->merge($label->getAttributes());

        if (!is_null($content))
        {
            $output->append($content);
        }

        if($label->getElement()->isRequired())
        {
            $output->addClass('required');
        }
        
        return $output;
    }
    
}
