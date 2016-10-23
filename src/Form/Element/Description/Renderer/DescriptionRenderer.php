<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

namespace ObjectivePHP\Html\Form\Element\Description\Renderer;

use ObjectivePHP\Html\Form\Element\Description\DescriptionInterface;
use ObjectivePHP\Html\Form\Renderer\RenderableInterface;
use ObjectivePHP\Html\Form\Renderer\RendererInterface;
use ObjectivePHP\Html\Tag\Tag;

class DescriptionRenderer implements RendererInterface
{

    /**
     * @param DescriptionInterface $description
     * @param null $content
     *
     * @return mixed
     */
    public function render(RenderableInterface $description, $content = null)
    {
        $output = Tag::factory('details', Tag::factory('summary', 'help'));
        $output->getAttributes()->merge($description->getAttributes());
        $output->append(Tag::p($description->getText()));

        if (!is_null($content))
        {
            $output->append($content);
        }

        return $output;
    }

}
