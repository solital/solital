<?php

namespace Solital\Core\Console;

class Commands
{
    protected static function removeController(string $name)
    {
        $file = ROOT_VINCI."/app/Components/Controller/".$name.".php";

        if (is_file($file)) {
            unlink($file);
        
            return true;
        }
        
        return false;
    }

    protected static function removeModel(string $name)
    {
        $file = ROOT_VINCI."/app/Components/Model/".$name.".php";

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

    protected static function removeRouter(string $name)
    {
        $file = "./routers/".$name.".php";

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

    protected static function router(string $name) 
    {
        $dir = "./routers/";
        if (is_dir($dir)) {
            file_put_contents($dir."$name.php", "<?php\n\nuse Solital\Course\Course;\nuse Solital\Wolf\Wolf;\n\nCourse::get('/', function(){\n\x20\x20\x20\x20\x20Wolf::loadView('');\n});");
            
            return true;
        }
        
        return false;
    }
    
    protected static function controller(string $name) 
    {
        $dir = ROOT_VINCI."/app/Components/Controller/";
        
        if (is_dir($dir)) {
            file_put_contents($dir."$name.php", "<?php\n\nnamespace Solital\Components\Controller;\n\nclass ".$name."\n{\n\n}");
            
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
        $dir = ROOT_VINCI."/app/Components/Model/";
        
        if (is_dir($dir)) {
            file_put_contents($dir."$name.php", "<?php\n\nnamespace Solital\Components\Model;\nuse Solital\Components\Model\Model;\n\nclass ".$name." extends Model\n{\n\n}");
            
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
