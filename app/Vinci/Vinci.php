<?php

namespace Vinci;

class Vinci 
{
    
    public static function Controller(string $name) 
    {
        $dir = ROOT."/app/Solital/Controller/";
        
        if (is_dir($dir)) {
            file_put_contents($dir."$name.php", "<?php\n\nnamespace Solital\Controller;\n\nclass ".$name."\n{\n\n}");
            
            return true;
        }
        
        return false;
    }
    
    public static function View(string $name) 
    {
        $dir = ROOT."/resources/view/";
        
        if (is_dir($dir)) {
            file_put_contents($dir."$name.php", "<h1>$name</h1>");
            
            return true;
        }
        
        return false;
    }
    
    public static function Model(string $name) 
    {
        $dir = ROOT."/app/Solital/Model/";
        
        if (is_dir($dir)) {
            file_put_contents($dir."$name.php", "<?php\n\nnamespace Solital\Model;\n\nclass ".$name."\n{\n\n}");
            
            return true;
        }
        
        return false;
    }
    
    public static function Dump(string $database, string $local) 
    {
        $command = exec("mysqldump -u ".DB_CONFIG['USER']." -p".DB_CONFIG['PASS']." ".$database." > ".$local."/".$database.".sql");
        
        if ($command) {
            return true;
        } else {
            return false;
        }
    }
    
}
