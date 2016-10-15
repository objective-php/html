<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

namespace ObjectivePHP\Html\Form\Renderer;


interface RenderableInterface
{
    public function setRenderer($renderer);
    
    public function getRenderer() : RendererInterface;
    
    public function render($content = null);
    
    public function __toString();
}
