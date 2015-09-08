<?php

    namespace ObjectivePHP\Html\Tag;
    
    
    use ObjectivePHP\Html\Attributes\Attributes;
    use ObjectivePHP\Html\Exception;
    use ObjectivePHP\Primitives\Collection\Collection;
    use ObjectivePHP\Primitives\Merger\MergePolicy;
    use ObjectivePHP\Primitives\String\String;

    class Tag implements TagInterface
    {

        /**
         * @var Attributes
         */
        protected $attributes;

        /**
         * @var Collection
         */
        protected $content;

        /**
         * @var string
         */
        protected $tag;

        /**
         * @var string
         */
        protected $separator = ' ';

        /**
         * @param null $content
         */
        public function __construct($content = null)
        {
            $this->attributes = new Attributes;
            $this->content    = new Collection;

            $this->append($content);
        }

        /**
         * @param $method
         * @param $parameters
         *
         * @return Tag
         */
        public static function __callStatic($method, $parameters)
        {
            $tag     = $method;
            $content = $classes = null;
            if ($parameters)
            {
                $content = array_shift($parameters);
            }

            return self::factory($tag, $content, ...$parameters);
        }

        /**
         * Generate a tag
         *
         * @param string $tag
         * @param string $content
         * @param array  $classes
         *
         * @return $this
         */
        public static function factory($tag, $content, ...$classes)
        {

            $tag = (new self())->setTag($tag);

            $content = Collection::cast($content)->toArray();
            $tag->append(...$content);

            $tag->addClass(...$classes);

            return $tag;
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function div($content = null, ...$classes)
        {
            return self::factory('div', $content, ...$classes);
        }

        /**
         * @param $attribute
         *
         * @return mixed|null
         * @throws \ObjectivePHP\Primitives\Exception
         */
        public function getAttribute($attribute)
        {
            return $this->attributes->get($attribute, null);
        }

        /**
         * @return mixed|null
         */
        public function getClasses()
        {
            return $this->attributes['class'];
        }

        /**
         * @param ...$content
         */
        public function prepend(...$content)
        {
            $this->content->prepend(...$content);

            return $this;
        }

        /**
         * @return string
         * @throws \ObjectivePHP\Primitives\Exception
         */
        public function __toString()
        {

            $html = '<' . trim(implode(' ', [$this->getTag(), $this->getAttributes()])) . '>';

            $chunks = new Collection();
            if (!$this->content->isEmpty())
            {
                $this->content->each(function ($chunk) use (&$chunks)
                {
                    $chunks[] = (string) $chunk;
                });

                $html .= $chunks->join($this->getSeparator())->trim();

                $html .= '</' . $this->getTag() . '>';
            }

            return $html;

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
                    $this->attributes->set($attribute, $value);
                    break;

                default:
                    throw new Exception('Only MergePolicy::REPLACE is implemented yet');

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
                $this->attributes['class']->append(...Collection::cast(explode(' ', $cssClass)));
            }

            return $this;
        }

        /**
         * @param ...$content
         */
        public function append(...$content)
        {
            $this->content->append(...$content);

            return $this;
        }

        /**
         * @return $this
         */
        public function clearContent()
        {
            $this->content->clear();

            return $this;
        }

        /**
         * @return Collection
         */
        public function getContent()
        {
            return $this->content;
        }

        /**
         * @return string
         */
        public function getTag()
        {
            return $this->tag;
        }

        /**
         * @param $tag
         *
         * @return $this
         */
        public function setTag($tag)
        {
            $this->tag = $tag;

            return $this;
        }

        public function offsetExists($offset)
        {
            return $this->attributes->has($offset);
        }

        public function offsetGet($offset)
        {
            return $this->attributes->get($offset);
        }

        public function offsetSet($offset, $value)
        {
            switch ($offset)
            {
                case 'class':
                    $this->attributes['class']->clear();
                    $this->addClass(...$value);
                    break;

                default:
                    $this->attributes->set($offset, $value);
                    break;
            }
        }

        public function offsetUnset($offset)
        {
            switch ($offset)
            {
                case 'class':
                    $this->attributes->set($offset, new Collection());
                    break;

                default:
                    unset($this->attributes[$offset]);
                    break;
            }
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
                unset($this->attributes[$htmlAttribute]);
            }

            return $this;
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
                $index = $this->attributes['class']->search($cssClass);
                unset($this->attributes['class'][$index]);

                // reset keys
                $this->attributes['class']->fromArray($this->attributes['class']->values()->toArray());
            }

            return $this;
        }

        /**
         * @return Attributes
         */
        public function getAttributes()
        {
            return $this->attributes;
        }

        /**
         * @return string
         */
        public function getSeparator()
        {
            return $this->separator;
        }

        /**
         * @param string $separator
         *
         * @return $this
         */
        public function setSeparator($separator)
        {
            $this->separator = $separator;

            return $this;
        }

        public function close()
        {
            return '</' . $this->getTag() . '>';
        }

    }