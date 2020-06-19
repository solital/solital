<?php

namespace Solital\Mail;

class Mail
{

    private static $sender;
    private static $recipient;
    private static $subject;
    private static $message;

    public static function send(string $sender, string $recipient, string $subject, string $message, string $reply_to = null, string $type = "text/plan", string $charset = "UTF-8", int $priority = 3)
    {
        self::$sender = $sender;
        self::$recipient = $recipient;
        self::$subject = $subject;
        self::$message = $message;

        $headers = "MIME-Version: 1 .1\r\n";
        $headers .= "Content-type: ".$type."; charset=".$charset."\r\n";
        $headers .= "From: ".self::$sender."\r\n";
        if ($reply_to != null) {
            $headers .= "Reply-To: ".$reply_to."\r\n";
        }
        $headers .= "X-Priority: ".$priority."\n";
        $send = mail(self::$recipient, self::$subject, self::$message, $headers);
        
        if($send) {
            return true;
        } else {
            return false;
        }
    }
}
