<?php

namespace Solital\Core\Exceptions;

class NotFoundException 
{
    public static function WolfNotFound(string $view, string $ext) 
    {
        include_once ROOT.'/app/Core/Exceptions/templates/error-wolf.php';
        die;
    }

    public static function GuardianNotFound(string $type, string $msg) 
    {
        include_once ROOT.'/app/Core/Exceptions/templates/error-guardian.php';
        die;
    }

    public static function FileSystemNotFound(string $view)
    {
        include_once ROOT.'/app/Core/Exceptions/templates/error-file.php';
        die;
    }
    
}
