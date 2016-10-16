<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

namespace ObjectivePHP\Html\Tag\Attributes;


use ObjectivePHP\Primitives\Merger\MergePolicy;

interface AttributesProvider
{
    
    /** @return $this */
    public function getAttributes() : Attributes;
    
    /** @return $this */
    public function setAttributes(Attributes $attributes);
    
    /** @return $this */
    public function attr($attribute, $value = null);
    
    /** @return $this */
    public function data($data, $value = null);
    
    /** @return $this */
    public function addAttributes($attributes, $mergePolicies = []);
    
    /** @return $this */
    public function addAttribute($attribute, $value, $mergePolicy = MergePolicy::REPLACE);
    
    /** @return $this */
    public function removeAttribute(...$attribute);
    
    /** @return $this */
    public function getClasses();
    
    /** @return $this */
    public function removeClass(...$class);
    
    /** @return $this */
    public function addClass(...$class);
    
}
