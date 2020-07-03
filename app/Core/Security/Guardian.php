<?php

namespace Solital\Core\Security;
use Solital\Core\Exceptions\NotFoundException;
use Solital\Core\Session\Session as Session;
use Solital\Database\ORM;
use PDO;

class Guardian
{
    private $table;
    private static $decoded;

    protected static function verifyLogin()
    {
        return new static;
    }

    protected function table(string $table)
    {
        $this->table = $table;
        return $this;
    }

    private static function queryDatabase($sql)
    {
        try {
            $stmt = ORM::query($sql);
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);

            return $res;
        } catch (\PDOException $e) {
            Exception::alertMessage($e, "'queryDatabase()' error");
        }
    }

    protected function fields(string $email_column, string $pass_column, string $email, string $password)
    {
        $sql = "SELECT * FROM $this->table WHERE $email_column = '$email';";
        $res = self::queryDatabase($sql);

        if (password_verify($password, $res[$pass_column])) {
            return $res;
        } else {
            return false;
        }
    }

    public static function changeEmail(string $table, string $email_column, string $email, string $new_email)
    {
        $sql = "SELECT * FROM $table WHERE $email_column = '$email';";
        $res = self::queryDatabase($sql);

        if (isset($res)) {
            self::updateEmail($table, $email_column, $email, $new_email);
        } else {
            return false;
        }
    }

    public static function verifyEmail(string $table, string $email_column, string $email)
    {
        $sql = "SELECT * FROM $table WHERE $email_column = '$email';";
        $res = self::queryDatabase($sql);

        if (isset($res)) {
            self::validateEmail($email);
        } else {
            return false;
        }
    }

    private static function validateEmail(string $email)
    {
        $email = filter_input(INPUT_POST, $email, FILTER_VALIDATE_EMAIL);

        if (preg_match("/^[a-zA-Z0-9.-_]+@[a-z]+\.[a-z.]{1,6}$/", $email)) {
            return true;
        } else {
            return false;
        }
    }

    private static function updateEmail(string $table, string $email_column, string $email, string $new_email)
    {
        if (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $sql = "UPDATE $table SET $email_column = '$new_email' WHERE $email_column = '$email'";
        $stmt = ORM::prepare($sql);
        $res = $stmt->execute();

        if (isset($res)) {
            return true;
        } else {
            return false;
        }
    }

    public static function encrypt(string $value, string $time = '+1 hour')
    {
        $data = [
            'value' => $value,
            'expire_at' => date("Y-m-d H:i:s", strtotime($time))
        ];

        $key = openssl_encrypt(json_encode($data), "AES-128-CBC", SECRET, 0, SECRET_IV);
        $key = base64_encode($key);

        return $key;
    }

    public static function decrypt(string $key)
    {
        $decode = base64_decode($key);
        $decode = openssl_decrypt($decode, "AES-128-CBC", SECRET, 0, SECRET_IV);
        
        self::$decoded = $decode;
        
        return __CLASS__;
    }

    public static function value()
    {
        $json = json_decode(self::$decoded, true);

        return $json['value'];
    }

    public static function isValid()
    {
        $json = json_decode(self::$decoded, true);

        if ($json['expire_at'] > date("Y-m-d H:i:s")) {
            return true;
        } else {
            return false;
        }
    }
    
    public static function checkLogin(string $index = INDEX_LOGIN) 
    {
        self::verifyConstants();
        if (empty($_SESSION[$index])) {
            response()->redirect(URL_LOGIN);
            exit;
        }
    }
    
    public static function checkLogged(string $index = INDEX_LOGIN) 
    {
        self::verifyConstants();
        if (isset($_SESSION[$index])) {
            response()->redirect(URL_DASHBOARD);
            exit;
        }
    }
    
    protected static function validate(string $session, string $index = INDEX_LOGIN) 
    {
        self::verifyConstants();
        Session::new($index, $session);
        response()->redirect(URL_DASHBOARD);
        exit;
    }
    
    public static function logoff(string $index = INDEX_LOGIN) 
    {
        self::verifyConstants();
        Session::delete($index);
        response()->redirect(URL_LOGIN);
        exit;
    }
    
    private static function verifyConstants() 
    {
        if (INDEX_LOGIN == "" || empty(INDEX_LOGIN)) {
            NotFoundException::GuardianNotFound("INDEX_LOGIN not defined", "You have not determined any indexes in the INDEX_LOGIN constant. Check your 'config.php' file");
        }
        
        if (URL_DASHBOARD == "" || empty(URL_DASHBOARD)) {
            NotFoundException::GuardianNotFound("URL_DASHBOARD not defined", "You have not determined any indexes in the URL_DASHBOARD constant. Check your 'config.php' file");
        }
        
        if (URL_LOGIN == "" || empty(URL_LOGIN)) {
            NotFoundException::GuardianNotFound("URL_LOGIN not defined", "You have not determined any indexes in the URL_LOGIN constant. Check your 'config.php' file");
        }
    }

}
