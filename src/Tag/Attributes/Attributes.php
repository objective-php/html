<?php

    namespace ObjectivePHP\Html\Tag\Attributes;
    
    
    use ObjectivePHP\Primitives\Collection\Collection;

    class Attributes extends Collection
    {
        /**
         * @param array $input
         */
        public function __construct($input = [])
        {
            // initialize sub Collections
            $this->set('class', new Collection());

            foreach ($input as $attribute => $value)
            {
                $this->set($attribute, $value);
            }
        }

        /**
         * @param mixed $data
         */
        public function merge($data)
        {
            parent::merge($data);

            // ensure class is still a Collection
           $this->set('class', Collection::cast($this->get('class')));

            return $this;
        }


        /**
         * @param $attribute
         * @param $value
         *
         * @return $this
         * @throws \ObjectivePHP\Primitives\Exception
         */
        public function set($attribute, $value)
        {
            // handle collections
            if ($this->has($attribute))
            {
                $set = $this->get($attribute);
                if ($set instanceof Collection)
                {
                    $set->clear()->append($value);

                    return $this;
                }
            }

            parent::set($attribute, $value);

            return $this;
        }

        
        
        public function __toString()
        {
            $flattenedAttributes = [];

            $this->each(function ($value, $attribute) use (&$flattenedAttributes)
            {
                // skip empty collections
                if (!$value || ($value instanceof Collection && $value->isEmpty())) return;

                if(is_int($attribute))
                {
                    $flattenedAttributes[] = $value;
                }
                else if (is_bool($value))
                {
                    if($value === true) $flattenedAttributes[] = $attribute;
                }
                else
                {
                    $flattenedAttributes[] = $attribute . '="' . Collection::cast($value)->join(' ') . '"';
                }
            });

            return trim(implode(' ', $flattenedAttributes));
        }
    }
