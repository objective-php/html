<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

namespace ObjectivePHP\Html\Form\Renderer;

use ObjectivePHP\Html\Form\Exception;

/**
 * Trait RenderingHandler
 *
 * @package ObjectivePHP\Html\Form\Renderer
 */
trait RenderingHandler
{
    /**
     * @var RendererInterface
     */
    protected $renderer;
    
    protected $defaultRenderer;
    
    /**
     * @param $renderer
     *
     * @return $this
     */
    public function setRenderer($renderer)
    {
        if(!$renderer instanceof RendererInterface)
        {
            $renderer = new EmbeddedRenderer($renderer);
        }
        
        $this->renderer = $renderer;
        
        return $this;
    }
    
    /**
     * @return RendererInterface
     */
    public function getRenderer() : RendererInterface
    {
        if (is_null($this->renderer))
        {
            if (!is_null($this->defaultRenderer))
            {
                
                if (class_exists($this->defaultRenderer))
                {
                    $rendererClass = $this->defaultRenderer;
                    $renderer      = new $rendererClass;
                }
                else
                {
                    $renderer = $this->defaultRenderer;
                }
                
                $this->setRenderer($renderer);
            }
        }
        
        return $this->renderer;
    }
    
    /**
     * @param null $content
     *
     * @return mixed
     */
    public function render($content = null)
    {
        if(!$this instanceof RenderableInterface)
        {
            throw new Exception(__TRAIT__ . ' can only apply to instances of ' . RenderableInterface::class);
        }
        
        return $this->getRenderer()->render($this, $content);
    }
    
    /**
     * @return mixed
     */
    public function __toString()
    {
        return (string) $this->render();
    }
    
}
