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

class FormRenderer implements RendererInterface
{
    /**
     * @param FormInterface $select
     * @param null          $content
     *
     * @return mixed
     */
    public function render(RenderableInterface $select, $content = null)
    {
        $output = Tag::form($select->getAction())->append($content);
        $output->getAttributes()->merge($select->getAttributes());
        
        /** @var ElementInterface $select */
        foreach ($select->getElements() as $select)
        {
            $output->append(PHP_EOL, $select->render(), PHP_EOL);
        }
        
        return $output;
    }
    
}
