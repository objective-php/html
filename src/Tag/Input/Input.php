<?php

    namespace ObjectivePHP\Html\Tag\Input;
    
    
    use ObjectivePHP\Html\Tag\Tag;
    use ObjectivePHP\Primitives\Collection\Collection;

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
        protected $tag = 'input';

        public function __construct($content = null)
        {
            parent::__construct($content);

            // overrides default renderer
            $this->setRenderer(new InputTagRenderer());
        }

        /**
         * @param $name
         * @param ...$classes
         *
         * @return $this
         */
        public static function text($name, ...$classes)
        {
            $input = static::factory('input', null, ...$classes);

            $input->addAttributes(['type' => 'text', 'name' => $name]);

            return $input;
        }

        /**
         * @param $name
         * @param ...$classes
         *
         * @return $this
         */
        public static function date($name, ...$classes)
        {
            $input = static::factory('input', null, ...$classes);

            $input->addAttributes(['type' => 'date', 'name' => $name]);

            return $input;
        }

        /**
         * @param $name
         * @param ...$classes
         *
         * @return $this
         */
        public static function textarea($name, ...$classes)
        {
            $input = static::factory('textarea', null, ...$classes);
            $input->alwaysClose();
            $input->addAttributes(['name' => $name]);

            return $input;
        }

        /**
         * @param $name
         * @param ...$classes
         *
         * @return Select
         */
        public static function select($name, $options = null, ...$classes)
        {
            $input = Select::factory('select', $options, ...$classes);
            $input->alwaysClose();
            $input->addAttributes(['name' => $name]);

            return $input;
        }

        public static function option($value, $label = null)
        {

            if(is_null($label))
            {
                $label = $value;
                $value = null;
            }

            $option = Option::factory('option', $label);

            if($value)
            {
                $option->addAttribute('value', $value);
            }

            return $option;
        }

        /**
         * @param $name
         * @param ...$classes
         *
         * @return $this
         */
        public static function checkbox($name, $value = "1", ...$classes)
        {
            $input = static::factory('input', null, ...$classes);

            $input->addAttributes(['type' => 'checkbox', 'name' => $name, 'value' => $value]);

            return $input;
        }

        /**
         * @param $name
         * @param ...$classes
         *
         * @return $this
         */
        public static function radio($name, $value, ...$classes)
        {
            $input = static::factory('input', null, ...$classes);

            $input->addAttributes(['type' => 'radio', 'name' => $name, 'value' => $value]);

            return $input;
        }

        /**
         * @throws \ObjectivePHP\Html\Exception
         * @throws \ObjectivePHP\Primitives\Exception
         */
        public function assignDefaultValue()
        {
            // if no data is set, leave the method
            if (!self::getData()) return;

            $name = $this->getAttribute('name');

            // filter array notation
            if (substr($name, -2) == '[]') $name = substr($name, 0, -2);

            switch ($this->getTag())
            {

                case 'input':

                    switch ($this->getAttribute('type'))
                    {
                        case 'checkbox':
                            if (!$this->getAttribute('checked') && $this->getData()->has($name))
                            {
                                $dataValue = $this->getData()->get($name);
                                if (is_scalar($dataValue) || in_array($this->getAttribute('value'), $dataValue))
                                {
                                    $this->addAttribute('checked', true);
                                }
                            }
                            break;
                        case 'radio':
                            if (!$this->getAttribute('checked') && $this->getData()->has($name))
                            {

                                $this->addAttribute('checked', true);
                            }
                            break;

                        default:
                            // handle default value
                            if (!$this->getAttribute('value') && $this->getData()->has($name))
                            {
                                $dataValue = $this->getData()->get($name);
                                if ($dataValue instanceof \DateTime)
                                {
                                    $dataValue = $dataValue->format(self::getDateDefaultFormat());
                                }
                                $this->addAttribute('value', $dataValue);
                            }
                            break;
                    }
                    break;

                case 'select':
                    if($this->getData()->has($name))
                    {
                        $dataValue = Collection::cast($this->getData()->get($name));
                        $this->getContent()->each(function(Input $option) use($dataValue)
                        {
                            $optionValue = $option->getAttribute('value') ?: $option->getContent()->join('');
                            if($dataValue->contains($optionValue))
                            {
                                $option->addAttribute('selected', true);
                            }
                        });
                    }
                    break;
            }
        }

        /**
         * @return Collection
         */
        public static function getData()
        {
            return self::$data;
        }

        /**
         * @param mixed $data
         */
        public static function setData($data)
        {
            self::$data = Collection::cast($data);
        }

        /**
         * @return string
         */
        public static function getDateDefaultFormat()
        {
            return self::$dateDefaultFormat;
        }

        /**
         * @param string $dateDefaultFormat
         */
        public static function setDateDefaultFormat($dateDefaultFormat)
        {
            self::$dateDefaultFormat = $dateDefaultFormat;
        }


    }