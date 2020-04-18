<?php

namespace Content;

class Content {
    
    public static function cController(string $name) {
        $content = "<?php 
            namespace Lua\Controllers;
            
            class ".$name." {
            
            }";
        
        return $content;
    }
    
}
