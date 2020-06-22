<?php

namespace Solital\Core\Security;
use Solital\Core\Exceptions\NotFoundException;
use Solital\Core\Session\Session as Session;
use Katrina\Connection\DB as DB;
use Katrina\Exception\Exception;
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

    protected function fields(string $column_email, string $column_pass, string $email, string $password)
    {
        try {
            $sql = "SELECT * FROM $this->table WHERE $column_email = '$email';";
            $stmt = DB::query($sql);
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $res[$column_pass])) {
                return $res;
            } else {
                return false;
            }

        } catch (\PDOException $e) {
            Exception::alertMessage($e, "'verifyLogin()' error");
        }
    }

    public static function verifyEmail(string $email, int $type)
    {
        switch ($type) {
            case 1:
                $email = filter_input(INPUT_GET, $email, FILTER_VALIDATE_EMAIL);

                if (preg_match("/^[a-zA-Z0-9.-_]+@[a-z]+\.[a-z.]{1,6}$/", $email)) {
                    return true;
                } else {
                    return false;
                }
                break;
            
            case 2:
                $email = filter_input(INPUT_POST, $email, FILTER_VALIDATE_EMAIL);

                if (preg_match("/^[a-zA-Z0-9.-_]+@[a-z]+\.[a-z.]{1,6}$/", $email)) {
                    return true;
                } else {
                    return false;
                }
                break;
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
            NotFoundException::indexNotFound("INDEX_LOGIN not defined", "You have not determined any indexes in the INDEX_LOGIN constant. Check your 'config.php' file");
        }
        
        if (URL_DASHBOARD == "" || empty(URL_DASHBOARD)) {
            NotFoundException::indexNotFound("URL_DASHBOARD not defined", "You have not determined any indexes in the URL_DASHBOARD constant. Check your 'config.php' file");
        }
        
        if (URL_LOGIN == "" || empty(URL_LOGIN)) {
            NotFoundException::indexNotFound("URL_LOGIN not defined", "You have not determined any indexes in the URL_LOGIN constant. Check your 'config.php' file");
        }
    }

}
