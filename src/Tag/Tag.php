<?php

    namespace ObjectivePHP\Html\Tag;
    
    
    use ObjectivePHP\Html\Attributes\Attributes;
    use ObjectivePHP\Html\Exception;
    use ObjectivePHP\Html\Tag\Renderer\DefaultTagRenderer;
    use ObjectivePHP\Html\Tag\Renderer\TagRendererInterface;
    use ObjectivePHP\Primitives\Collection\Collection;
    use ObjectivePHP\Primitives\Merger\MergePolicy;

    /**
     * Class Tag
     *
     * @package ObjectivePHP\Html\Tag
     */
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
        protected $tag = 'div';

        /**
         * @var string
         */
        protected $separator = ' ';

        /**
         * @var bool
         */
        protected $dumped = false;

        /**
         * @var bool
         */
        protected $autoDump = true;

        /**
         * @var bool
         */
        protected $close = false;

        /**
         * @var bool
         */
        protected $alwaysClosed = false;

        /**
         * @var TagRendererInterface
         */
        protected $renderer;

        /**
         * @param null $content
         */
        public function __construct($content = null)
        {
            $this->attributes = new Attributes;
            $this->content    = new Collection;
            $this->renderer   = new DefaultTagRenderer();

            if (!is_null($content)) $this->append($content);
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
        public static function factory($tag, $content = null, ...$classes)
        {

            $tag = (new static())->setTag($tag);

            if (!is_null($content))
            {
                $content = Collection::cast($content)->toArray();
                $tag->append(...$content);
            }

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
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function p($content = null, ...$classes)
        {
            return self::factory('p', $content, ...$classes);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function code($content = null, ...$classes)
        {
            return self::factory('code', $content, ...$classes);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function span($content = null, ...$classes)
        {
            return self::factory('span', $content, ...$classes);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function br()
        {
            return self::factory('br', null);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function hr()
        {
            return self::factory('hr', null);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function a($content = null, $href = null, ...$classes)
        {
            $a = self::factory('a', $content, ...$classes);
            $a->addAttribute('href', $href);

            return $a;
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function form($action = '', $method = 'POST')
        {
            $form = self::factory('form');
            $form->addAttribute('action', $action);
            $form->addAttribute('method', $method);

            return $form;
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function pre($content = null, ...$classes)
        {
            return self::factory('pre', $content, ...$classes);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function h1($content = null, ...$classes)
        {
            return self::factory('h1', $content, ...$classes);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function h2($content = null, ...$classes)
        {
            return self::factory('h2', $content, ...$classes);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function h3($content = null, ...$classes)
        {
            return self::factory('h3', $content, ...$classes);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function h4($content = null, ...$classes)
        {
            return self::factory('h4', $content, ...$classes);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function h5($content = null, ...$classes)
        {
            return self::factory('h5', $content, ...$classes);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function h6($content = null, ...$classes)
        {
            return self::factory('h6', $content, ...$classes);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function strong($content = null, ...$classes)
        {
            return self::factory('strong', $content, ...$classes);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function i($content = null, ...$classes)
        {
            return self::factory('i', $content, ...$classes);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function ul($content = null, ...$classes)
        {
            return self::factory('ul', $content, ...$classes);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function li($content = null, ...$classes)
        {
            return self::factory('li', $content, ...$classes);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function dd($content = null, ...$classes)
        {
            return self::factory('dd', $content, ...$classes);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function dt($content = null, ...$classes)
        {
            return self::factory('dt', $content, ...$classes);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function button($content = null, ...$classes)
        {
            return self::factory('button', $content, ...$classes);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function nav($content = null, ...$classes)
        {
            return self::factory('nav', $content, ...$classes);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function table($content = null, ...$classes)
        {
            return self::factory('table', $content, ...$classes);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function tr($content = null, ...$classes)
        {
            return self::factory('tr', $content, ...$classes);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function thead($content = null, ...$classes)
        {
            return self::factory('thead', $content, ...$classes);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function tbody($content = null, ...$classes)
        {
            return self::factory('tbody', $content, ...$classes);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function th($content = null, ...$classes)
        {
            return self::factory('th', $content, ...$classes);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function td($content = null, ...$classes)
        {
            return self::factory('td', $content, ...$classes);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function small($content = null, ...$classes)
        {
            return self::factory('td', $content, ...$classes);
        }

        /**
         * @param $attribute
         *
         * @return mixed|null
         * @throws \ObjectivePHP\Primitives\Exception
         */
        public function getAttribute($attribute)
        {
            return $this->attributes->get($attribute);
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
         * @param $content
         *
         * @return $this
         */
        public function dump($content = null)
        {

            if (!is_null($content))
            {
                $previous      = $this->content;
                $this->content = $content;
            }

            echo $this->__toString();

            if (!is_null($content))
            {
                $this->content = $previous;
            }

            return $this;
        }

        /**
         * @return string
         * @throws \ObjectivePHP\Primitives\Exception
         */
        public function __toString()
        {

            // mark tag as dumped to prevent auto dump on destruction
            $this->dumped = true;

            $html = $this->renderer->render($this);

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

                case MergePolicy::COMBINE:

                    $previousValue = $this->attributes->get($attribute);
                    if ($previousValue)
                    {
                        $combinedValue = Collection::cast($previousValue)->merge(Collection::cast($value));
                    }
                    else
                    {
                        $combinedValue = $value;
                    }
                    $this->attributes->set($attribute, $combinedValue);
                    break;
                default:
                    throw new Exception('Only MergePolicy::REPLACE and COMBINE are implemented yet');

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

        /**
         * @param mixed $offset
         *
         * @return bool
         */
        public function offsetExists($offset)
        {
            return $this->attributes->has($offset);
        }

        /**
         * @param mixed $offset
         *
         * @return mixed|null
         * @throws \ObjectivePHP\Primitives\Exception
         */
        public function offsetGet($offset)
        {
            return $this->attributes->get($offset);
        }

        /**
         * @param mixed $offset
         * @param mixed $value
         */
        public function offsetSet($offset, $value)
        {
            switch ($offset)
            {
                case 'class':
                    $this->attributes['class']->clear();
                    if (!is_array($value)) $value = [$value];
                    $this->addClass(...$value);
                    break;

                default:
                    $this->attributes->set($offset, $value);
                    break;
            }
        }

        /**
         * @param mixed $offset
         */
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

        /**
         * @return string
         */
        public function close($switch = true)
        {
            $this->close = $switch;

            return $this;
        }

        /**
         * @return bool
         */
        public function isClosingTag()
        {
            return $this->close;
        }

        public function alwaysClose($switch = true)
        {
            $this->alwaysClosed = (bool) $switch;
        }

        public function isAlwaysClosed()
        {
            return $this->alwaysClosed;
        }

        /**
         * @return TagRendererInterface
         */
        public function getRenderer()
        {
            return $this->renderer;
        }

        /**
         * @param TagRendererInterface $renderer
         *
         * @return $this
         */
        public function setRenderer(TagRendererInterface $renderer)
        {
            $this->renderer = $renderer;

            return $this;
        }


        /**
         * @return $this
         */
        public function enableAutoDump()
        {
            $this->autoDump = true;

            return $this;
        }

        /**
         * @return $this
         */
        public function disableAutoDump()
        {
            $this->autoDump = false;

            return $this;
        }

        /**
         * If the tag has not been explicitly dumped,
         * do it automatically on destruction
         */
        public function __destruct()
        {
            if (!$this->dumped && $this->autoDump)
            {
                echo $this->__toString();
            }
        }
    }