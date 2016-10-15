<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

namespace ObjectivePHP\Html\Tag\Attributes;


trait AttributesHandler
{
    /**
     * @var Attributes
     */
    protected $attributes;
    
    /**
     * @return Attributes
     */
    public function getAttributes(): Attributes
    {
        if(is_null($this->attributes))
        {
            $this->attributes = new Attributes();
        }
        
        return $this->attributes;
    }
    
    /**
     * @param Attributes $attributes
     *
     * @return $this
     */
    public function setAttributes(Attributes $attributes)
    {
        $this->attributes = $attributes;
        
        return $this;
    }
    
    // PROXIES
    public function data($dataAttribute, $value = null)
    {
        $dataAttribute = 'data-' . $dataAttribute;
        
        if (is_null($value))
        {
            return $this->getAttributes()->has($dataAttribute) ? $this->getAttributes()->get($dataAttribute) : null;
        }
        else
        {
            $this->getAttributes()->set($dataAttribute, $value);
            
            return $this;
        }
    }
    public function attr($attribute, $value = null)
    {
        if(is_null($value))
        {
            return $this->getAttributes()->has($attribute) ? $this->getAttributes()->get($attribute) : null;
        }
        else
        {
            $this->getAttributes()->set($attribute, $value);
    
            return $this;
        }
    }
    
}
