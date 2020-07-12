<?php

namespace Solital\Core\Security;
use PDO;
use DateTime;
use Solital\Database\ORM;
use Katrina\Exception\Exception;
use Solital\Database\Forgot\Forgot;
use Solital\Core\Session\Session as Session;
use Solital\Core\Exceptions\NotFoundException;

class Guardian
{
    /**
     * @var string
     */
    private $table;

    /**
     * Verify login
     */
    protected static function verifyLogin()
    {
        return new static;
    }

    /**
     * @param string $table
     */
    public function table(string $table)
    {
        $this->table = $table;
        return $this;
    }

    /**
     * @param string $email_column
     * @param string $pass_column
     * @param string $email
     * @param string $password
     */
    protected function fields(string $email_column, string $pass_column, string $email, string $password)
    {
        $sql = "SELECT * FROM $this->table WHERE $email_column = '$email';";
        $res = (new Forgot())->queryDatabase($sql);

        if (password_verify($password, $res[$pass_column])) {
            return $res;
        } else {
            return false;
        }
    }

    /**
     * @param string $table
     * @param string $email_column
     * @param string $email
     */
    public static function verifyEmail(string $table, string $email_column, string $email)
    {
        $sql = "SELECT * FROM $table WHERE $email_column = '$email';";
        $res = (new Forgot())->queryDatabase($sql);
        
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param string $index Optional
     */
    public static function checkLogin(string $index = INDEX_LOGIN) 
    {
        self::verifyConstants();
        if (empty($_SESSION[$index])) {
            response()->redirect(URL_LOGIN);
            exit;
        }
    }
    
    /**
     * @param string $index Optional
     */
    public static function checkLogged(string $index = INDEX_LOGIN) 
    {
        self::verifyConstants();
        if (isset($_SESSION[$index])) {
            response()->redirect(URL_DASHBOARD);
            exit;
        }
    }
    
    /**
     * @param string $index Optional
     */
    protected static function validate(string $session, string $index = INDEX_LOGIN) 
    {
        self::verifyConstants();
        Session::new($index, $session);
        response()->redirect(URL_DASHBOARD);
        exit;
    }
    
    /**
     * @param string $index Optional
     */
    public static function logoff(string $index = INDEX_LOGIN) 
    {
        self::verifyConstants();
        Session::delete($index);
        response()->redirect(URL_LOGIN);
        exit;
    }
    
    /**
     * Checks for constants
     */
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
