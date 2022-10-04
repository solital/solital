<?php

use Solital\Core\Mail\Mailer;

class MailQueue
{
    public function dispatch()
    {
        (new Mailer)->sendQueue();
    }    
}
