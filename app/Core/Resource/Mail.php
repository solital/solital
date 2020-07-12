<?php

namespace Solital\Core\Resource;

class Mail
{
    /**
     * Email sender
     * @var string
     */
    private static $sender;

    /**
     * Email recipient
     * @var string
     */
    private static $recipient;

    /**
     * Email subject
     * @var string
     */
    private static $subject;

    /**
     * Email message
     * @var string
     */
    private static $message;
    
    /**
     * Send email
     * @param string $sender
     * @param string $recipient
     * @param string $subject
     * @param string $message
     * @param string $reply_to
     * @param string $type
     * @param string $charset
     * @param string $priority
     */
    public static function send(string $sender, string $recipient, string $subject, string $message, string $reply_to = null, string $type = "text/plan", string $charset = "UTF-8", int $priority = 3)
    {
        $validateSender = self::validateEmail($sender);
        $validateRecipient = self::validateEmail($recipient);

        if ($validateSender == false) {
            return false;
        } elseif ($validateRecipient == false) {
            return false;
        }

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

    /**
     * Validate the email
     * @param string $email
     */
    public static function validateEmail(string $email)
    {
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        
        if ($email) {
            return true;
        } else {
            return false;
        }
    }
}
