<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

namespace ObjectivePHP\Html\Tag\Attributes;


use ObjectivePHP\Primitives\Collection\Collection;
use ObjectivePHP\Primitives\Merger\MergePolicy;

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
    
    /**
     * @param $attribute
     *
     * @return mixed|null
     * @throws \ObjectivePHP\Primitives\Exception
     */
    public function getAttribute($attribute)
    {
        return $this->getAttributes()->get($attribute);
    }
    
    /**
     * @param       $attributes
     * @param array $mergePolicies
     *
     * @throws \ObjectivePHP\Primitives\Exception
     */
    public function addAttributes($attributes, $mergePolicies = [])
    {
        Collection::cast($attributes)->each(function ($value, $attribute) use ($mergePolicies)
        {
            $mergePolicy = isset($mergePolicies[$attribute]) ? $mergePolicies[$attribute] : MergePolicy::REPLACE;
            $this->addAttribute($attribute, $value, $mergePolicy);
        })
        ;
        
        return $this;
    }
    
    /**
     * @param     $attribute
     * @param     $value
     * @param int $mergePolicy
     *
     * @return $this
     * @throws Exception
     */
    public function addAttribute($attribute, $value, $mergePolicy = MergePolicy::REPLACE)
    {
        switch ($mergePolicy)
        {
            case MergePolicy::REPLACE:
                $this->getAttributes()->set($attribute, $value);
                break;
            
            case MergePolicy::NATIVE:
            case MergePolicy::COMBINE:
                
                $previousValue = $this->getAttributes()->get($attribute);
                if ($previousValue)
                {
                    $combinedValue = Collection::cast($previousValue)->merge(Collection::cast($value));
                }
                else
                {
                    $combinedValue = $value;
                }
                $this->getAttributes()->set($attribute, $combinedValue);
                break;
            
            
            default:
                throw new Exception('Only MergePolicy::REPLACE and COMBINE are implemented yet');
            
        }
        
        return $this;
    }
    
    
    /**
     * @param ...$attribute
     *
     * @return $this
     */
    public function removeAttribute(...$attribute)
    {
        foreach ($attribute as $htmlAttribute)
        {
            $this->getAttributes()->delete($htmlAttribute);
        }
        
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
    
    /**
     * @param      $attribute
     * @param null $value
     * @param int  $mergePolicy
     *
     * @return $this|mixed|null
     */
    public function attr($attribute, $value = null, $mergePolicy = MergePolicy::REPLACE)
    {
        if(is_null($value))
        {
            return $this->getAttributes()->has($attribute) ? $this->getAttributes()->get($attribute) : null;
        }
        else
        {
            $this->addAttribute($attribute, $value, $mergePolicy);
    
            return $this;
        }
    }
    
    /**
     * @return mixed|null
     */
    public function getClasses()
    {
        return $this->getAttributes()['class'];
    }
    
    /**
     * @param ...$class
     *
     * @return $this
     */
    public function removeClass(...$class)
    {
        foreach ($class as $cssClass)
        {
            $index = $this->getAttributes()['class']->search($cssClass);
            unset($this->getAttributes()['class'][$index]);
            
            // reset keys
            $this->getAttributes()['class']->fromArray($this->getAttributes()['class']->values()->toArray());
        }
        
        return $this;
    }
    
    /**
     * @param ...$class
     *
     * @return $this
     */
    public function addClass(...$class)
    {
        foreach ($class as $cssClass)
        {
            $this->getAttributes()['class']->append(...Collection::cast(explode(' ', $cssClass)));
        }
        
        return $this;
    }
    
}
