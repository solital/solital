<?php

namespace Solital\Vinci;

class Components
{
    protected static function removeController(string $name)
    {
        $file = \dirname(__DIR__)."/Components/Controller/".$name.".php";

        if (is_file($file)) {
            unlink($file);
        
            return true;
        }
        
        return false;   
    }

    protected static function removeModel(string $name)
    {
        $file = \dirname(__DIR__)."/Components/Model/".$name.".php";

        if (is_file($file)) {
            unlink($file);
        
            return true;
        }
        
        return false;   
    }

    protected static function removeView(string $name)
    {
        $file = "./resources/view/".$name.".php";

        if (is_file($file)) {
            unlink($file);
        
            return true;
        }
        
        return false;   
    }

    protected static function removeJs(string $name)
    {
        $file = "./public/assets/_js/".$name.".js";

        if (is_file($file)) {
            unlink($file);
        
            return true;
        }
        
        return false;   
    }

    protected static function removeCss(string $name)
    {
        $file = "./public/assets/_css/".$name.".css";

        if (is_file($file)) {
            unlink($file);
        
            return true;
        }
        
        return false;   
    }
    
    protected static function controller(string $name) 
    {
        $dir = \dirname(__DIR__)."/Components/Controller/";
        
        if (is_dir($dir)) {
            file_put_contents($dir."$name.php", "<?php\n\nnamespace Solital\Controller;\n\nclass ".$name."\n{\n\n}");
            
            return true;
        }
        
        return false;
    }
    
    protected static function view(string $name) 
    {
        $dir = "./resources/view/";
        if (is_dir($dir)) {
            file_put_contents($dir."$name.php", "<h1>$name</h1>");
            
            return true;
        }
        
        return false;
    }
    
    protected static function model(string $name) 
    {
        $dir = \dirname(__DIR__)."/Components/Model/";
        
        if (is_dir($dir)) {
            file_put_contents($dir."$name.php", "<?php\n\nnamespace Solital\Model;\n\nclass ".$name."\n{\n\n}");
            
            return true;
        }
        
        return false;
    }
    
    protected static function jsFile(string $name) 
    {
        $dir = "./public/assets/_js/";
        
        if (is_dir($dir)) {
            file_put_contents($dir."$name.js", "");
            
            return true;
        }
        
        return false;
    }

    protected static function cssFile(string $name) 
    {
        $dir = "./public/assets/_css/";
        
        if (is_dir($dir)) {
            file_put_contents($dir."$name.css", "");
            
            return true;
        }
        
        return false;
    }

    protected static function dump(string $local) 
    {
        $command = exec("mysqldump -u ".DB_CONFIG['USER']." -p".DB_CONFIG['PASS']." ".DB_CONFIG['DBNAME']." > ".$local."/".DB_CONFIG['DBNAME'].".sql");
        
        if ($command) {
            echo 'dump';
            return true;
        } else {
            echo 'erro';
            return false;
        }
    }
}
