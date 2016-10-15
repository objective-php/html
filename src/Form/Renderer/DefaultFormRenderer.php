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
use ObjectivePHP\Html\Form\FormInterface;
use ObjectivePHP\Html\Tag\Tag;

class DefaultFormRenderer implements RendererInterface
{
    /**
     * @param FormInterface $form
     * @param null          $content
     *
     * @return mixed
     */
    public function render(RenderableInterface $form, $content = null)
    {
       $output = Tag::form($form->getAction());
        
        /** @var ElementInterface $element */
        foreach($form->getElements() as $element)
        {
            $output->append($element->render());
        }
        
        return $output;
    }
    
}
