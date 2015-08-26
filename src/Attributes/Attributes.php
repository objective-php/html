<?php

    namespace ObjectivePHP\Html\Attributes;
    
    
    use ObjectivePHP\Primitives\Collection\Collection;

    class Attributes extends Collection
    {
        public function __toString()
        {
            $flattenedAttributes = [];

            $this->each(function($value, $attribute) use(&$flattenedAttributes)
            {
                if(is_int($attribute)) $flattenedAttributes[] = $value;
                else $flattenedAttributes[] = $attribute .'="' . Collection::cast($value)->join(' ') . '"';
            });

            return implode(' ', $flattenedAttributes);
        }
    }