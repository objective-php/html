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
     * @param LabelInterface $select
     * @param null           $content
     *
     * @return mixed
     */
    public function render(RenderableInterface $select, $content = null)
    {
        $output = Tag::label($select->getText(), $select->getElement()->getInput()->getName());
        $output->getAttributes()->merge($select->getAttributes());
        if (!is_null($content))
        {
            $output->append($content);
        }
        
        return $output;
    }
    
}
