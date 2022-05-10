<?php

require_once dirname(__DIR__) . '/mailConfig.php';

use PHPUnit\Framework\TestCase;
use Solital\Core\Mail\Mailer;

class MailTest extends TestCase
{
    public function testMail()
    {
        $mail = new Mailer();
        $mail->add('sender_email@gmail.com', 'Sender name', 'recipient_email@gmail.com', 'Recipient name');
        $res = $mail->send('test', 'body test', 'alt body');
        var_dump($res);
    }

    public function testMailQueue()
    {
        $mail = new Mailer();
        $mail->add('sender_email@gmail.com', 'Sender name', 'recipient_email@gmail.com', 'Recipient name');
        $res = $mail->queue('test', 'body test', 'alt body');
        $this->assertTrue($res);
    }

    public function testSendMailQueue()
    {
        $mail = new Mailer();
        $res = $mail->sendQueue();
        $this->assertTrue($res);
    }

    /**
     * Test only if `mail_test` is enabled
     */
    /* public function testMailDebug()
    {
        $mail = new Mailer();
        $mail->add('brennoduarte2015@outlook.com', 'Solital', 'brenno@smwdigital.com.br', 'Brenno Duarte');
        $res = $mail->send('test', 'body test', 'alt body');

        $this->assertTrue($res);
    } */
}
