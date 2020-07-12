<?php

namespace Solital\Core\Security;

use PDO;
use Solital\Database\ORM;
use Solital\Core\Resource\Mail;
use Katrina\Exception\Exception;
use Solital\Database\Forgot\Forgot;
use Solital\Core\Course\Container\Container;

class Reset
{
    /**
     * @var string
     */
    private $table;

    /**
     * @var string
     */
    private $column;

    /**
     * @param string $table
     */
    public function table(string $table, string $column)
    {
        $this->table = $table;
        $this->column = $column;

        return $this;
    }

    /**
     * @param string $email
     * @param string $uri
     */
    public function forgotPass(string $email, string $uri)
    {
        $sql = "SELECT * FROM ". $this->table ." WHERE ". $this->column ." = '$email';";
        $res = (new Forgot())->queryDatabase($sql);
        
        if (!$res == false) {
            $res = $this->updatePass($email, $uri);

            if ($res == true) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * @param string $email
     * @param string $uri
     */
    private function updatePass(string $email, string $uri): bool
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $hash = Hash::encrypt($email);
        $thisUri = request()->getHost();
        
        $message = "
            <h1>Forgot Password</h1>

            <p>Hello, click the link below to change your password</p>

            <p><a href='".$thisUri.$uri."/".$hash."' target='_blank' style='padding: 10px; background-color: red; 
            border-radius: 5px; color: #fff; text-decoration: none;'>Change Password</a></p>
            
            <small>Sent from the solital framework</small>
        ";

        $res = Mail::send(EMAIL['SENDER'], $email, "Forgot Password", $message, null, "text/html");

        if ($res == true) {
            return true;
        } else {
            return false;
        }
    }

}
