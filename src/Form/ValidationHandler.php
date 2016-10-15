<?php
/**
 * This file is part of the Objective PHP project
 *
 * More info about Objective PHP on www.objective-php.org
 *
 * @license http://opensource.org/licenses/GPL-3.0 GNU GPL License 3.0
 */

namespace ObjectivePHP\Html\Form;


use ObjectivePHP\Notification\Stack;

trait ValidationHandler
{
    /**
     * @var Stack
     */
    protected $messages;
    
    /**
     * @return Stack
     */
    public function getMessages(): Stack
    {
        if(is_null($this->messages))
        {
            $this->messages = $this->validate();
        }
        
        return $this->messages;
    }
    
    /**
     * @param Stack $messages
     *
     * @return $this
     */
    public function setMessages(Stack $messages)
    {
        $this->messages = $messages;
        
        return $this;
    }
    
    abstract public function validate() : Stack;
    
}
