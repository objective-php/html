<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

namespace ObjectivePHP\Html\Form\Renderer;


trait ElementRenderingHandler
{
    use RenderingHandler;
    
    /**
     * @return RendererInterface
     */
    public function getRenderer() : RendererInterface
    {
        if(is_null($this->renderer))
        {
            $this->renderer = new DefaultElementRenderer();
        }
        
        return $this->renderer;
    }
}
