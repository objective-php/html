<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

namespace ObjectivePHP\Html\Form\Element\Input;


use ObjectivePHP\Html\Form\Renderer\RendererInterface;
use ObjectivePHP\Html\Tag\Input\Input;

class TextInput extends AbstractInput
{
    /**
     * @return RendererInterface
     */
    public function getRenderer() : RendererInterface
    {
        if (is_null($this->renderer))
        {
            $this->setRenderer(function (TextInput $input)
            {
                $tag = Input::text($input->getId());
                $tag->getAttributes()->merge($input->getAttributes()    );
                $tag->attr('value', $input->getValue() ?: $input->getDefaultValue());
                
                return (string) $tag;
            });
        }
        
        return $this->renderer;
    }
    
}
