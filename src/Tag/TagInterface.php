<?php
    
    namespace ObjectivePHP\Html\Tag;

    use ObjectivePHP\Primitives\Merger\MergePolicy;

    interface TagInterface extends \ArrayAccess
    {

        public function addAttribute($attribute, $value, $mergePolicy = MergePolicy::REPLACE);

        public function removeAttribute(...$attribute);

        public function addClass(...$class);

        public function removeClass(...$class);

        public function setTag($tag);

        public function getTag();

        public function append(...$content);

        public function clearContent();

        public function getContent();

        public function __toString();

    }