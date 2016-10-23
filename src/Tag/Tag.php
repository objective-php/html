<?php

    namespace ObjectivePHP\Html\Tag;
    
    
    use ObjectivePHP\Html\Exception;
    use ObjectivePHP\Html\Tag\Attributes\Attributes;
    use ObjectivePHP\Html\Tag\Attributes\AttributesHandler;
    use ObjectivePHP\Html\Tag\Renderer\DefaultTagRenderer;
    use ObjectivePHP\Html\Tag\Renderer\TagRendererInterface;
    use ObjectivePHP\Primitives\Collection\Collection;
    use ObjectivePHP\Primitives\Merger\MergePolicy;
    use ObjectivePHP\Primitives\String\Str;

    /**
     * Class Tag
     *
     * @package ObjectivePHP\Html\Tag
     */
    class Tag implements TagInterface
    {

        use AttributesHandler;
        
        /**
         * @var Collection
         */
        protected static $decorators;

        /**
         * @var Collection
         */
        protected $content = '';

        /**
         * @var string
         */
        protected $tagName = 'div';

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

            $tag = self::factory($tag, $content, ...$parameters);

            return self::decorate($tag);
        }

        /**
         * Generate a tag
         *
         * @param string $tagName
         * @param string $content
         * @param array  $classes
         *
         * @return $this
         */
        public static function factory($tagName, $content = null, ...$classes)
        {

            // skip empty contents tag
            if($content instanceof Str && !(string) $content) return null;

            /**
             * @var $tagName Tag
             */
            $tagName = (new static())->setTagName($tagName);

            if (!is_null($content))
            {
                $content = Collection::cast($content)->toArray();
                $tagName->append(...$content);
            }

            if($classes) $tagName->addClass(...$classes);

            return $tagName;
        }

        /**
         * @param $tag
         *
         * @throws \ObjectivePHP\Primitives\Exception
         */
        protected static function decorate($tag)
        {

            // shunt void tags
            if(!$tag) return null;

            if ($decorators = self::$decorators)
            {
                $decorators->each(function ($decorator) use ($tag)
                {
                    $decorator($tag);
                });
            }

            return $tag;
        }

        /**
         * @return Collection
         */
        public static function getDecorators()
        {
            if (is_null(self::$decorators))
            {
                self::$decorators = new Collection();
            }

            return self::$decorators;
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function div($content = null, ...$classes)
        {
            $tag = self::factory('div', $content, ...$classes);

            return self::decorate($tag);
        }


        /**
         * @param       $content
         * @param array ...$classes
         *
         * @return Tag
         */
        public static function blockquote($content = null, ...$classes) : Tag
        {
            $tag = self::factory('blockquote', $content, ...$classes);

            return $tag;
        }

        /**
         * @param string $src
         * @param string $alt
         *
         * @return Tag
         * @throws Exception
         */
        public static function img(string $src = '', string $alt = '') : Tag
        {
            $img = self::factory('img');
            $img->addAttribute('src', $src);
            $img->addAttribute('alt', $alt);

            return $img;
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function p($content = null, ...$classes)
        {
            $tag = self::factory('p', $content, ...$classes);

            return self::decorate($tag);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function code($content = null, ...$classes)
        {
            $tag = self::factory('code', $content, ...$classes);

            return self::decorate($tag);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function span($content = null, ...$classes)
        {
            $tag = self::factory('span', $content, ...$classes);

            return self::decorate($tag);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function br()
        {
            $tag = self::factory('br', null);

            return self::decorate($tag);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function hr()
        {
            $tag = self::factory('hr', null);

            return self::decorate($tag);
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
         * @param $label
         * @param $for
         *
         * @return Tag
         * @throws Exception
         */
        public static function label($label, $for)
        {
            $label = self::factory('label', $label);
            $label->addAttribute('for', $for);

            return $label;
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function pre($content = null, ...$classes)
        {
            $tag = self::factory('pre', $content, ...$classes);

            return self::decorate($tag);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function h1($content = null, ...$classes)
        {
            $tag = self::factory('h1', $content, ...$classes);

            return self::decorate($tag);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function h2($content = null, ...$classes)
        {
            $tag = self::factory('h2', $content, ...$classes);

            return self::decorate($tag);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function h3($content = null, ...$classes)
        {
            $tag = self::factory('h3', $content, ...$classes);

            return self::decorate($tag);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function h4($content = null, ...$classes)
        {
            $tag = self::factory('h4', $content, ...$classes);

            return self::decorate($tag);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function h5($content = null, ...$classes)
        {
            $tag = self::factory('h5', $content, ...$classes);

            return self::decorate($tag);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function h6($content = null, ...$classes)
        {
            $tag = self::factory('h6', $content, ...$classes);

            return self::decorate($tag);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function strong($content = null, ...$classes)
        {
            $tag = self::factory('strong', $content, ...$classes);

            return self::decorate($tag);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function i($content = null, ...$classes)
        {
            $tag = self::factory('i', $content, ...$classes);

            return self::decorate($tag);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function ul($content = null, ...$classes)
        {
            $tag = self::factory('ul', $content, ...$classes);

            return self::decorate($tag);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function li($content = null, ...$classes)
        {
            $tag = self::factory('li', $content, ...$classes);

            return self::decorate($tag);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function dd($content = null, ...$classes)
        {
            $tag = self::factory('dd', $content, ...$classes);

            return self::decorate($tag);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function dt($content = null, ...$classes)
        {
            $tag = self::factory('dt', $content, ...$classes);

            return self::decorate($tag);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function button($content = null, ...$classes)
        {
            $tag = self::factory('button', $content, ...$classes);

            return self::decorate($tag);
        }


        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function nav($content = null, ...$classes)
        {
            $tag = self::factory('nav', $content, ...$classes);

            return self::decorate($tag);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function section($content = null, ...$classes)
        {
            $tag = self::factory('section', $content, ...$classes);

            return self::decorate($tag);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function table($content = null, ...$classes)
        {
            $tag = self::factory('table', $content, ...$classes);

            return self::decorate($tag);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function tr($content = null, ...$classes)
        {
            $tag = self::factory('tr', $content, ...$classes);

            return self::decorate($tag);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function thead($content = null, ...$classes)
        {
            $tag = self::factory('thead', $content, ...$classes);

            return self::decorate($tag);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function tbody($content = null, ...$classes)
        {
            $tag = self::factory('tbody', $content, ...$classes);

            return self::decorate($tag);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function th($content = null, ...$classes)
        {
            $tag = self::factory('th', $content, ...$classes);

            return self::decorate($tag);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function td($content = null, ...$classes)
        {
            $tag = self::factory('td', $content, ...$classes);

            return self::decorate($tag);
        }

        /**
         * @param $content
         * @param ...$classes
         *
         * @return Tag
         */
        public static function small($content = null, ...$classes)
        {
            $tag = self::factory('small', $content, ...$classes);

            return self::decorate($tag);
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

            return (string) $html;
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
        public function getTagName()
        {
            return $this->tagName;
        }

        /**
         * @param $tagName
         *
         * @return $this
         */
        public function setTagName($tagName)
        {
            $this->tagName = $tagName;

            return $this;
        }

        /**
         * @param mixed $offset
         *
         * @return bool
         */
        public function offsetExists($offset)
        {
            return $this->getAttributes()->has($offset);
        }

        /**
         * @param mixed $offset
         *
         * @return mixed|null
         * @throws \ObjectivePHP\Primitives\Exception
         */
        public function offsetGet($offset)
        {
            return $this->getAttributes()->get($offset);
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
                    $this->getAttributes()['class']->clear();
                    if (!is_array($value)) $value = [$value];
                    $this->addClass(...$value);
                    break;

                default:
                    $this->getAttributes()->set($offset, $value);
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
                    $this->getAttributes()->set($offset, new Collection());
                    break;

                default:
                    unset($this->getAttributes()[$offset]);
                    break;
            }
        }

        

        /**
         * Id attribute shortcut
         *
         * @param $this $id
         */
        public function id($id = null)
        {
            if (!is_null($id))
            {
                return $this->addAttribute('id', $id);
            }

            return $this->getAttribute('id');
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

        public function __clone()
        {
            $this->content = clone $this->content;
        }
    }
