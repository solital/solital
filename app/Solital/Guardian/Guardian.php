<?php

namespace Solital\Guardian;
use Solital\Exceptions\NotFoundException;
use Solital\Session\Session as Session;

class Guardian
{
    
    public static function checkLogin(string $index = INDEX_LOGIN) 
    {
        self::verifyConstants();
        if (empty($_SESSION[$index])) {
            header("Location: ". URL_LOGIN);
            exit;
        }
    }
    
    public static function checkLogged(string $index = INDEX_LOGIN) 
    {
        self::verifyConstants();
        if (isset($_SESSION[$index])) {
            header("Location: ". URL_DASHBOARD);
            exit;
        }
    }
    
    public static function validade(string $session, string $index = INDEX_LOGIN) 
    {
        self::verifyConstants();
        Session::new($index, $session);
        header("Location: ". URL_DASHBOARD);
        exit;
    }
    
    public static function logoff(string $index = INDEX_LOGIN) 
    {
        self::verifyConstants();
        Session::delete($index);
        header("Location: ". URL_LOGIN);
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
