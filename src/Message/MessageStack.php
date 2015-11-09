<?php

    namespace ObjectivePHP\Html\Message;
    
    
    use ObjectivePHP\Primitives\Collection\Collection;

    class MessageStack extends Collection
    {

        /**
         * @var Collection
         */
        protected $messages;

        public function __construct($messages = [])
        {
            parent::__construct($messages);
            $this->restrictTo(MessageInterface::class);

        }

        /**
         * @param null $type
         *
         * @return int
         * @throws \ObjectivePHP\Primitives\Exception
         */
        public function count($type = null)
        {
            if(is_null($type))
            {
                $count = $this->messages->count();

            }
            else
            {
                $count = 0;
                $this->messages->each(
                    function (MessageInterface $message) use (&$count, $type)
                    {
                        if($type == $message->getType()) $count ++;
                    }
                );
            }

            return $count;
        }

    }