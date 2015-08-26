<?php
    
    namespace ObjectivePHP\Html\Tag;

    use ObjectivePHP\Primitives\Merger\MergePolicy;

    interface TagInterface
    {

        public function isContainer();

        public function addAttribute($attribute, $value, $mergePolicy = MergePolicy::REPLACE);

        public function clearAttribute($attribute);



        public function __toString();

    }