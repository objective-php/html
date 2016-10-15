<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

namespace ObjectivePHP\Html\Form\Element\Label;


use ObjectivePHP\Html\Form\Renderer\RendererInterface;
use ObjectivePHP\Html\Form\Renderer\RenderingHandler;
use ObjectivePHP\Html\Tag\Tag;

class Label implements LabelInterface
{
    use RenderingHandler;
    
    protected $placement = self::WRAP;
    
    protected $text;
    
    /**
     * Label constructor.
     *
     * @param string $placement
     * @param        $text
     */
    public function __construct($text, $placement = self::WRAP)
    {
        $this->placement = $placement;
        $this->text      = $text;
    }
    
    
    public function getPlacement() : string
    {
        return $this->placement;
    }
    
    public function setPlacement(string $placement) : LabelInterface
    {
        $this->placement = $placement;
        
        return $this;
    }
    
    /**
     * @param mixed $text
     *
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;
        
        return $this;
    }
    
    /**
     * @return string
     */
    public function getText() : string
    {
        return $this->text;
    }
    
    /**
     * @return RendererInterface
     */
    public function getRenderer() : RendererInterface
    {
        if(is_null($this->renderer))
        {
            $this->setRenderer(function(LabelInterface $label, $content = null) {
               $output = Tag::label($label->getText(), '');
                if(!is_null($content))
                {
                    $output->append($content);
                }
                    
                return $output;

            });
        }
        
        return $this->renderer;
    }
    
    
}
