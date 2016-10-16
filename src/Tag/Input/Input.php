<?php

    namespace ObjectivePHP\Html\Tag\Input;
    
    
    use ObjectivePHP\Html\Tag\Tag;
    use ObjectivePHP\Primitives\Collection\Collection;
    use ObjectivePHP\Primitives\Merger\MergePolicy;

    class Input extends Tag
    {


        /**
         * Data for default values
         *
         * @var Collection
         */
        protected static $data;

        /**
         * @var string
         */
        protected static $dateDefaultFormat = 'd/m/Y';

        /**
         * @var string
         */
        protected $tagName = 'input';

        /**
         * @var mixed default value if no value explicitly assigned or found in self::$data
         */
        protected $default;
    
        public function addAttribute($attribute, $value, $mergePolicy = MergePolicy::REPLACE)
        {
            parent::addAttribute($attribute, $value, $mergePolicy);
        
            if (strtolower($attribute) == 'id' && !$this->getAttribute('name'))
            {
                parent::addAttribute('name', $value);
            }
        
            return $this;
        }
    
    
        /**
         * @param $name
         * @param ...$classes
         *
         * @return $this
         */
        public static function text($id, ...$classes)
        {
            $input = static::factory('input', null, ...$classes);

            $input->addAttributes(['type' => 'text', 'id' => $id]);

            return self::decorate($input);
        }

        /**
         * @param $name
         * @param ...$classes
         *
         * @return $this
         */
        public static function number($id, ...$classes)
        {
            $input = static::factory('input', null, ...$classes);

            $input->addAttributes(['type' => 'number', 'id' => $id]);

            return self::decorate($input);
        }

        /**
         * @param $name
         * @param ...$classes
         *
         * @return $this
         */
        public static function hidden($id, $value = '')
        {
            $input = static::factory('input');

            $input->addAttributes(['type' => 'hidden', 'id' => $id, 'value' => $value]);

            return $input;
        }

        /**
         * @param $name
         * @param ...$classes
         *
         * @return $this
         */
        public static function password($id, ...$classes)
        {
            $input = static::factory('input', null, ...$classes);

            $input->addAttributes(['type' => 'password', 'id' => $id]);

            return self::decorate($input);
        }

        /**
         * @param $name
         * @param ...$classes
         *
         * @return $this
         */
        public static function date($id, ...$classes)
        {
            $input = static::factory('input', null, ...$classes);

            $input->addAttributes(['type' => 'date', 'id' => $id]);

            return self::decorate($input);
        }

        /**
         * @param $name
         * @param ...$classes
         *
         * @return $this
         */
        public static function textarea($id, ...$classes)
        {
            $input = static::factory('textarea', null, ...$classes);
            $input->alwaysClose();
            $input->addAttributes(['id' => $id]);

            return self::decorate($input);
        }

        /**
         * @param $name
         * @param ...$classes
         *
         * @return Select
         */
        public static function select($id, $options = null, ...$classes)
        {
            $input = Select::factory('select', null, ...$classes);
            $input->alwaysClose();
            $input->addAttributes(['id' => $id]);
            if ($options) $input->addOptions($options);

            return self::decorate($input);
        }

        public static function option($value, $label = null)
        {

            if (is_null($label))
            {
                $label = $value;
                $value = null;
            }

            $option = Option::factory('option', $label);

            if ($value)
            {
                $option->addAttribute('value', $value);
            }

            return self::decorate($option);
        }

        /**
         * @param $name
         * @param ...$classes
         *
         * @return $this
         */
        public static function checkbox($id, $value = "1", ...$classes)
        {
            $input = static::factory('input', null, ...$classes);

            $input->addAttributes(['type' => 'checkbox', 'id' => $id, 'value' => $value]);

            return self::decorate($input);
        }

        /**
         * @param $name
         * @param ...$classes
         *
         * @return $this
         */
        public static function radio($id, $value, ...$classes)
        {
            $input = static::factory('input', null, ...$classes);

            $input->addAttributes(['type' => 'radio', 'id' => $id, 'value' => $value]);

            return self::decorate($input);
        }
    
        /**
         * @param       $label
         * @param array ...$classes
         *
         * @return $this
         */
        public static function submit($label, ...$classes)
        {
            $button = static::factory('button', null, ...$classes);
            $button->addAttribute('type', 'submit');
            $button->getContent()->append($label);

            return self::decorate($button);
        }
    }
