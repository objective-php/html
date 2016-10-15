<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

namespace ObjectivePHP\Html\Form\Renderer;


use ObjectivePHP\Html\Form\Element\ElementInterface;
use ObjectivePHP\Html\Form\Element\Label\LabelInterface;
use ObjectivePHP\Html\Tag\Tag;
use ObjectivePHP\Notification\MessageInterface;

class DefaultElementRenderer implements RendererInterface
{
    /**
     * @param ElementInterface $input
     * @param null             $content
     */
    public function render(RenderableInterface $input, $content = null)
    {
        $output = Tag::div();
        
        $output->getAttributes()->merge($input->getAttributes());
        
        $renderedInput = $input->getInput()->render();
        
        $label = $input->getLabel();
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
        
        $messages = $input->getMessages();
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
        
        return $output;
    }
    
}
