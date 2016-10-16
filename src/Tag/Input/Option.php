<?php

    namespace ObjectivePHP\Html\Tag\Input;
    
    
    class Option extends Input
    {
        
        protected $tagName = 'option';
        
        public function isSelected()
        {
            return $this->getAttribute('selected');
        }

        public function setSelected($switch = true)
        {
            $this->addAttribute('selected', (bool) $switch);

            return $this;
        }
    }
