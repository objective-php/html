<?php

    namespace ObjectivePHP\Html\Message;
    
    
    use ObjectivePHP\Primitives\String\String;

    class AbstractMessage implements MessageInterface
    {

        protected $type;

        /**
         * @var String
         */
        protected $message;

        public function __construct($message)
        {
            $this->message = String::cast($message);
        }

        public function getType()
        {
            return $this->type;
        }

        public function __toString()
        {
            return (string) $this->message;
        }

    }