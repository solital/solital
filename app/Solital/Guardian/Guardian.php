<?php

namespace Solital\Guardian;

class Guardian {

    public static function send() {
        /*$to = 'brennoduarte2015@outlook.com';
        $subject = 'Solital alert: project clone';
        $message = '<p>Solital alert: project clone</p>';
        $message .= '<p>It looks like someone has cloned your project. The url is different from http://mysite.com.br</p>';
        $headers = "Content-Type: text/html; charset=utf-8\r\n";
        $headers .= "From: brennoduarte2015@outlook.com\r\n";
        $headers .= "Reply-To: brennoduarte2015@outlook.com\r\n";

        if (mail($to, mb_encode_mimeheader($subject, "utf-8"), $message, $headers)) {
            echo "E-mail send";
        } else {
            echo "Error e-mail";
        }*/
        print_r('guardian enviado');
    }

}
