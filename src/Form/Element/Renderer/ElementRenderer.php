<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

namespace ObjectivePHP\Html\Form\Element\Renderer;


use ObjectivePHP\Html\Form\Element\Description\DescriptionInterface;
use ObjectivePHP\Html\Form\Element\ElementInterface;
use ObjectivePHP\Html\Form\Element\Label\LabelInterface;
use ObjectivePHP\Html\Form\Renderer\RenderableInterface;
use ObjectivePHP\Html\Form\Renderer\RendererInterface;
use ObjectivePHP\Html\Tag\Tag;
use ObjectivePHP\Notification\MessageInterface;

class ElementRenderer implements RendererInterface
{
    /**
     * @param ElementInterface $element
     * @param null             $content
     *
     * @return mixed
     */
    public function render(RenderableInterface $element, $content = null)
    {
        $output = Tag::div();
        
        $output->getAttributes()->merge($element->getAttributes());
        
        $renderedInput = $element->getInput()->render();
        
        if ($element->hasLabel())
        {
            $label = $element->getLabel();
            switch ($label->getPlacement())
            {
                case LabelInterface::WRAP:
                    $output->append($label->render($renderedInput));
                    break;
                
                case LabelInterface::BEFORE:
                    $output->append($label->render(), $renderedInput);
                    break;
                
                case LabelInterface::AFTER:
                    $output->append($renderedInput, $label);
                    break;
            }
        }
        else
        {
            $output->append($renderedInput);
        }

        if ($element->hasDescription()) {
            $output->append($element->getDescription());
        }

        $messages = $element->getMessages();
        if ($messages->count('alert') || $messages->count('warning'))
        {
            $ul = Tag::ul(null, 'message');
            /** @var MessageInterface $message */
            foreach ($messages as $message)
            {
                $ul->append(Tag::li($message, $message->getType()));
            }
            $output->append($ul);
        }
        
        $output->append(PHP_EOL);
        
        return $output;
    }
    
}
