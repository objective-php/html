<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

namespace ObjectivePHP\Html\Form\Renderer;


use ObjectivePHP\Invokable\Invokable;

class EmbeddedRenderer extends Invokable implements RendererInterface
{
    public function render(RenderableInterface $input, $content = null)
    {
        return $this->run($input, $content);
    }
}
