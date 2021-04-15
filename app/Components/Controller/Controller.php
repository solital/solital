<?php

namespace Solital\Components\Controller;

use Solital\Core\Course\Container\Container;
use Solital\Core\Resource\Message;

/**
 * This class is a generic Controller, all Controllers created in Solital must extend this class. 
 * 
 * It offers ways to access some classes (such as Message and Container) in a simpler and easier way. 
 */

abstract class Controller
{
    /**
     * @var Message
     */
    protected Message $message;
    
    /**
     * @var Container
     */
    protected Container $container;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->message = new Message();
        $this->container = new Container();
    }
}
